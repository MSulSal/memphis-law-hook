$ErrorActionPreference = "Stop"

Add-Type -AssemblyName System.Drawing

function Save-Crop {
    param(
        [Parameter(Mandatory = $true)][System.Drawing.Image]$Source,
        [Parameter(Mandatory = $true)][int]$X,
        [Parameter(Mandatory = $true)][int]$Y,
        [Parameter(Mandatory = $true)][int]$Width,
        [Parameter(Mandatory = $true)][int]$Height,
        [Parameter(Mandatory = $true)][string]$Path
    )

    $crop = New-Object System.Drawing.Bitmap($Width, $Height)
    $gfx = [System.Drawing.Graphics]::FromImage($crop)
    try {
        $gfx.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
        $gfx.PixelOffsetMode = [System.Drawing.Drawing2D.PixelOffsetMode]::HighQuality
        $gfx.SmoothingMode = [System.Drawing.Drawing2D.SmoothingMode]::HighQuality
        $gfx.DrawImage(
            $Source,
            [System.Drawing.Rectangle]::new(0, 0, $Width, $Height),
            [System.Drawing.Rectangle]::new($X, $Y, $Width, $Height),
            [System.Drawing.GraphicsUnit]::Pixel
        )
    } finally {
        $gfx.Dispose()
    }

    $crop.Save($Path, [System.Drawing.Imaging.ImageFormat]::Png)
    $crop.Dispose()
}

function Draw-Compare {
    param(
        [Parameter(Mandatory = $true)][System.Drawing.Image]$PdfCrop,
        [Parameter(Mandatory = $true)][System.Drawing.Image]$LiveCrop,
        [Parameter(Mandatory = $true)][string]$Name,
        [Parameter(Mandatory = $true)][string]$Path
    )

    $gap = 14
    $padding = 14
    $labelHeight = 38
    $canvasWidth = $padding + $PdfCrop.Width + $gap + $LiveCrop.Width + $padding
    $canvasHeight = $padding + $labelHeight + [Math]::Max($PdfCrop.Height, $LiveCrop.Height) + $padding

    $canvas = New-Object System.Drawing.Bitmap($canvasWidth, $canvasHeight)
    $gfx = [System.Drawing.Graphics]::FromImage($canvas)
    try {
        $gfx.Clear([System.Drawing.Color]::FromArgb(9, 14, 24))
        $font = New-Object System.Drawing.Font("Segoe UI", 13, [System.Drawing.FontStyle]::Bold)
        $textBrush = New-Object System.Drawing.SolidBrush([System.Drawing.Color]::FromArgb(230, 238, 243, 251))
        $dividerPen = New-Object System.Drawing.Pen([System.Drawing.Color]::FromArgb(96, 77, 127, 212), 2)
        try {
            $labelY = $padding + 8
            $imageY = $padding + $labelHeight
            $pdfX = $padding
            $liveX = $padding + $PdfCrop.Width + $gap

            $gfx.DrawString("PDF - $Name", $font, $textBrush, $pdfX, $labelY)
            $gfx.DrawString("Live - $Name", $font, $textBrush, $liveX, $labelY)
            $gfx.DrawImage($PdfCrop, $pdfX, $imageY, $PdfCrop.Width, $PdfCrop.Height)
            $gfx.DrawImage($LiveCrop, $liveX, $imageY, $LiveCrop.Width, $LiveCrop.Height)
            $gfx.DrawRectangle($dividerPen, $pdfX, $imageY, $PdfCrop.Width - 1, $PdfCrop.Height - 1)
            $gfx.DrawRectangle($dividerPen, $liveX, $imageY, $LiveCrop.Width - 1, $LiveCrop.Height - 1)
        } finally {
            $font.Dispose()
            $textBrush.Dispose()
            $dividerPen.Dispose()
        }
    } finally {
        $gfx.Dispose()
    }

    $canvas.Save($Path, [System.Drawing.Imaging.ImageFormat]::Png)
    $canvas.Dispose()
}

$root = Split-Path -Parent $PSScriptRoot
$pdfDir = Join-Path $root ".codex-temp\pdf"
$livePath = Join-Path $root ".codex-temp\chrome-out\live-home-dark-fidelity-5.png"
$outRoot = Join-Path $root "docs\visual-qa\sections"
$pdfOutDir = Join-Path $outRoot "pdf"
$liveOutDir = Join-Path $outRoot "live"
$compareOutDir = Join-Path $outRoot "compare"
$pdfStackPath = Join-Path $outRoot "pdf-stacked.png"
$manifestPath = Join-Path $outRoot "manifest.json"

New-Item -ItemType Directory -Force $pdfOutDir, $liveOutDir, $compareOutDir | Out-Null

if (-not (Test-Path $livePath)) {
    throw "Live screenshot not found: $livePath"
}

$pagePaths = @(1, 2, 3) | ForEach-Object { Join-Path $pdfDir ("page-{0}.png" -f $_) }
foreach ($pagePath in $pagePaths) {
    if (-not (Test-Path $pagePath)) {
        throw "PDF page image not found: $pagePath"
    }
}

$pages = @()
foreach ($pagePath in $pagePaths) {
    $pages += [System.Drawing.Image]::FromFile($pagePath)
}

$live = [System.Drawing.Image]::FromFile($livePath)
try {
    # Trim page margins from exported PDF screenshots so section crops do not include white borders.
    $pdfTrimX = 32
    $pdfTrimY = 45
    $pdfTrimWidth = 1211
    $pdfTrimHeight = 1565
    $pdfWidth = $pdfTrimWidth
    $pdfHeight = $pdfTrimHeight * $pages.Count
    $pdfStack = New-Object System.Drawing.Bitmap($pdfWidth, $pdfHeight)
    $pdfStackGfx = [System.Drawing.Graphics]::FromImage($pdfStack)
    try {
        $pdfStackGfx.Clear([System.Drawing.Color]::FromArgb(255, 255, 255))
        $offsetY = 0
        foreach ($page in $pages) {
            $pdfStackGfx.DrawImage(
                $page,
                [System.Drawing.Rectangle]::new(0, $offsetY, $pdfTrimWidth, $pdfTrimHeight),
                [System.Drawing.Rectangle]::new($pdfTrimX, $pdfTrimY, $pdfTrimWidth, $pdfTrimHeight),
                [System.Drawing.GraphicsUnit]::Pixel
            )
            $offsetY += $pdfTrimHeight
        }
    } finally {
        $pdfStackGfx.Dispose()
    }

    $pdfStack.Save($pdfStackPath, [System.Drawing.Imaging.ImageFormat]::Png)

    $sections = @(
        @{
            name = "navbar"
            pdf = @{ x = 0; y = 0; width = 1211; height = 45 }
            live = @{ x = 0; y = 0; width = 1275; height = 45 }
        },
        @{
            name = "hero"
            pdf = @{ x = 0; y = 45; width = 1211; height = 608 }
            live = @{ x = 0; y = 45; width = 1275; height = 608 }
        },
        @{
            name = "practice-areas"
            pdf = @{ x = 0; y = 653; width = 1211; height = 749 }
            live = @{ x = 0; y = 653; width = 1275; height = 749 }
        },
        @{
            name = "workers-comp"
            pdf = @{ x = 0; y = 1402; width = 1211; height = 757 }
            live = @{ x = 0; y = 1402; width = 1275; height = 757 }
        },
        @{
            name = "our-team"
            pdf = @{ x = 0; y = 2159; width = 1211; height = 878 }
            live = @{ x = 0; y = 2159; width = 1275; height = 878 }
        },
        @{
            name = "testimonials"
            pdf = @{ x = 0; y = 3037; width = 1211; height = 645 }
            live = @{ x = 0; y = 3037; width = 1275; height = 645 }
        },
        @{
            name = "contact"
            pdf = @{ x = 0; y = 3682; width = 1211; height = 742 }
            live = @{ x = 0; y = 3682; width = 1275; height = 742 }
        },
        @{
            name = "footer"
            pdf = @{ x = 0; y = 4424; width = 1211; height = 233 }
            live = @{ x = 0; y = 4424; width = 1275; height = 233 }
        }
    )

    foreach ($section in $sections) {
        $name = [string] $section.name
        $pdfRect = $section.pdf
        $liveRect = $section.live

        $pdfPath = Join-Path $pdfOutDir ("{0}.png" -f $name)
        $livePathOut = Join-Path $liveOutDir ("{0}.png" -f $name)
        $comparePath = Join-Path $compareOutDir ("{0}.png" -f $name)

        Save-Crop -Source $pdfStack -X $pdfRect.x -Y $pdfRect.y -Width $pdfRect.width -Height $pdfRect.height -Path $pdfPath
        Save-Crop -Source $live -X $liveRect.x -Y $liveRect.y -Width $liveRect.width -Height $liveRect.height -Path $livePathOut

        $pdfCrop = [System.Drawing.Image]::FromFile($pdfPath)
        $liveCrop = [System.Drawing.Image]::FromFile($livePathOut)
        try {
            Draw-Compare -PdfCrop $pdfCrop -LiveCrop $liveCrop -Name $name -Path $comparePath
        } finally {
            $pdfCrop.Dispose()
            $liveCrop.Dispose()
        }

        Write-Output ("Saved section compare: {0}" -f $comparePath)
    }

    $manifest = [ordered]@{
        generated_at = [DateTime]::UtcNow.ToString("o")
        pdf_stack = "docs/visual-qa/sections/pdf-stacked.png"
        source = [ordered]@{
            pdf_pages = @(
                ".codex-temp/pdf/page-1.png",
                ".codex-temp/pdf/page-2.png",
                ".codex-temp/pdf/page-3.png"
            )
            live_screenshot = ".codex-temp/chrome-out/live-home-dark-fidelity-5.png"
            pdf_trim = [ordered]@{
                x = $pdfTrimX
                y = $pdfTrimY
                width = $pdfTrimWidth
                height = $pdfTrimHeight
            }
        }
        sections = $sections
    }

    $manifest | ConvertTo-Json -Depth 8 | Set-Content -NoNewline $manifestPath -Encoding UTF8
    Write-Output ("Saved manifest: {0}" -f $manifestPath)
} finally {
    foreach ($page in $pages) {
        $page.Dispose()
    }

    $live.Dispose()

    if ($null -ne $pdfStack) {
        $pdfStack.Dispose()
    }
}

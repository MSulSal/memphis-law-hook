$ErrorActionPreference = "Stop"

Add-Type -AssemblyName System.Drawing

$root = Split-Path -Parent $PSScriptRoot
$docDir = Join-Path $root ".codex-temp\pdf"
$livePath = Join-Path $root ".codex-temp\chrome-out\live-home-dark-fidelity-5.png"
$outDir = Join-Path $root "docs\visual-qa"
$offsets = @(0, 2200, 3900)

New-Item -ItemType Directory -Force $outDir | Out-Null

if (-not (Test-Path $livePath)) {
    throw "Live screenshot not found: $livePath"
}

$live = [System.Drawing.Image]::FromFile($livePath)
try {
    for ($index = 1; $index -le 3; $index++) {
        $docPath = Join-Path $docDir ("page-{0}.png" -f $index)
        if (-not (Test-Path $docPath)) {
            throw "PDF page image not found: $docPath"
        }

        $doc = [System.Drawing.Image]::FromFile($docPath)
        try {
            $canvas = New-Object System.Drawing.Bitmap(2550, 1650)
            $gfx = [System.Drawing.Graphics]::FromImage($canvas)
            try {
                $gfx.Clear([System.Drawing.Color]::FromArgb(12, 16, 28))

                $gfx.DrawImage(
                    $doc,
                    [System.Drawing.Rectangle]::new(0, 0, 1275, 1650),
                    [System.Drawing.Rectangle]::new(0, 0, 1275, 1650),
                    [System.Drawing.GraphicsUnit]::Pixel
                )

                $srcY = $offsets[$index - 1]
                $gfx.DrawImage(
                    $live,
                    [System.Drawing.Rectangle]::new(1275, 0, 1275, 1650),
                    [System.Drawing.Rectangle]::new(0, $srcY, 1275, 1650),
                    [System.Drawing.GraphicsUnit]::Pixel
                )

                $pen = New-Object System.Drawing.Pen([System.Drawing.Color]::FromArgb(45, 77, 127, 212), 2)
                $font = New-Object System.Drawing.Font("Segoe UI", 18, [System.Drawing.FontStyle]::Bold)
                $brush = New-Object System.Drawing.SolidBrush([System.Drawing.Color]::FromArgb(230, 238, 243, 251))
                try {
                    $gfx.DrawRectangle($pen, 0, 0, 1274, 1649)
                    $gfx.DrawRectangle($pen, 1275, 0, 1274, 1649)
                    $gfx.DrawString(("PDF Page {0}" -f $index), $font, $brush, 24, 20)
                    $gfx.DrawString(("Live Site Slice {0} (y={1})" -f $index, $srcY), $font, $brush, 1298, 20)
                } finally {
                    $pen.Dispose()
                    $font.Dispose()
                    $brush.Dispose()
                }
            } finally {
                $gfx.Dispose()
            }

            $outPath = Join-Path $outDir ("compare-page-{0}.png" -f $index)
            $canvas.Save($outPath, [System.Drawing.Imaging.ImageFormat]::Png)
            $canvas.Dispose()
            Write-Output ("Saved: {0}" -f $outPath)
        } finally {
            $doc.Dispose()
        }
    }
} finally {
    $live.Dispose()
}

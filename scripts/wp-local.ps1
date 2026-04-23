param(
    [Parameter(ValueFromRemainingArguments = $true)]
    [string[]]$WpArgs
)

$repoRoot = Split-Path -Parent $PSScriptRoot
$localRoot = Join-Path $env:APPDATA "Local"
$sitesConfigPath = Join-Path $localRoot "sites.json"
$lightningServicesPath = Join-Path $localRoot "lightning-services"
$wpCli = "C:\Users\Sul\AppData\Local\Programs\Local\resources\extraResources\bin\wp-cli\wp-cli.phar"
$wpPath = Join-Path $repoRoot "app\public"

if (-not (Test-Path $sitesConfigPath)) {
    throw "Local sites configuration not found at $sitesConfigPath"
}

if (-not (Test-Path $wpCli)) {
    throw "Local WP-CLI executable not found at $wpCli"
}

$sitesConfig = Get-Content $sitesConfigPath -Raw | ConvertFrom-Json
$siteMatch = $null

foreach ($siteProperty in $sitesConfig.PSObject.Properties) {
    $site = $siteProperty.Value
    $sitePath = $site.path -replace '^~', $HOME
    $resolvedSitePath = [System.IO.Path]::GetFullPath($sitePath)

    if ($resolvedSitePath.TrimEnd('\') -ieq $repoRoot.TrimEnd('\')) {
        $siteMatch = [PSCustomObject]@{
            Id     = $siteProperty.Name
            Config = $site
        }
        break
    }
}

if ($null -eq $siteMatch) {
    throw "Unable to find a matching Local site entry for $repoRoot"
}

$phpVersion = $siteMatch.Config.services.php.version
$phpServiceDir = Get-ChildItem $lightningServicesPath -Directory |
    Where-Object { $_.Name -like "php-$phpVersion+*" } |
    Sort-Object Name -Descending |
    Select-Object -First 1

if ($null -eq $phpServiceDir) {
    throw "Unable to find a Local PHP runtime for version $phpVersion"
}

$php = Join-Path $phpServiceDir.FullName "bin\win64\php.exe"
$phpIni = Join-Path $localRoot "run\$($siteMatch.Id)\conf\php\php.ini"
$tempPhpIni = Join-Path ([System.IO.Path]::GetTempPath()) "codex-wp-local-$($siteMatch.Id).ini"

if (-not (Test-Path $php)) {
    throw "Local PHP executable not found at $php"
}

if (-not (Test-Path $phpIni)) {
    throw "Local site PHP configuration not found at $phpIni"
}

$phpIniLines = Get-Content $phpIni | Where-Object {
    $_ -notmatch '^\s*extension\s*=\s*php_imagick\.dll\s*$'
}

Set-Content -Path $tempPhpIni -Value $phpIniLines

try {
    & $php `
        -c $tempPhpIni `
        $wpCli `
        "--path=$wpPath" `
        @WpArgs
}
finally {
    Remove-Item $tempPhpIni -Force -ErrorAction SilentlyContinue
}

exit $LASTEXITCODE

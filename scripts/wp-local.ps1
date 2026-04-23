param(
    [Parameter(ValueFromRemainingArguments = $true)]
    [string[]]$WpArgs
)

$repoRoot = Split-Path -Parent $PSScriptRoot
$php = "C:\Users\Sul\AppData\Roaming\Local\lightning-services\php-8.2.29+0\bin\win64\php.exe"
$extDir = "C:\Users\Sul\AppData\Roaming\Local\lightning-services\php-8.2.29+0\bin\win64\ext"
$wpCli = "C:\Users\Sul\AppData\Local\Programs\Local\resources\extraResources\bin\wp-cli\wp-cli.phar"
$wpPath = Join-Path $repoRoot "app\public"

if (-not (Test-Path $php)) {
    throw "Local PHP executable not found at $php"
}

if (-not (Test-Path $wpCli)) {
    throw "Local WP-CLI executable not found at $wpCli"
}

& $php `
    -d "extension_dir=$extDir" `
    -d "extension=mysqli" `
    -d "extension=pdo_mysql" `
    $wpCli `
    "--path=$wpPath" `
    @WpArgs

exit $LASTEXITCODE

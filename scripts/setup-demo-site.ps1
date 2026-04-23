$wpScript = Join-Path $PSScriptRoot "wp-local.ps1"

if (-not (Test-Path $wpScript)) {
    throw "WP-CLI helper not found at $wpScript"
}

& $wpScript plugin activate memphislaw-core
if ($LASTEXITCODE -ne 0) {
    exit $LASTEXITCODE
}

& $wpScript theme activate memphislaw
if ($LASTEXITCODE -ne 0) {
    exit $LASTEXITCODE
}

& $wpScript memphislaw setup-site
exit $LASTEXITCODE

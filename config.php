<?php
// Database configuration

define('DUMPER_URL', 'dumper_url');
define('DUMPER_SECRET', 'dumper_secret');

// Google Sheets API configuration
define('GOOGLE_SHEETS_API_KEY', 'google_api_key');

// Database connection
function getDbConnection(): array
{

    $conn = [
        'url' => DUMPER_URL,
        'header' => "Content-Type: application/json\r\nsecret: " . DUMPER_SECRET . "\r\n"
    ];

    return $conn;
}

function getGoogleConnection(): string
{
    return GOOGLE_SHEETS_API_KEY;
}

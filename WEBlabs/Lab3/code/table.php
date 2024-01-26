<?php
require  __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName('Google Sheets in PHP');
$client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__.'/credentials.json');

$service = new Google_Service_Sheets($client);

$range = 'A1:B1';
$data= [
    [
        'negro1',
        'shit negro2'
    ]
];
$values= new Google_Service_Sheets_ValueRange([
    'values'=>$data
]);


$options = [
    'valueInputOption'=> 'RAW'
];
$spreadsheetId='1ZbKq0WGoH-hYI2HGFdgsfFx7_P-l7zoCQ3-W0a59tX4';

$service->spreadsheets_values->update($spreadsheetId,$range,$values, $options);

$response = $service->spreadsheets_values->get($spreadsheetId,$range);

var_dump($response->getValues());
<?php

require './vendor/autoload.php';

use Google\Client;
use Google\Service\Sheets;

// Replace with your credentials and spreadsheet ID
$sheetID = "1lolWoevzY4zM2MaogRx6kev9Uv4396E7a-fgGQmlivU";
$client = new Client();
$client->setAuthConfig('credentials.json');
$client->setScopes(['https://www.googleapis.com/auth/spreadsheets']);
$service = new Sheets($client);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cardgames";

                $conn = new mysqli($servername, $username, $password, $dbname);

                // เช็คการเชื่อมต่อ
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query เพื่อดึงข้อมูล
                
// Replace with your credentials and spreadsheet ID
$sheetID= "1lolWoevzY4zM2MaogRx6kev9Uv4396E7a-fgGQmlivU";
$client = new Client();
$client->setAuthConfig('credentials.json');
$client->setScopes(['https://www.googleapis.com/auth/spreadsheets']);
$service = new Sheets($client);

// Get data from your SQL database
$sql = "SELECT Number AS 'Number', ID AS 'ID', Credit AS 'Credit', Name AS 'Name', Status AS 'Status', Comment AS 'Comment', Date_begin AS 'Date_begin', Active AS 'Active', user_profile AS 'user_profile', min1 AS 'min1', max1 AS 'max1' FROM user_data ORDER BY Number ASC";
$result = mysqli_query($conn, $sql);


// while ($row = mysqli_fetch_assoc($result)) {
    
//     $data[] = $row['ID'];
//     $data[] = $row['Name'];
//     $data[] = $row['Credit'];

// }

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}


// Prepare the data for the Google Sheets API
$range = 'Sheet1!A3:C500'; // Adjust the range to match your desired cells
$values = [];
$rowCounter = 0;
$columnCounter = 0;

foreach ($data as $row) {
    // Create a new row if needed
    if ($columnCounter === 0) {
        $values[] = [];
    }

    // Add the data to the current row
    $values[$rowCounter][$columnCounter] = $row['ID'];
    $values[$rowCounter][$columnCounter + 1] = $row['Name'];
    $values[$rowCounter][$columnCounter + 2] = $row['Credit'];

    // Increment counters
    $columnCounter += 3;
    if ($columnCounter >= 3) {
        $columnCounter = 0;
        $rowCounter++;
    }
}
// $values = $data;
$body = new Google_Service_Sheets_ValueRange(['values' => $values]);

//$body = new Google_Service_Sheets_ValueRange(['values' => $values]);

// Upload the data to Google Sheets
$result = $service->spreadsheets_values->update(
  $sheetID,
  $range,
  $body,
  ['valueInputOption' => 'RAW']
);
#poker
$conn2 = new mysqli($servername, $username, $password, "pokdeng");
$sql2 = "SELECT Number AS 'Number', ID AS 'ID', Credit AS 'Credit', Name AS 'Name', Status AS 'Status', Comment AS 'Comment', Date_begin AS 'Date_begin', Active AS 'Active', user_profile AS 'user_profile', min1 AS 'min1', max1 AS 'max1' FROM user_data ORDER BY Number ASC";
$result2 = mysqli_query($conn2, $sql);
$data2 = [];
while ($row2 = mysqli_fetch_assoc($result2)) {
    $data2[] = $row2;
}

$range = 'Sheet1!G3:I500'; // Adjust the range to match your desired cells
$values = [];
$rowCounter = 0;
$columnCounter = 0;

foreach ($data2 as $row2) {
    // Create a new row if needed
    if ($columnCounter === 0) {
        $values[] = [];
    }

    // Add the data to the current row
    $values[$rowCounter][$columnCounter] = $row2['ID'];
    $values[$rowCounter][$columnCounter + 1] = $row2['Name'];
    $values[$rowCounter][$columnCounter + 2] = $row2['Credit'];

    // Increment counters
    $columnCounter += 3;
    if ($columnCounter >= 3) {
        $columnCounter = 0;
        $rowCounter++;
    }
}
$body = new Google_Service_Sheets_ValueRange(['values' => $values]);

//$body = new Google_Service_Sheets_ValueRange(['values' => $values]);

// Upload the data to Google Sheets
$result = $service->spreadsheets_values->update(
  $sheetID,
  $range,
  $body,
  ['valueInputOption' => 'RAW']
);

if ($result) {
  echo 'Data uploaded successfully.';
} else {
  echo 'Error uploading data: ' . $result->getErrors();
}
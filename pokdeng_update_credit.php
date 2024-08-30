<?php
// รับข้อมูลจาก AJAX
$id = $_POST['id'];
$newCredit = $_POST['credit'];
$newMin = $_POST['min1'];
$newMax = $_POST['max1'];
$newCredit = $_POST['credit'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pokdeng";
date_default_timezone_set('Asia/Bangkok');

                $conn = new mysqli($servername, $username, $password, $dbname);
// เชื่อมต่อฐานข้อมูล (ปรับเปลี่ยนตามข้อมูลของคุณ)
// ...
$sql2 = "SELECT Credit FROM user_data WHERE ID ='$id' ";
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
}

// SQL query เพื่ออัปเดตข้อมูล
$sql = "UPDATE user_data SET Credit = '$newCredit', min1 = '$newMin', max1 ='$newMax' WHERE ID = '$id'";

$sum = $newCredit- $row['Credit']; 

// Execute query
if ($conn->query($sql) === TRUE) {
$action = "แก้ไขcredit:".$sum;
$time = date("Y-m-d H:i:s"); // เวลาปัจจุบัน
    $sql2 = "INSERT INTO adminlog (ID, Action, Time) VALUES ('$id', '$action', '$time')";
    if ($conn->query($sql2) === TRUE)
    echo "success";
    return "success";
} else {
    echo "Error updating record: " . $conn->error;
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
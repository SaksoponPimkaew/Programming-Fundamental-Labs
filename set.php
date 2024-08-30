<!DOCTYPE html>
<html>
<head>
    <title>หนิวหนิว</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>ตารางข้อมูล หนิวๆ</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>ID</th>
                    
                    <th>Name</th>
                    <th>Status</th>
                    <th>Comment</th>
                    <th>Date_begin</th>
                    <th>Credit</th>
                    <th>MIN</th>
                    <th>MAX</th>
                    <th>แก้ไขCredit</th>
                    <th>แก้ไขMIN</th>
                    <th>แก้ไขMAX</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // เชื่อมต่อฐานข้อมูล (ปรับเปลี่ยนตามข้อมูลของคุณ)
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
                $sql = "SELECT Number, ID, Credit, Name, Status, Comment, Date_begin, Active, user_profile,min1,max1 FROM user_data ORDER BY Number ASC ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Number"] . "</td>";
                        echo "<td>" . $row["ID"] . "</td>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td>" . $row["Status"] . "</td>";
                        echo "<td>" . $row["Comment"] . "</td>";
                        echo "<td>" . $row["Date_begin"] . "</td>";
                        echo "<td>" . $row["Credit"] . "</td>";
                        echo "<td>" . $row["min1"] . "</td>";
                        echo "<td>" . $row["max1"] . "</td>";
                        // ... (แสดงข้อมูลคอลัมน์อื่นๆ)
                        echo "<td>";
echo "<input type='text' value='" . $row["Credit"] . "' class='form-control credit-input' data-id='" . $row["ID"] . "' style='display: none;'>";
echo "<input type='text' value='" . $row["ID"] . "' class='form-control id-input' data-id='" . $row["Name"] . "' style='display: none;'>";
echo "<button class='btn btn-primary edit-btn'>แก้ไข</button>";
echo "<button class='btn btn-success save-btn' style='display: none;'>บันทึก</button>";
echo "</td>";

echo "<td>";
echo "<input type='text' value='" . $row["min1"] . "' class='form-control credit-input' data-id='" . $row["ID"] . "' style='display: none;'>";
echo "</td>";

echo "<td>";
echo "<input type='text' value='" . $row["max1"] . "' class='form-control credit-input' data-id='" . $row["ID"] . "' style='display: none;'>";
echo "</td>";
                        
                        echo "</tr>";
                        
                    }
                } else {
                    echo "0 results";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // JavaScript สำหรับจัดการการแสดง/ซ่อน input และปุ่ม
        $(document).ready(function() {
    $('.edit-btn').click(function() {
        $(this).closest('tr').find('.credit-input').show();
        $(this).hide();
        $(this).next('.save-btn').show();
    });

    $('.save-btn').click(function() {
    var row = $(this).closest('tr');
    // สมมติว่าค่า id เก็บอยู่ใน attribute data-id ของ row
    var credit = row.find('.credit-input').val();
    var id = row.find('.id-input').val();
    var min1 = row.find('.credit-input:eq(1)').val();
    var max1 = row.find('.credit-input:eq(2)').val();

    // ตรวจสอบข้อมูลเบื้องต้น (ตัวอย่าง)
    if (!credit || !min1 || !max1) {
        alert('กรุณากรอกข้อมูลให้ครบ');
        return;
    }

    $.ajax({
        url: 'update_credit.php',
        method: 'POST',
        data: {
            id: id,
            credit: credit,
            min1: min1,
            max1: max1
        },
        success: function(response) {
            if (response === 'success') {
                alert('อัปเดตข้อมูลสำเร็จ');
                // อัปเดตค่าในตาราง (ตัวอย่าง)
            } else {
                alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' + response);
            }
        },
        error: function(error) {
            alert('เกิดข้อผิดพลาดในการเชื่อมต่อเซิร์ฟเวอร์');
        }
    });
});
});
        
    </script>
</body>
</html>
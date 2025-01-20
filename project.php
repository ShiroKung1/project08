<?php
include('config.php'); // ตรวจสอบว่าชื่อไฟล์ config.php ถูกต้อง

// คำสั่ง SQL สำหรับสร้างตาราง
$table = "CREATE TABLE product8 (
    id INT(6) AUTO_INCREMENT COMMENT 'รหัสสินค้า',
    name VARCHAR(100) COMMENT 'ชื่อสินค้า',
    price VARCHAR(100) COMMENT 'ราคาสินค้า',
    image VARCHAR(100) COMMENT 'รูปสินค้า',
    Created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่สร้าง',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่อัพเดท',
    PRIMARY KEY (id)
)";

// ตรวจสอบการรันคำสั่ง SQL
if ($conn->query($table) === TRUE) {
    echo "สร้างตาราง product สำเร็จ";
} else {
    echo "Error creating table: " . $conn->error;
}

// ปิดการเชื่อมต่อ
$conn->close();
?>

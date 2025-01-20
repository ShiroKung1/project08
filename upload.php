<?php
include('config.php');

$mes = []; // ข้อความตอบกลับ

try {
    // ตรวจสอบว่าไฟล์ภาพถูกอัปโหลดหรือไม่
    if (!isset($_FILES['image']) || $_FILES['image']['error'] != UPLOAD_ERR_OK) {
        throw new Exception("รูปภาพไม่ถูกต้อง");
    }

    // จัดการไฟล์ภาพ
    $image = $_FILES['image'];
    $imagePath = 'upload/' . basename($image['name']);

    if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
        throw new Exception("อัปโหลดรูปภาพไม่สำเร็จ");
    }

    // รับข้อมูลจาก POST
    $name = $_POST['name'] ?? null;
    $price = $_POST['price'] ?? null;

    if (!$name || !$price) {
        throw new Exception("ข้อมูลไม่ครบถ้วน");
    }

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO product8 (name, price, image, created_at) VALUES ('$name', '$price', '$imagePath', NOW())";
    $qr_insert = mysqli_query($conn, $sql);

    if ($qr_insert) {
        http_response_code(201);
        $mes['status'] = "success";
    } else {
        throw new Exception("ไม่สามารถเพิ่มข้อมูลได้: " . mysqli_error($conn));
    }
} catch (Exception $e) {
    http_response_code(422);
    $mes['status'] = "error";
    $mes['message'] = $e->getMessage();
}

// ส่งข้อมูลกลับในรูปแบบ JSON
echo json_encode($mes);
?>

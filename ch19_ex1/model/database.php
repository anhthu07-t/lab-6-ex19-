<?php
    // Cấu hình kết nối MySQL chuẩn dùng quyền root của XAMPP
    $dsn = 'mysql:host=localhost;dbname=my_guitar_shop1'; // Nếu bị lỗi CSDL thì đổi thành my_guitar_shop2
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
        // Thiết lập chế độ báo lỗi PDO Exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>
<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "data";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$username = $_POST["username"] ?? "";
$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

if (empty($username) || empty($email) || empty($password)) {
    die("Vui lòng nhập đầy đủ thông tin!");
}

$password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO user(fullname, email, password) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Lỗi SQL: " . $conn->error);
}

$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    echo "Đăng ký thành công!";
} else {
    echo "Lỗi: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
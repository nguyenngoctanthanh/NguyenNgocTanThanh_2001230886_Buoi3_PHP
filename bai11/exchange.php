<?php

header("Content-Type: application/json");

// Đọc file JSON
$data = file_get_contents("rates.json");

// Trả dữ liệu về JavaScript
echo $data;

?>
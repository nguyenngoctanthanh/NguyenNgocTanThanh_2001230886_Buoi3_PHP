<?php

$file = "todo.json";

// Nếu chưa có file thì tạo
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

// Đọc dữ liệu
$todos = json_decode(file_get_contents($file), true);

// Thêm công việc
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST["action"];

    // Thêm
    if ($action == "add") {

        $todos[] = [
            "text" => $_POST["text"],
            "done" => false
        ];
    }

    // Đánh dấu hoàn thành
    if ($action == "toggle") {

        $index = $_POST["index"];
        $todos[$index]["done"] = !$todos[$index]["done"];
    }

    // Xóa
    if ($action == "delete") {

        $index = $_POST["index"];
        array_splice($todos, $index, 1);
    }

    file_put_contents($file, json_encode($todos));
}

header("Content-Type: application/json");
echo json_encode($todos);

?>
<?php
$start = microtime(true);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "computerdictionary";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("اتصال ناموفق: " . $conn->connect_error);
}

$sql = "SELECT Term, TermAcronym FROM `term` ORDER BY TermInitialLetters;";
$result = $conn->query($sql);

$end = microtime(true);
$execution_time = $end - $start;
echo "زمان اجرای کوئری: " . $execution_time . " ثانیه";

$terms = [];
while ($row = $result->fetch_assoc()) {
    $terms[] = [
        "term" => strtolower($row["Term"]),
        "display" => $row["Term"] . (!empty($row["TermAcronym"]) ? " | " . $row["TermAcronym"] : "")
    ];
}


// ذخیره داده‌ها در یک فایل JavaScript
$fileContent = "let terms = " . json_encode($terms, JSON_UNESCAPED_UNICODE) . ";";
file_put_contents("../static/js/terms.js", $fileContent);
<?php
require_once "../server/db.php";

$form_id = $_GET['form_id'] ?? null;

$public_key = $_GET['key'] ?? null;

if (!$form_id) {
    die("Form ID missing");
}

$stmt = mysqli_prepare(
    $conn,
    "SELECT id, name, email, submitted_at, user_ip 
     FROM submissions 
     WHERE form_id = ?
     ORDER BY submitted_at DESC"
);

mysqli_stmt_bind_param($stmt, "i", $form_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
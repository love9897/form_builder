<?php
session_start();
require_once "../server/db.php";

$form_id = $_GET['id'] ?? null;
if (!$form_id) {
    die("Form ID missing");
}

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM form_fields WHERE form_id = ? ORDER BY id ASC"
);
mysqli_stmt_bind_param($stmt, "i", $form_id);

mysqli_stmt_execute($stmt);

$fields = mysqli_stmt_get_result($stmt);
?>
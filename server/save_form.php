<?php
require_once "./db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $form_name = trim($_POST['form_name']);
    $form_description = trim($_POST['form_description']);

    $public_key = bin2hex(random_bytes(8));

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO forms (name, description, public_key) VALUES (?, ?,?)"
    );

    mysqli_stmt_bind_param($stmt, "sss", $form_name, $form_description, $public_key);

    mysqli_stmt_execute($stmt);

    $form_id = mysqli_insert_id($conn);

    mysqli_stmt_close($stmt);


    header("Location: ../admin/add_fields.php?form_id=" . $form_id);
    exit;
}

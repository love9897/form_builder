<?php
session_start();
require_once "./db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $form_id = $_POST['form_id'];
    $labels = $_POST['field_label'];
    $types = $_POST['field_type'];
    $placeholders = $_POST['placeholder'];
    $required = $_POST['required'];
    $options = $_POST['options'];

    /* Insert fields */
    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO form_fields 
        (form_id, label, type, placeholder, options, is_required)
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    for ($i = 0; $i < count($labels); $i++) {

        $label = trim($labels[$i]);
        if ($label === "")
            continue;

        $type = $types[$i];
        $ph = $placeholders[$i];
        $opt = $options[$i] ?? null;
        $req = $required[$i];

        mysqli_stmt_bind_param(
            $stmt,
            "issssi",
            $form_id,
            $label,
            $type,
            $ph,
            $opt,
            $req
        );

        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);


    $key_stmt = mysqli_prepare(
        $conn,
        "SELECT public_key FROM forms WHERE id = ?"
    );
    mysqli_stmt_bind_param($key_stmt, "i", $form_id);
    mysqli_stmt_execute($key_stmt);

    $result = mysqli_stmt_get_result($key_stmt);
    $form = mysqli_fetch_assoc($result);

    mysqli_stmt_close($key_stmt);


    $_SESSION['success'] = "Form created successfully!";
    $_SESSION['link'] =
        "http://localhost/FormBuilder/public/form.php?key=" . $form['public_key'];

    header("Location: ../admin/index.php");
    exit;
}

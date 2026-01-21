<?php
require_once "./db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request");
}

$form_id = $_POST['form_id'];
$email = $_POST['email'];
$name = $_POST['name'];
$user_ip = $_SERVER['REMOTE_ADDR'];



$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO submissions (form_id, name, email, user_ip) VALUES (?, ?,? ,?)"
);

mysqli_stmt_bind_param($stmt, "isss", $form_id, $name, $email, $user_ip);
mysqli_stmt_execute($stmt);

$submission_id = mysqli_insert_id($conn);
mysqli_stmt_close($stmt);


$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO submissions_values 
     (submission_id, field_id, value)
     VALUES (?, ?, ?)"
);

foreach ($_POST as $key => $value) {

    if ($key === 'form_id') {
        continue;
    }

    if (strpos($key, 'field_') === 0) {

        $field_id = (int) str_replace('field_', '', $key);


        if (is_array($value)) {
            $value = implode(', ', $value);
        }

        mysqli_stmt_bind_param(
            $stmt,
            "iis",
            $submission_id,
            $field_id,
            $value
        );

        mysqli_stmt_execute($stmt);
    }
}

mysqli_stmt_close($stmt);


header("Location: ../public/thank_you.php");
exit;

<?php
require_once "../server/db.php";

$form_id = $_GET['id'] ?? null;

if (!$form_id) {
    die("Invalid request");
}


mysqli_begin_transaction($conn);

try {


    mysqli_query(
        $conn,
        "DELETE sv FROM submissions_values sv
         JOIN submissions s ON sv.submission_id = s.id
         WHERE s.form_id = $form_id"
    );


    mysqli_query(
        $conn,
        "DELETE FROM submissions WHERE form_id = $form_id"
    );


    mysqli_query(
        $conn,
        "DELETE FROM form_fields WHERE form_id = $form_id"
    );


    mysqli_query(
        $conn,
        "DELETE FROM forms WHERE id = $form_id"
    );

    mysqli_commit($conn);

    header("Location: ../admin/index.php");
    exit;

} catch (Exception $e) {

    mysqli_rollback($conn);
    die("Failed to delete form");
}

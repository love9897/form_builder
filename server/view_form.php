<?php
require_once "../server/db.php";


$public_key = $_GET['key'] ?? '';

if ($public_key === '') {
    die("Invalid form link");
}

/* Fetch form */
$form_stmt = mysqli_prepare(
    $conn,
    "SELECT id, name, description FROM forms WHERE public_key = ?"
);
mysqli_stmt_bind_param($form_stmt, "s", $public_key);
mysqli_stmt_execute($form_stmt);

$form_result = mysqli_stmt_get_result($form_stmt);
$form = mysqli_fetch_assoc($form_result);

if (!$form) {
    die("Form not found");
}

$form_id = $form['id'];

/* Fetch fields */
$field_stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM form_fields WHERE form_id = ? ORDER BY id ASC"
);
mysqli_stmt_bind_param($field_stmt, "i", $form_id);
mysqli_stmt_execute($field_stmt);

$fields = mysqli_stmt_get_result($field_stmt);



$submission_id = $_GET['submission_id'] ?? 0;


if ($submission_id) {
    $submission = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM submissions WHERE id = $submission_id")
    );

    $values_result = mysqli_query(
        $conn,
        "SELECT field_id, value FROM submissions_values WHERE submission_id = $submission_id"
    );

    $filled_values = [];
    while ($row = mysqli_fetch_assoc($values_result)) {
        $filled_values[$row['field_id']] = $row['value'];
    }


}

?>
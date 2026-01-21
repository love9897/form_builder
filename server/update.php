<?php
session_start();
require_once "./db.php";

$form_id = $_POST['form_id'];
$labels = $_POST['label'];
$types = $_POST['type'];
$placeholders = $_POST['placeholder'];
$required = $_POST['is_required'];
$options = $_POST['options'] ?? [];
$field_ids = $_POST['field_id'] ?? [];
$edit_mode = $_POST['edit_mode'] ?? false;

$existing_ids = [];
$res = mysqli_query(
    $conn,
    "SELECT id FROM form_fields WHERE form_id = $form_id"
);
while ($row = mysqli_fetch_assoc($res)) {
    $existing_ids[] = $row['id'];
}

$submitted_ids = array_filter($field_ids); // remove empty
$to_delete = array_diff($existing_ids, $submitted_ids);

if (!empty($to_delete)) {
    $ids = implode(',', $to_delete);
    mysqli_query(
        $conn,
        "DELETE FROM form_fields WHERE id IN ($ids) AND form_id = $form_id"
    );
}

for ($i = 0; $i < count($labels); $i++) {

    if (trim($labels[$i]) === '')
        continue;

    $req = $required[$i] ?? 0;
    $opt = $options[$i] ?? null;

    if ($edit_mode && !empty($field_ids[$i])) {

        // UPDATE
        $stmt = mysqli_prepare(
            $conn,
            "UPDATE form_fields
             SET label=?, type=?, placeholder=?, options=?, is_required=?
             WHERE id=? AND form_id=?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssssiii",
            $labels[$i],
            $types[$i],
            $placeholders[$i],
            $opt,
            $req,
            $field_ids[$i],
            $form_id
        );

    } else {


        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO form_fields
             (form_id, label, type, placeholder, options, is_required)
             VALUES (?, ?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "issssi",
            $form_id,
            $labels[$i],
            $types[$i],
            $placeholders[$i],
            $opt,
            $req
        );
    }

    mysqli_stmt_execute($stmt);
}

$_SESSION['success'] = "Form updated successfully!";
header("Location: ../admin/index.php");
exit;

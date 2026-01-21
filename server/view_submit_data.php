<?php

$submission_id = $_GET['submission_id'] ?? 0;

$submission = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM form_submissions WHERE id = $submission_id")
);

$values_result = mysqli_query(
    $conn,
    "SELECT field_id, value FROM submission_values WHERE submission_id = $submission_id"
);

$filled_values = [];
while ($row = mysqli_fetch_assoc($values_result)) {
    $filled_values[$row['field_id']] = $row['value'];
}
<?php
require_once "../server/edit_fields.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fields | Form Builder</title>

    <link rel="stylesheet" href="../assets/css/add_fields.css">
</head>

<body>

    <div class="container">
        <h2>Edit Form Fields</h2>
        <div class="sub-text">Update your form fields below</div>

        <form method="POST" action="../server/update.php">

            <input type="hidden" name="form_id" value="<?= $form_id ?>">
            <input type="hidden" name="edit_mode" value="1">

            <div id="fieldsWrapper">

                <?php while ($field = mysqli_fetch_assoc($fields)): ?>
                    <div class="field-row">

                        <!-- IMPORTANT -->
                        <input type="hidden" name="field_id[]" value="<?= $field['id'] ?>">

                        <div class="row">
                            <div class="form-group">
                                <label>Field Label</label>
                                <input type="text" name="label[]" value="<?= htmlspecialchars($field['label']) ?>">
                            </div>

                            <div class="form-group">
                                <label>Field Type</label>
                                <select name="type[]" class="field-type">
                                    <?php
                                    $types = ['text', 'email', 'number', 'textarea', 'dropdown', 'radio', 'checkbox'];
                                    foreach ($types as $type):
                                        ?>
                                        <option value="<?= $type ?>" <?= $field['type'] === $type ? 'selected' : '' ?>>
                                            <?= ucfirst($type) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label>Placeholder</label>
                                <input type="text" name="placeholder[]"
                                    value="<?= htmlspecialchars($field['placeholder']) ?>">
                            </div>

                            <div class="form-group">
                                <label>Required</label>
                                <select name="is_required[]">
                                    <option value="0" <?= $field['is_required'] == 0 ? 'selected' : '' ?>>No</option>
                                    <option value="1" <?= $field['is_required'] == 1 ? 'selected' : '' ?>>Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group option-box">
                            <label>Options (comma separated)</label>
                            <textarea name="options[]"><?= $field['options'] ?></textarea>
                        </div>

                        <button type="button" class="btn btn-remove">Remove Field</button>
                    </div>
                <?php endwhile; ?>

            </div>

            <button type="button" class="btn btn-add" id="addFieldBtn">+ Add Another Field</button>
            <button type="submit" class="btn btn-save">Save All Fields</button>
        </form>
    </div>

    <script src="../assets/js/add_fields.js"></script>
</body>

</html>
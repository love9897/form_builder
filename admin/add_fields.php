<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Fields | Form Builder</title>

    <link rel="stylesheet" href="../assets/css/add_fields.css">
</head>

<body>

    <div class="container">
        <h2>Add Form Fields</h2>
        <div class="sub-text">Design your form fields below</div>
        <?php
        $form_id = $_GET['form_id'];
        ?>

        <form method="POST" action="../server/save_fields.php">
            <input type="hidden" name="form_id" value="<?= $form_id ?>">

            <div id="fieldsWrapper">

                <!-- FIELD ROW -->
                <div class="field-row">
                    <div class="row">
                        <div class="form-group">
                            <label>Field Label</label>
                            <input type="text" name="field_label[]" placeholder="e.g. Email Address">
                        </div>

                        <div class="form-group">
                            <label>Field Type</label>
                            <select name="field_type[]" class="field-type">
                                <option value="text">Text</option>
                                <option value="email">Email</option>
                                <option value="number">Number</option>
                                <option value="textarea">Textarea</option>
                                <option value="dropdown">Dropdown</option>
                                <option value="radio">Radio</option>
                                <option value="checkbox">Checkbox</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label>Placeholder</label>
                            <input type="text" name="placeholder[]" placeholder="Enter value">
                        </div>

                        <div class="form-group">
                            <label>Required</label>
                            <select name="required[]">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group option-box">
                        <label>Options (comma separated)</label>
                        <textarea name="options[]" placeholder="Option 1, Option 2"></textarea>
                    </div>

                    <button type="button" class="btn btn-remove">Remove Field</button>
                </div>

            </div>

            <button type="button" class="btn btn-add" id="addFieldBtn">+ Add Another Field</button>
            <button type="submit" class="btn btn-save">Save All Fields</button>
        </form>

    </div>

    <script src="../assets/js/add_fields.js"></script>
</body>

</html>
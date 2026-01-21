<?php
require_once "../server/view_form.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($form['name']) ?></title>
    <link rel="stylesheet" href="../assets/css/view_form.css">
</head>

<body>

    <div class="form-wrapper">
        <h2><?= $form['name'] ?></h2>
        <p><?= $form['description'] ?></p>

        <form method="post" action="../server/submit_form.php">
            <input type="hidden" name="form_id" value="<?= $form_id ?>">

            <label for="name">Name</label>
            <input type="text" value="<?= $submission['name'] ?>" readonly>


            <label for="email">Email</label>
            <input type="email" value="<?= $submission['email'] ?>" readonly>


            <?php while ($field = mysqli_fetch_assoc($fields)): ?>
                <?php
                $value = $filled_values[$field['id']] ?? '';


                $checkedValues = explode(',', $value);
                ?>
                <div class="field">
                    <label><?= $field['label'] ?></label>

                    <?php
                    $required = ($field['is_required'] == 1) ? 'required' : '';
                    $options = array_map('trim', explode(',', $field['options']));
                    ?>

                    <?php if (in_array($field['type'], ['text', 'email', 'number'])): ?>
                        <input type="<?= $field['type'] ?>" name="field_<?= $field['id'] ?>"
                            value="<?= htmlspecialchars($value) ?>" readonly
                            placeholder="<?= htmlspecialchars($field['placeholder']) ?>" <?= $required ?>>


                    <?php elseif ($field['type'] === 'textarea'): ?>
                        <textarea name="field_<?= $field['id'] ?>" placeholder="<?= htmlspecialchars($field['placeholder']) ?>"
                            <?= $required ?> readonly><?= htmlspecialchars($value) ?></textarea>

                        <!-- DROPDOWN -->
                    <?php elseif ($field['type'] === 'dropdown'): ?>
                        <select name="field_<?= $field['id'] ?>" <?= $required ?> disabled>
                            <option value="">-- Select --</option>

                            <?php foreach ($options as $option): ?>
                                <option value="<?= htmlspecialchars($option) ?>" <?= ($option == $value) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($option) ?>
                                </option>
                            <?php endforeach; ?>

                        </select>


                        <!-- RADIO -->
                    <?php elseif ($field['type'] === 'radio'): ?>
                        <?php foreach ($options as $option): ?>
                            <div class="option">
                                <input type="radio" name="field_<?= $field['id'] ?>" value="<?= htmlspecialchars($option) ?>"
                                    <?= ($option == $value) ? 'checked' : '' ?> disabled <?= $required ?>>
                                <?= htmlspecialchars($option) ?>
                            </div>
                        <?php endforeach; ?>


                        <!-- CHECKBOX -->
                    <?php elseif ($field['type'] === 'checkbox'): ?>
                        <?php

                        $checkedValues = array_map('trim', explode(',', $value));
                        ?>
                        <?php foreach ($options as $option): ?>
                            <div class="option">
                                <input type="checkbox" name="field_<?= $field['id'] ?>[]" value="<?= htmlspecialchars($option) ?>"
                                    <?= in_array($option, $checkedValues) ? 'checked' : '' ?> disabled>
                                <?= htmlspecialchars($option) ?>
                            </div>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </div>
            <?php endwhile; ?>

            <!-- <button type="submit" >Submit</button> -->
        </form>
    </div>

</body>

</html>
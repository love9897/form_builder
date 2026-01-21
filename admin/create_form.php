<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Form | Admin</title>

    <link rel="stylesheet" href="../assets/css/create_form.css">
</head>

<body>

    <div class="form-box">
        <h2>Create New Form</h2>
        <p>Enter form details to get started</p>

        <form action="../server/save_form.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="form_name">Form Name</label>
                <input type="text" id="form_name" name="form_name" placeholder="e.g. Student Registration">
                <small id="nameError" class="error-text"></small>
            </div>

            <div class="form-group">
                <label for="form_description">Description</label>
                <textarea id="form_description" name="form_description"
                    placeholder="Short description about this form"></textarea>
            </div>

            <button type="submit" class="btn-submit">Create Form</button>
        </form>

        <a href="index.php" class="back-link">← Back to Dashboard</a>
    </div>

    <script src="../assets/js/create_form.js"></script>

</body>

</html>
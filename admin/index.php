<?php
session_start();
require_once "../server/db.php";

$success = $_SESSION['success'] ?? null;

// Fetch forms
$result = mysqli_query($conn, "SELECT * FROM forms ORDER BY id DESC");


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Panel | Form Builder</title>

    <link rel="stylesheet" href="../assets/css/index.css">
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <h2>Form Builder Admin</h2>
        <div class="header-actions">
            <a href="create_form.php">➕ Create Form</a>

        </div>
    </div>

    <!-- SUCCESS MESSAGE -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="success-box">
         <?= $_SESSION['success']; ?><br>

            <?php if (!empty($_SESSION['link'])): ?>
                Public Form URL:
                <a href="<?= $_SESSION['link']; ?>" target="_blank">
                    <?= $_SESSION['link']; ?>
                </a>
            <?php endif; ?>

            <span class="close-btn" onclick="this.parentElement.style.display='none'">✖</span>
        </div>

        <?php
        unset($_SESSION['success']);
        unset($_SESSION['link']);
        ?>
    <?php endif; ?>



    <!-- CONTENT -->
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Form Name</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>

                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['description']) ?></td>
                            <td><?= date('d-m-Y', strtotime($row['created_at'])) ?></td>
                            <td class="actions">
                                <!-- View Form (Public) -->
                                <a href="../public/form.php?key=<?= $row['public_key'] ?>" class="view" target="_blank"
                                    title="View Form">👁</a>

                                <!-- View Submissions -->
                                <a href="../admin/view_submission.php?form_id=<?= $row['id'] ?>&key=<?= $row['public_key'] ?>"
                                    class="submissions" title="View Submissions">📊</a>

                                <!-- Edit Form -->
                                <a href="../admin/edit_form.php?id=<?= $row['id'] ?>" class="edit" title="Edit Form">✏️</a>

                                <!-- Delete Form -->
                                <a href="../server/delete.php?id=<?= $row['id'] ?>" class="delete" title="Delete Form"
                                    onclick="return confirm('Delete this form?')">🗑</a>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="empty">No forms created yet</td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
    </div>

    <script>
        function closeSuccess() {
            document.getElementById('successBox').style.display = 'none';
        }
    </script>
</body>

</html>
<?php
require_once "../server/submited_data.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Submissions</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f1f1f1;
        }

        .action a {
            text-decoration: none;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Form Submissions</h2>

        <?php if (mysqli_num_rows($result) === 0): ?>
            <p>No submissions found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Submitted At</th>
                        <th>User IP</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row['name'] ?? '' ?></td>
                            <td><?= $row['email'] ?? '' ?></td>
                            <td><?= date('d-m-Y', strtotime($row['submitted_at'])) ?></td>
                            <td><?= $row['user_ip'] ?></td>
                            <td class="action">
                                <a href="view_user_data.php?submission_id=<?= $row['id']; ?>&key=<?= $public_key ?>"
                                    title="View">
                                    view
                                </a>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</body>

</html>
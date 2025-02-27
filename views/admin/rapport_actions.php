<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rapport des Actions</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
</head>
<body>
    <?php include 'views/include/sidebar.php'; ?>
    <div class="main-content">
        <h2>Rapport des Actions</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Utilisateur</th>
                    <th>Action</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($actions as $action): ?>
                    <tr>
                        <td><?php echo $action['id']; ?></td>
                        <td><?php echo $action['user_id']; ?></td>
                        <td><?php echo $action['action']; ?></td>
                        <td><?php echo $action['date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include 'views/include/footer.php'; ?>
</body>
</html>
<?php
require_once 'Urusan.php';
$urusan = new Urusan();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $urusan->create($_POST['nama_urusan']);
    } elseif (isset($_POST['update'])) {
        $urusan->update($_POST['id_urusan'], $_POST['nama_urusan']);
    } elseif (isset($_POST['delete'])) {
        $urusan->delete($_POST['id_urusan']);
    }
}
$urusans = $urusan->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Urusan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">CRUD Urusan</h1>
        
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <label for="nama_urusan" class="form-label">Nama Urusan</label>
                <input type="text" class="form-control" id="nama_urusan" name="nama_urusan" required>
            </div>
            <button type="submit" name="create" class="btn btn-primary">Create</button>
        </form>

        <h2 class="mt-5">Data Urusan</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Urusan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($urusans->num_rows > 0): ?>
                    <?php while($row = $urusans->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_urusan']; ?></td>
                            <td><?php echo $row['nama_urusan']; ?></td>
                            <td>
                                <form method="POST" style="display:inline-block">
                                    <input type="hidden" name="id_urusan" value="<?php echo $row['id_urusan']; ?>">
                                    <input type="text" name="nama_urusan" value="<?php echo $row['nama_urusan']; ?>" required>
                                    <button type="submit" name="update" class="btn btn-warning btn-sm">Update</button>
                                </form>
                                <form method="POST" style="display:inline-block">
                                    <input type="hidden" name="id_urusan" value="<?php echo $row['id_urusan']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="index.php" class="btn btn-secondary mt-3">Back to Home</a>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>


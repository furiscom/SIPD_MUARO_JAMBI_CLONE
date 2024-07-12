<?php
require_once 'BidangUrusan.php';
$bidangUrusan = new BidangUrusan();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $bidangUrusan->create($_POST['id_urusan'], $_POST['nama_bidang_urusan']);
    } elseif (isset($_POST['update'])) {
        $bidangUrusan->update($_POST['id_bidang_urusan'], $_POST['nama_bidang_urusan']);
    } elseif (isset($_POST['delete'])) {
        $bidangUrusan->delete($_POST['id_bidang_urusan']);
    }
}
$bidangUrusans = $bidangUrusan->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Bidang Urusan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">CRUD Bidang Urusan</h1>
        
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <label for="id_urusan" class="form-label">ID Urusan</label>
                <input type="number" class="form-control" id="id_urusan" name="id_urusan" required>
            </div>
            <div class="mb-3">
                <label for="nama_bidang_urusan" class="form-label">Nama Bidang Urusan</label>
                <input type="text" class="form-control" id="nama_bidang_urusan" name="nama_bidang_urusan" required>
            </div>
            <button type="submit" name="create" class="btn btn-primary">Create</button>
        </form>

        <h2 class="mt-5">Data Bidang Urusan</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Urusan</th>
                    <th>Nama Bidang Urusan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($bidangUrusans->num_rows > 0): ?>
                    <?php while($row = $bidangUrusans->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_bidang_urusan']; ?></td>
                            <td><?php echo $row['id_urusan']; ?></td>
                            <td><?php echo $row['nama_bidang_urusan']; ?></td>
                            <td>
                                <form method="POST" style="display:inline-block">
                                    <input type="hidden" name="id_bidang_urusan" value="<?php echo $row['id_bidang_urusan']; ?>">
                                    <input type="hidden" name="id_urusan" value="<?php echo $row['id_urusan']; ?>">
                                    <input type="text" name="nama_bidang_urusan" value="<?php echo $row['nama_bidang_urusan']; ?>" required>
                                    <button type="submit" name="update" class="btn btn-warning btn-sm">Update</button>
                                </form>
                                <form method="POST" style="display:inline-block">
                                    <input type="hidden" name="id_bidang_urusan" value="<?php echo $row['id_bidang_urusan']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="index.php" class="btn btn-secondary mt-3">Back to Home</a>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>


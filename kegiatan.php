<?php
require_once 'Kegiatan.php';
$kegiatan = new Kegiatan();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $kegiatan->create($_POST['id_program'], $_POST['nama_kegiatan']);
    } elseif (isset($_POST['update'])) {
        $kegiatan->update($_POST['id_kegiatan'], $_POST['nama_kegiatan']);
    } elseif (isset($_POST['delete'])) {
        $kegiatan->delete($_POST['id_kegiatan']);
    }
}
$kegiatans = $kegiatan->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Kegiatan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">CRUD Kegiatan</h1>
        
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <label for="id_program" class="form-label">ID Program</label>
                <input type="number" class="form-control" id="id_program" name="id_program" required>
            </div>
            <div class="mb-3">
                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" required>
            </div>
            <button type="submit" name="create" class="btn btn-primary">Create</button>
        </form>

        <h2 class="mt-5">Data Kegiatan</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Program</th>
                    <th>Nama Kegiatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($kegiatans->num_rows > 0): ?>
                    <?php while($row = $kegiatans->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_kegiatan']; ?></td>
                            <td><?php echo $row['id_program']; ?></td>
                            <td><?php echo $row['nama_kegiatan']; ?></td>
                            <td>
                                <form method="POST" style="display:inline-block">
                                    <input type="hidden" name="id_kegiatan" value="<?php echo $row['id_kegiatan']; ?>">
                                    <input type="hidden" name="id_program" value="<?php echo $row['id_program']; ?>">
                                    <input type="text" name="nama_kegiatan" value="<?php echo $row['nama_kegiatan']; ?>" required>
                                    <button type="submit" name="update" class="btn btn-warning btn-sm">Update</button>
                                </form>
                                <form method="POST" style="display:inline-block">
                                    <input type="hidden" name="id_kegiatan" value="<?php echo $row['id_kegiatan']; ?>">
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

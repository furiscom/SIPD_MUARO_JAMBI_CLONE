<?php
require_once 'Program.php';
$program = new Program();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $program->create($_POST['id_bidang_urusan'], $_POST['nama_program']);
    } elseif (isset($_POST['update'])) {
        $program->update($_POST['id_program'], $_POST['nama_program']);
    } elseif (isset($_POST['delete'])) {
        $program->delete($_POST['id_program']);
    }
}
$programs = $program->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Program</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">CRUD Program</h1>
        
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <label for="id_bidang_urusan" class="form-label">ID Bidang Urusan</label>
                <input type="number" class="form-control" id="id_bidang_urusan" name="id_bidang_urusan" required>
            </div>
            <div class="mb-3">
                <label for="nama_program" class="form-label">Nama Program</label>
                <input type="text" class="form-control" id="nama_program" name="nama_program" required>
            </div>
            <button type="submit" name="create" class="btn btn-primary">Create</button>
        </form>

        <h2 class="mt-5">Data Program</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Bidang Urusan</th>
                    <th>Nama Program</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($programs->num_rows > 0): ?>
                    <?php while($row = $programs->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_program']; ?></td>
                            <td><?php echo $row['id_bidang_urusan']; ?></td>
                            <td><?php echo $row['nama_program']; ?></td>
                            <td>
                                <form method="POST" style="display:inline-block">
                                    <input type="hidden" name="id_program" value="<?php echo $row['id_program']; ?>">
                                    <input type="hidden" name="id_bidang_urusan" value="<?php echo $row['id_bidang_urusan']; ?>">
                                    <input type="text" name="nama_program" value="<?php echo $row['nama_program']; ?>" required>
                                    <button type="submit" name="update" class="btn btn-warning btn-sm">Update</button>
                                </form>
                                <form method="POST" style="display:inline-block">
                                    <input type="hidden" name="id_program" value="<?php echo $row['id_program']; ?>">
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

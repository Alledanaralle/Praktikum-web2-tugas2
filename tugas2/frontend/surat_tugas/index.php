<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Surat Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'poppins', sans-serif;">
    <div class="container mt-5">
        <h2>Daftar Surat Tugas (Admin)</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Dosen</th>
                    <th>Nomor</th>
                    <th>Nama Dosen</th>
                    <th>Tanggal Surat</th>
                    <th>Transportasi</th>
                    <th>Keperluan</th>
                    <th>Tujuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../../db/database.php';
                include_once '../../backend/surattugas.php';

                $database = new Database();
                $db = $database->getConnection();

                $surat_tugas = new SuratTugas($db);
                $stmt = $surat_tugas->read();

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        echo "<tr>
                            <td>{$surat_tugas_id}</td>
                            <td>{$dosen_id}</td>
                            <td>{$nomor}</td>
                            <td>{$nama_dsn}</td>
                            <td>{$tgl_surat_tugas}</td>
                            <td>{$transportasi}</td>
                            <td>{$keperluan}</td>
                            <td>{$tujuan}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No data found.</td></tr>";
                }
                echo "
                <button class='btn btn-primary mb-3'><a class='text-white' style='text-decoration: none;' href='index2.php'>{$dosen->getPermissions()}</a></button>";
                ?>
            </tbody>
        </table>
        <a class="btn btn-danger mt-3" href="./../../../tugas2/index.php">Menu</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

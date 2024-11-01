<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pegawai</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Form Data Pegawai</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="kode_pegawai">Kode Pegawai:</label>
            <input type="text" class="form-control" id="kode_pegawai" name="kode_pegawai" maxlength="5" required>
        </div>

        <div class="form-group">
            <label for="nama_pegawai">Nama Pegawai:</label>
            <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" maxlength="20" required>
        </div>

        <div class="form-group">
            <label for="jabatan">Jabatan:</label>
            <select class="form-control" id="jabatan" name="jabatan" required>
                <option value="PRODUKSI">PRODUKSI</option>
                <option value="QC">QC</option>
                <option value="HELPDESK">HELPDESK</option>
                <option value="FINANCE">FINANCE</option>
                <option value="HRD">HRD</option>
            </select>
        </div>

        <div class="form-group">
            <label for="alamat_pegawai">Alamat Pegawai:</label>
            <input type="text" class="form-control" id="alamat_pegawai" name="alamat_pegawai" maxlength="50" required>
        </div>

        <div class="form-group">
            <label for="no_hp">No HP:</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" maxlength="10" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" maxlength="20" required>
        </div>

        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        <button type="reset" class="btn btn-secondary">Batal</button>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $conn = new mysqli('localhost', 'root', 'berasputih', 'db_pegawai');

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }
        $kode_pegawai = $_POST['kode_pegawai'];
        $nama_pegawai = $_POST['nama_pegawai'];
        $jabatan = $_POST['jabatan'];
        $alamat_pegawai = $_POST['alamat_pegawai'];
        $no_hp = $_POST['no_hp'];
        $email = $_POST['email'];

        $checkQuery = "SELECT * FROM tm_pegawai WHERE kode_pegawai = '$kode_pegawai'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            echo "<script>alert('Kode Pegawai Sudah Terdaftar (Duplicate)');</script>";
        } else {
            $sql = "INSERT INTO tm_pegawai (kode_pegawai, nama_pegawai, jabatan, alamat_pegawai, no_hp, email) 
                    VALUES ('$kode_pegawai', '$nama_pegawai', '$jabatan', '$alamat_pegawai', '$no_hp', '$email')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success mt-3'>Data berhasil disimpan!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
            }
        }

        $conn->close();
    }
    ?>
    
    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

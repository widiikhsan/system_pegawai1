<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pegawai</title>
</head>
<body>
    <h2>Form Data Pegawai</h2>
    <form method="POST" action="">
        <label for="kode_pegawai">Kode Pegawai:</label>
        <input type="text" id="kode_pegawai" name="kode_pegawai" maxlength="5" required><br><br>

        <label for="nama_pegawai">Nama Pegawai:</label>
        <input type="text" id="nama_pegawai" name="nama_pegawai" maxlength="20" required><br><br>

        <label for="jabatan">Jabatan:</label>
        <select id="jabatan" name="jabatan" required>
            <option value="PRODUKSI">PRODUKSI</option>
            <option value="QC">QC</option>
            <option value="HELPDESK">HELPDESK</option>
            <option value="FINANCE">FINANCE</option>
            <option value="HRD">HRD</option>
        </select><br><br>

        <label for="alamat_pegawai">Alamat Pegawai:</label>
        <input type="text" id="alamat_pegawai" name="alamat_pegawai" maxlength="50" required><br><br>

        <label for="no_hp">No HP:</label>
        <input type="text" id="no_hp" name="no_hp" maxlength="10" required><br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" maxlength="20" required><br><br>

        <button type="submit" name="simpan">Simpan</button>
        <button type="reset">Batal</button>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $conn = new mysqli('localhost', 'root', '', 'db_pegawai');

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
                echo "Data berhasil disimpan!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

                $conn->close();
            }
            ?>
        </body>
        </html>
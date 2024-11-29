<?php
// Menghubungkan dengan file koneksi
include 'koneksiDB.php';

// Variabel untuk menyimpan pesan
$message = '';

if (isset($_POST['submit'])) {
  $NAMA = $_POST['nama'];
  $EMAIL = $_POST['email'];
  $ISI = $_POST['isi'];

  // Query untuk insert data ke tabel buku_tamu
  $sql = "INSERT INTO buku_tamu (NAMA, EMAIL, ISI) VALUES ('$NAMA', '$EMAIL', '$ISI')";

  if (mysqli_query($koneksi, $sql)) {
    $message = "<div class='alert alert-success' role='alert'>Data berhasil ditambahkan!</div>";
  } else {
    $message = "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . mysqli_error($koneksi) . "</div>";
  }
}

// Wuery untuk mengambil data tamu
$query = "SELECT * FROM buku_tamu";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu</title>
    <!-- Link ke CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Form Isi Buku Tamu</h2>
        <form action="index.php" method="post">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama:</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email:</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
              <label for="isi" class="form-label">Isi:</label>
              <textarea class="form-control" id="isi" name="isi" rows="4" required></textarea>
            </div>

            <!-- Menampilkan pesan -->
            <?php if ($message): ?>
              <div class="mt-3">
                <?php echo $message; ?>
              </div>
            <?php endif; ?>

            <button type="submit" name="submit" class="btn btn-success">Kirim</button>
        </form>

        <!-- Tabel Daftar Buku Tamu -->
        <h3 class="mt-5 text-center">Daftar Buku Tamu</h3>
        <table class="table table-striped mt-3">
          <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Isi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['ID']}</td>
                        <td>{$row['NAMA']}</td>
                        <td>{$row['EMAIL']}</td>
                        <td>{$row['ISI']}</td>
                      </tr>";
              }
            } else {
                echo "<tr><td colspan='4' class='text-center'>Tidak ada data tamu.</td></tr>";
            }
            ?>
          </tbody>
        </table>
    </div>

    <!-- Link ke JS Bootstrap 5 (opsional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
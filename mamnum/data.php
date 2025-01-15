<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "kuliner";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { 
    die("Tidak bisa terkoneksi ke database");
}
$nama       = "";
$daerah_asal = "";
$pilihan    = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM kuliner WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM kuliner WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nama = $r1['nama'];
    $daerah_asal = $r1['daerah_asal'];
    $pilihan = $r1['pilihan'];

    if ($nama == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { 
    $nama = $_POST['nama'];
    $daerah_asal = $_POST['daerah_asal'];
    $pilihan = $_POST['pilihan'];

    if ($nama && $daerah_asal && $pilihan) {
        if ($op == 'edit') { 
            $sql1 = "update kuliner set nama='$nama', daerah_asal='$daerah_asal', pilihan='$pilihan' WHERE id = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error = "Data gagal diupdate";
            }
        } else {
            $sql1 = "insert into kuliner(nama, daerah_asal, pilihan) VALUES ('$nama', '$daerah_asal', '$pilihan')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuliner Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="assets/img/logooo.jpeg" rel="icon">
  <link href="assets/img/logooo.jpeg" rel="logo">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <link href="assets/css/main.css" rel="stylesheet">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 60px;
        }
    </style>
</head>

<body>
<header id="header" class="header fixed-top">

<div class="topbar d-flex align-items-center">
  <div class="container d-flex justify-content-center justify-content-md-between">
    <div class="contact-info d-flex align-items-center">
      <i class="bi bi-envelope d-flex align-items-center"><a href="RA. Fadilah Amalia">RA. Fadilah Amalia</a></i>
      <i class="bi bi-phone d-flex align-items-center ms-4"><span>312310298</span></i>
    </div>
  </div>
</div>

<div class="branding d-flex align-items-center">

  <div class="container position-relative d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
    
      <h1 class="sitename">mamnum</h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="index.html" class="active">Home</a></li>
        <li><a href="index.html">About</a></li>
        <li><a href="index.html">Contact</a></li>
        <li><a href="Data.php">Data</a></li>
        <li><a href="table.php">table</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>

</div>

</header>
    <div class="mx -auto">
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    exit();
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    exit();
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="daerah asal" class="col-sm-2 col-form-label">Daerah Asal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="daerah_asal" name="daerah_asal" value="<?php echo $daerah_asal ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pilihan" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="pilihan" id="pilihan">
                                <option value="">- Pilihan -</option>
                                <option value="makanan" <?php if ($pilihan == "makanan") echo "selected" ?>>Makanan</option>
                                <option value="minuman" <?php if ($pilihan == "minuman") echo "selected" ?>>Minuman</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-danger" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
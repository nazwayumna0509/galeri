<?php
session_start();
include 'koneksi.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WEB Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="home.php">WEB GALERI FOTO</a></h1>
            <ul>
                <li><a href="home.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="dataimage.php">Album</a></li>
                <li><a href="logout.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Tambah Data Foto</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="UserID" value="<?php echo $_SESSION['a_global']->UserID ?>">
                    <input type="text" name="username" class="input-control"
                        value="<?php echo $_SESSION['a_global']->Username ?>" readonly="readonly">
                    <input type="text" name="namaAlbum" class="input-control" placeholder="Nama Album" required>
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br />
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    // print_r($_FILES[gambar']);
                    // menampung inputan dari form
                    $nama = $_POST['namaAlbum'];
                    $deskripsi = $_POST['deskripsi'];
                    $uid = $_POST['UserID'];
                    $tgl = date("Y:m:d");

                    //otomatis buat folder album
                    $sql = "INSERT INTO album(AlbumId,NamaAlbum,Deskripsi,TanggalDibuat,UserID) VALUES (null,'$nama','$deskripsi','$tgl','$uid')";
                    $insert = mysqli_query($conn, $sql) or die(mysqli_error());
                    if ($insert) {
                        mkdir("Asset/AlbumUser/" . $nama);
                        echo '<script>alert("Tambah Album berhasil")</script>';
                    } else {
                        echo 'gagal' . mysqli_error($conn);

                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Web Galeri Foto.</small>
        </div>
    </footer>
    <script>
        CKEDITOR.replace('deskripsi');
    </script>
    <script type="text/javascript"><?php echo $jsArray; ?></script>
</body>

</html>
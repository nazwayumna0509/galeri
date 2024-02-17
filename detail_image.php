<?php
error_reporting(0);
include 'koneksi.php';
$kontak = mysqli_query($conn, "SELECT Email, Password, Alamat FROM userr WHERE UserID = 2");
$a = mysqli_fetch_object($kontak);

$produk = mysqli_query($conn, "SELECT * FROM foto WHERE FotoID = '" . $_GET['id'] . "' ");
$p = mysqli_fetch_object($produk);
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
            <h1><a href="index.php">WEB GALERI FOTO</a></h1>
            <ul>
                <li><a href="galeri.php">Galeri</a></li>
                <li><a href="register.php">Registrasi</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </header>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto" value="<?php echo $_GET['search'] ?>" />
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" />
                <input type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>

    <!-- product detail -->
    <div class="section">
        <div class="container">
            <h3>Detail Foto</h3>
            <div class="box">
                <div class="col-2">
                    <img src="foto/<?php echo $p->foto ?>" width="100%" />
                </div>
                <div class="col-2">
                    <h3>
                        <?php echo $p->JudulFoto ?><br />Kategori :
                        <?php echo $p->NamaAlbum ?>
                    </h3>
                    <h4>Nama User :
                        <?php echo $p->Username ?><br />
                        Upload Pada Tanggal :
                        <?php echo $p->TanggalUnggah ?>
                    </h4>
                    <p>Deskripsi :<br />
                        <?php echo $p->DeskripsiFoto ?>
                    </p>

                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Web Galeri Foto.</small>
        </div>
    </footer>
</body>

</html>
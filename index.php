<?php
include 'koneksi.php';
$kontak = mysqli_query($conn, "SELECT Email, Password, Alamat FROM userr WHERE UserID = 2");
$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html>

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
                <input type="text" name="search" placeholder="Cari Foto" />
                <input type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>

    <!-- category -->
    <div class="section">
        <div class="container">
            <h3>Album</h3>
            <div class="box">
                <?php
                $album = mysqli_query($conn, "SELECT * FROM album ORDER BY AlbumID DESC");
                if (mysqli_num_rows($album) > 0) {
                    while ($k = mysqli_fetch_array($album)) {
                        ?>
                        <a href="galeri.php?kat=<?php echo $k['AlbumID'] ?>">
                            <div class="col-5">
                                <img src="Asset/album.png" width="50px" style="margin-bottom:5px;" />
                                <p>
                                    <?php echo $k['NamaAlbum'] ?>
                                </p>
                            </div>
                        </a>
                    <?php }
                } else { ?>
                    <p>Kategori tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- new product -->
    <div class="container">
        <h3>Foto Terbaru</h3>
        <div class="box">
            <?php
            $foto = mysqli_query($conn, "SELECT * FROM foto WHERE DeskripsiFoto = 1 ORDER BY FotoID DESC LIMIT 8");
            if (mysqli_num_rows($foto) > 0) {
                while ($p = mysqli_fetch_array($foto)) {
                    ?>
                    <a href="detail-foto.php?id=<?php echo $p['FotoID'] ?>">
                        <div class="col-4">
                            <img src="foto/<?php echo $p['FotoID'] ?>" height="150px" />
                            <p class="nama">
                                <?php echo substr($p['JudulFoto'], 0, 30) ?>
                            </p>
                            <p class="admin">Nama User :
                                <?php echo $p['UserID'] ?>
                            </p>
                            <p class="nama">
                                <?php echo $p['TanggalUnggah'] ?>
                            </p>
                        </div>
                    </a>
                <?php }
            } else { ?>
                <p>Foto tidak ada</p>
            <?php } ?>
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
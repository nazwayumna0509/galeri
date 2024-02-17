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

    <!-- album -->
    <div class="section">
        <div class="container">
            <h3>Daftar Album</h3>
            <div class="box">
                <p><a href="tambahalbum.php">Tambah Data</a></p>
                <?php
                $user = $_SESSION['a_global']->UserID;
                $album = mysqli_query($conn, "SELECT * FROM album WHERE UserID = '$user'");
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
                    <p>Tidak ada Album</p>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Data Foto</h3>
            <div class="box">
                <p><a href="tambahfoto.php">Tambah Data</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Album</th>
                            <th>Nama User</th>
                            <th>Nama Foto</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $user = $_SESSION['a_global']->UserID;
                        $foto = mysqli_query($conn, "SELECT * FROM foto WHERE UserID = '$user'");
                        if (mysqli_num_rows($foto) > 0) {
                            while ($row = mysqli_fetch_array($foto)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $no++ ?>
                                    </td>
                                    <td>
                                        <?php echo explode('/',$row['LokasiFile'])[2] ?>
                                    </td>
                                    <td>
                                    <?php echo $_SESSION['a_global']->Username ?>
                                    </td>
                                    <td>
                                        <?php echo $row['JudulFoto'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['DeskripsiFoto'] ?>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="<?php echo $row['LokasiFile'] ?>"><img
                                                src="<?php echo $row['LokasiFile'] ?>" width="100px">
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                        <a href="editimage.php?id=<?php echo $row['FotoID'] ?>">Edit</a> ||
                                        <a href="proses_hapus.php?idp=<?php echo $row['FotoID'] ?>"
                                            onclick="return confirm('Yakin Ingin Hapus ?')">Hapus</a>
                                        </center>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="8">Tidak ada data</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
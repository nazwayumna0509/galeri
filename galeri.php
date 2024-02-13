<?php
    error_reporting(0);
    include 'koneksi.php';
	$kontak = mysqli_query($conn, "SELECT Email, Password, Alamat FROM userr WHERE UserID = 2");
	$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="../css/style.css">
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

    <!-- new product -->
    <div class="section">
    <div class="container">
       <h3>Galeri Foto</h3>
       <div class="box">
          <?php
		      if($_GET['search'] != '' || $_GET['kat'] != ''){
			     $where = "AND JudulFoto LIKE '%".$_GET['search']."%' AND AlbumID LIKE '%".$_GET['kat']."%' ";
			  }
              $foto = mysqli_query($conn, "SELECT * FROM foto WHERE  = 1 $where ORDER BY FotoID DESC");
			  if(mysqli_num_rows($foto) > 0){
				  while($p = mysqli_fetch_array($foto)){
		  ?>
          <a href="detail-image.php?id=<?php echo $p['FotoID'] ?>">
          <div class="col-4">
              <img src="foto/<?php echo $p['foto'] ?>" height="150px" />
              <p class="nama"><?php echo substr($p['JudulFoto'], 0, 30) ?></p>
              <p class="harga"><?php echo substr($p['Username']) ?></p>
              <p class="userr">Nama User : <?php echo $p['Username'] ?></p>
              <p class="nama"><?php echo $p['TanggalDibuat'] ?></p>
          </div>
          </a>
          <?php }}else{ ?>
              <p>Foto tidak ada</p>
          <?php } ?>
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
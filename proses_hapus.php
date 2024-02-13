<?php

   include 'koneksi.php';
      
   if(isset($_GET['idp'])){
	   $foto = mysqli_query($conn, "SELECT foto FROM foto WHERE FotoID = '".$_GET['idp']."' ");
	   $p = mysqli_fetch_object($foto);
	   
	   unlink('./foto/'.$p->foto);
	   
	  $delete = mysqli_query($conn, "DELETE FROM foto WHERE FotoID = '".$_GET['idp']."' ");
	  echo '<script>window.location="dataimage.php"</script>';
   }

?>
<?php 
include "../conn123.php";
session_start();

if(!isset($_SESSION['username'])){
    ?>
    <script type="text/javascript">
        alert("anda belum login");
        window.location.href = "login.php";
    </script>
    <?php  
}

$getidproduk = $_GET['idproduk'];


//sanitize 1
$getidproduk1 = mysqli_real_escape_string($koneksi, $getidproduk);

//sanitize 2
$getidproduk2 = strip_tags($getidproduk1);


$dataProduk =  mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk ='$getidproduk2'");
if(mysqli_num_rows($dataProduk) > 0){
    while($dataProduct = mysqli_fetch_array($dataProduk)){
        $idproduk = $dataProduct['id_produk'];
        $namaproduk = $dataProduct['nama_produk'];
        $fotoproduk = $dataProduct['foto_produk'];
        $deskripsiproduk = $dataProduct['deskripsi_produk'];
        $fileproduk = $dataProduct['file_produk'];
        $kategoriproduk = $dataProduct['kategori_produk'];
        $hargaproduk = $dataProduct['harga_produk'];
        $pemilikproduk = $dataProduct['pemilik_produk'];
        $tanggalupload = $dataProduct['tanggal_upload'];
    }

}else{
    ?>
    <script type="text/javascript">
        alert("tidak ada produk yang ditemukan");
        window.location.href = "index.php";
    </script>
    <?php 
}



    function formatRupiah($angka) {
        return 'Rp ' . number_format($angka, 2, ',', '.');
    }

    $formatharga = formatRupiah($hargaproduk);


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $namaproduk; ?></title>

        <!-- CSS FILES -->        

        <link rel="stylesheet" type="text/css" href="../styledetail.css">


        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
                        
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <link href="../css/bootstrap-icons.css" rel="stylesheet">

        <link href="../css/templatemo-topic-listing.css" rel="stylesheet"> 

    </head>
<body>


      <main>



        <div style="display: flex; margin-top: 10px; margin-left: 20px;">
            <h1><a href="uploadproduk.php" style="font-style: italic; font-weight: bolder; font-size: 20px; color: black;">Kembali ke dashboard</a></h1>
        </div>

    


            <!-- ============================================ open produk ===================================================== -->

            <div class="product-detail-container" style="margin-top: 50px;">
                <div class="product-gallery">
                    <?php 

                    if(empty($fotoproduk)){
                        ?>
                            <img src="<?php echo $fotoproduk; ?>?height=500&width=500" alt="Smartphone Model X" class="main-image">
                        <?php  
                    }else{
                        ?>
                            <img src="images/noimage.png?height=500&width=500" alt="No Image" class="main-image">
                        <?php  
                    }

                     ?>
                    
                </div>

                <div class="product-info-section">
                    <h1 class="product-title"><?php echo $namaproduk; ?></h1>
                    
                    <div class="product-price">
                         <?php echo $formatharga; ?>
                    </div>

                    <p class="product-description">
                        <?php echo $deskripsiproduk; ?>
                    </p>
                    <?php 

                    $cekstatustransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_pembeli = '$iduser' and status_transaksi = 'pending'");
                    if(mysqli_num_rows($cekstatustransaksi) > 0){
                        ?>
                        <div class="product-actions">
                            <button class="buy-button" disabled style="background-color: grey;  color: white; pointer-events: none;">Beli Sekarang</button>
                            <p style="color: grey; font-style: italic; font-size: 13px;"><span style="color: red; font-weight: bolder;">Note </span>: Anda masih memiliki transaksi yang belum diselesaikan</p>
                        </div>
                        <?php  
                    }else{
                    	$confirmapprove = "confirmprocess.php?string=approve&idproduk=$idproduk";
                    	$confirmreject = "confirmprocess.php?string=reject&idproduk=$idproduk";

                        ?>
                       
                        <script type="text/javascript">
                        	function approved(){
                        		window.location.href = "<?php echo $confirmapprove; ?>";
                        	}

                        	function rejected(){
                        		window.location.href = "<?php echo $confirmreject; ?>"
                        	}
                        </script>

                        <div class="product-actions">
                            <button class="buy-button" onclick="approved()" style="color: white; background-color: green; padding: 10px; border-radius: 10px;  border: none;">Approve</button>
                            <button class="buy-button" onclick="rejected()" style="color: white; background-color: red; padding: 10px; border-radius: 10px;  border: none;">Reject</button>
                        </div>
                        <?php 
                    }
                     ?>
                    
                    
                    
                </div>
            </div>

            <!-- =========================================== close produk ===================================================-->







             </main>







   <!-- ================================================================= open footer ======================================================= -->
        <footer class="site-footer section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-12 mb-4 pb-2">
                        <a class="navbar-brand mb-2" href="index.html">
                            <!--<i class="bi-back"></i>-->
                            <span>SVELTIER</span>
                    
              
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <h6 class="site-footer-title mb-3">Menu</h6>

                        <ul class="site-footer-links">
                            <li class="site-footer-link-item">
                                <a href="index.php" class="site-footer-link">Beranda</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="panduan.html" class="site-footer-link">Panduan</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="#" class="site-footer-link">Karir</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                        <h6 class="site-footer-title mb-3">Ikuti kami</h6>

                        <p class="text-white d-flex mb-1">
                            <a href="#instagram" class="site-footer-link">
                                instagram
                            </a>
                        </p>

                    </div>



                    <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0 ms-auto">

                        <!--
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            English</button>

                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" type="button">Thai</button></li>

                                <li><button class="dropdown-item" type="button">Myanmar</button></li>

                                <li><button class="dropdown-item" type="button">Arabic</button></li>
                            </ul>
                        </div>
                        -->

                        <p class="copyright-text mt-lg-5 mt-4">© 2024 SVELTIER. All right reserved </p>
                        
                    </div>

                </div>
            </div>
        </footer>
        <!-- ================================================================= close footer ======================================================= -->





      <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/custom.js"></script>   

</body>
</html>

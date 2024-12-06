<?php 
include "conn123.php";
session_start();

if(!isset($_SESSION['username'])){
    ?>
    <script type="text/javascript">
        alert("Login dahulu untuk melihat kategori");
        window.location.href = "login.php";
    </script>
    <?php  
    
}

$getstring = $_GET['string'];

//sanitize 1
$getstring1 = mysqli_real_escape_string($koneksi, $getstring);

//sanitize 2
$getstring2 = strip_tags($getstring1);

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $getstring; ?></title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
                        
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/templatemo-topic-listing.css" rel="stylesheet">      

    </head>
    
    <body id="top">

        <main>





            <!-- =============================================================== open navbar ====================================================-->
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="index.php">
                        <!--<i class="bi-back"></i>-->
                        <span>SVELTIER</span>
                    </a>

                    <div class="d-lg-none ms-auto me-4">
                        <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
                    </div>
    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-5 me-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="index.php">Beranda</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
            <!-- =========================================================== close navbar ====================================================== -->








            
          














            <!-- ==================================================== open produk ============================================================= -->
            <section class="explore-section section-padding" id="section_2">
                <div class="container">
                    <div class="row">

                        <div class="col-12 text-center">
                            <h2 class="mb-4">Produk kategori <?php echo $getstring; ?></h1>
                        </div>

                    </div>
                </div>


                <div class="container">
                    <div class="row">

                        <div class="col-12">
                            <div class="tab-content" id="myTabContent">


                                <!-- open list produk -->
                                <div class="tab-pane fade show active" id="design-tab-pane" role="tabpanel" aria-labelledby="design-tab" tabindex="0">
                                    <div class="row" style="display: flex; justify-content: center;">

                                        <?php

                                        $sqlkategori = "SELECT * FROM produk WHERE kategori_produk = '$getstring2'";
                                        $connsqlkategori = mysqli_query($koneksi, $sqlkategori);

                                        function formatRupiah($angka) {
                                            return 'Rp ' . number_format($angka, 2, ',', '.');
                                        }

                                        if(mysqli_num_rows($connsqlkategori) > 0){

                                            while($dataproduk = mysqli_fetch_array($connsqlkategori)){
                                                $idproduk = $dataproduk['id_produk'];
                                                $namaproduk = $dataproduk['nama_produk'];
                                                $fotoproduk = $dataproduk['foto_produk'];
                                                $deskripsiproduk = $dataproduk['deskripsi_produk'];
                                                $fileproduk = $dataproduk['file_produk'];
                                                $kategoriproduk = $dataproduk['kategori_produk'];
                                                $hargaproduk = $dataproduk['harga_produk'];
                                                $pemilikproduk = $dataproduk['pemilik_produk'];
                                                $produkdilihat = $dataproduk['produk_dilihat'];
                                                $tanggalupload = $dataproduk['tanggal_upload'];

                                                if (strlen($deskripsiproduk) > 100) {
                                                  $deskripsi = substr($deskripsiproduk, 0, 100) . '...';
                                                }else{
                                                  $deskripsi = $deskripsiproduk;
                                                }


                                                $harga = $hargaproduk;
                                                $hargaformat = formatRupiah($harga);

                                                ?>


                                                 <!-- open produk -->
                                                <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0" style="margin: 10px;">
                                                    <div class="custom-block bg-white shadow-lg">
                                                        <a href="produk.php?idproduk=<?php echo $idproduk; ?>">
                                                            <div class="d-flex">
                                                                <div>
                                                                    <h5 class="mb-2"><?php echo $namaproduk; ?></h5>
                                                                    <p class="mb-0"><?php echo $deskripsi; ?></p>
                                                                    <p class="mb-0">Rp <?php echo $hargaformat; ?></p>
                                                                </div>
                                                                <!--<span class="badge bg-design rounded-pill ms-auto"></span>-->
                                                            </div>
                                                            <?php 

                                                                if (!empty(trim($fotoproduk)) && file_exists($fotoproduk)) {
                                                                    ?>
                                                                    <img src="<?php echo $fotoproduk; ?>" class="custom-block-image img-fluid" alt="">
                                                                    <?php  
                                                                } else {
                                                                    ?>
                                                                    <!-- open default -->
                                                                    <img src="images/noimage.png" style="width:100%; height: 200px;" class="custom-block-image img-fluid" alt="Default image">
                                                                    <!-- close default -->
                                                                    <?php  
                                                                }
                                                           
                                                             ?>
                                                            
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- close produk -->


                                                <?php  
                                            }


                                        }else{  
                                            ?>
                                            <div style="display: flex; justify-content: center;">
                                                <h1 style="color: white; font-weight: bolder; font-style: italic; font-size: 25px;">Tidak ada produk pada kategori ini</h1>
                                            </div>
                                            <?php 
                                        }
                                         ?>
                                        
                                        

                                       



                                    </div>
                                    <!-- close list produk -->

                                </div>

                            </div>

                    </div>
                </div>
            </section>
            <!-- ==================================================== close produk ============================================================= -->







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

                        <p class="copyright-text mt-lg-5 mt-4">Copyright © 2024 SVELTIER. All rights reserved.</p>
                        
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
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</html>

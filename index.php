<?php 
include "conn123.php";
session_start();
$usernameuser = $_SESSION['username'];

$cekdatauser = "SELECT  * FROM account WHERE username  = '$usernameuser'";
$conncekdatauser = mysqli_query($koneksi, $cekdatauser);
while($datauser = mysqli_fetch_array($conncekdatauser)){
    $iduser = $datauser['id_user'];
}


?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>SVELTIER - Jual beli produk digital</title>

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
                        <span style="color: white; font-weight: bolder;">SVELTIER</span>
                    </a>


    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- close mode -->
    

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-5 me-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="index.php">Beranda</a>
                            </li>

                           <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kategori</a>
                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                    <li><a class="dropdown-item" href="kategori.php?string=softwareapp">Software App</a></li>
                                    <li><a class="dropdown-item" href="kategori.php?string=sourcecode">Source Code</a></li>
                                    <li><a class="dropdown-item" href="kategori.php?string=ebook">E-book</a></li>
                                </ul>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link" href="panduan.html">Panduan</a>
                            </li>


                            <!-- open menu transaksi pending -->
                            <?php 

                            if($_SESSION['username']){
                                ?>
                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Transaksi</a>
                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                    <?php 
                                    $cektransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_pembeli = '$iduser' and status_transaksi IN ('pending', 'process')");

                                    if(mysqli_num_rows($cektransaksi) > 0){
                                        while($datatransaksi = mysqli_fetch_array($cektransaksi)){
                                            $idtransaksi = $datatransaksi['id_transaksi'];
                                            $namaproduk = $datatransaksi['nama_produk'];
                                            $hargaproduk = $datatransaksi['harga_produk'];
                                            $statustransaksi = $datatransaksi['status_transaksi'];

                                            ?>
                                            <li>
                                                <a class="dropdown-item" href="payment.php?idtransaksi=<?php echo $idtransaksi; ?>" style="line-height: 1px;">
                                                    <div style="display: flex; flex-direction: column; justify-content: flex-start;">

                                                        <div style="display: flex; flex-direction: column;">
                                                            <p><span style="color: grey; font-style: italic; font-size: 11px; margin-right: 10px;">Id :  <?php echo $idtransaksi; ?></span></p>
                                                            <p style="color: black; font-weight: bolder; font-size: 11px;"><?php echo $namaproduk; ?></p>
                                                        </div>

                                                        <div style="display: flex; flex-direction: row; align-items: center;">
                                                            <p style="color: grey; font-size: 11px; margin-right: 10px;">Rp <?php echo $hargaproduk; ?></p>
                                                            <?php 
                                                            if($statustransaksi == "pending"){
                                                                ?>
                                                                    <p style="color: red; font-size: 11px;"><?php echo $statustransaksi; ?></p>
                                                                <?php  
                                                            }else if($statustransaksi == "process"){
                                                                ?>
                                                                    <p style="color: green; font-size: 11px;"><?php echo $statustransaksi; ?></p>
                                                                <?php  
                                                            }
                                                             ?>
                                                            
                                                            
                                                            
                                                        </div>

                                                    </div>
                                                    <hr style="background-color: black; height: 2px; width: 100%;margin-top: -10px;">
                                                </a>
                                            </li>

                                            <?php  
                                            }


                                    }else{
                                        ?>
                                        <p  style="color: grey; font-style: italic; font-size: 12px; text-align: center;">Belum ada transaksi</p>
                                        <?php 
                                    }
                        
                                    ?>

                                    
                                </ul>
                            </li>

                            <?php  
                            }
                             ?>
                             <!-- close menu transaksi pending -->
                            
                            
                            




                            <!-- open menu upload produk -->
                            <?php 

                            if($_SESSION['username']){
                                ?>
                                <li class="nav-item">
                             
                                    <a class="nav-link" href="upload.php" style="color: white; font-weight:bolder;background-color: #0000FF; padding: 10px; border-radius: 10px;">Unggah Produk</a>
                         
                                </li>
                                <?php  
                            }else{

                            }
                            ?>
                            <!-- close menu upload produk -->






                           
                        </ul>



                        <!-- open akun -->
                             <?php 

                            if($_SESSION['username']){
                                ?>

                                <!-- confirm logout -->
                                <script type="text/javascript">
                                    function logout(){
                                        var confirmlogout = confirm("Ingin keluar dari akun ?");
                                        if(confirmlogout == true){
                                            window.location.href = "logout.php";
                                        }
                                    }
                                </script>

                                <li class="nav-item dropdown" style="list-style-type: none;">
                                    <div style="display: flex; flex-direction: row; align-items: center;">
                                    <a class="nav-link" href="profile.php?username=<?php echo $_SESSION['username']; ?>" id="navbarLightDropdownMenuLink" aria-expanded="false" style="color: white; font-weight: bolder; margin-right: 10px"><?php echo $_SESSION['username']; ?></a>
                                    <a class="nav-link" href="logout.php" id="navbarLightDropdownMenuLink" aria-expanded="false" style="color: white; font-weight: bolder; background-color: #FF0000; padding: 10px; border: none; outline: none; outline-color: none; border-radius: 10px;">LOGOUT</a>
                                    </div>
                                </li>
                                <?php 
                            }else{  
                                ?>
                                <li class="nav-item dropdown" style="list-style-type: none;">
                                    <div style="display: flex; flex-direction:row;">
                                    <a class="nav-link" href="login.php" id="navbarLightDropdownMenuLink" aria-expanded="false" style="color: white; font-weight: bolder; margin-right: 10px;">Masuk</a>
                                    <a class="nav-link" href="register.php" id="navbarLightDropdownMenuLink" aria-expanded="false" style="color: white; font-weight: bolder;">Daftar</a>
                                    </div>
                                </li>
                                <?php 
                            }
                             ?>
            
                        <!-- close akun -->


                    </div>
                </div>
            </nav>
            <!-- =========================================================== close navbar ====================================================== -->















            
            <!-- ===================================================== open judul ============================================================ -->
            <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 mx-auto">
                            <h1 class="text-white text-center">Cari. Beli. Unduh</h1>
                            <h6 class="text-center">Platform untuk jual beli produk digital</h6>

                            <?php 

                            if(!isset($_SESSION['username'])){
                                ?>
                                <!-- open search -->
                                <form method="POST" action="" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bi-search" id="basic-addon1"></span>
                                        <input name="search" type="search" class="form-control" id="keyword" placeholder="login dahulu sebelum mencari" aria-label="Search" disabled>
                                        <button type="submit" name="submit" class="form-control" disabled>Cari</button>
                                    </div>
                                </form>
                                <!-- close search -->
                                <?php  
                            }else{

                                if(isset($_POST['submit'])){
                                    $search = $_POST['search'];

                                    if(!empty(trim($search))){
                                        ?>
                                        <script type="text/javascript">
                                            window.location.href= "resultsearch.php?string=<?php echo $search; ?>";
                                        </script>
                                        <?php 
                                    }else{
                                        ?>
                                        <script type="text/javascript">
                                            alert("Kolom pencarian tidak boleh kosong");
                                            setTimeout(function(){
                                                window.location.href = "index.php";
                                            },1000);
                                        </script>
                                        <?php  
                                    }
                                }
                                ?>


                                <!-- open search -->
                                <form method="POST" action="" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bi-search" id="basic-addon1"></span>
                                        <input name="search" type="search" class="form-control" id="keyword" placeholder="Cari produk digital" aria-label="Search" required>
                                        <button type="submit" name="submit" class="form-control">Cari</button>
                                    </div>
                                </form>
                                <!-- close search -->


                                <?php 
                            }
                             ?>
                            
                            
                            


                        </div>
                    </div>
                </div>
            </section>
            <!-- ===================================================== close judul ============================================================ -->





















            <!-- ==================================================== open produk ============================================================= -->
            <section class="explore-section section-padding" id="section_2">
                <div class="container">
                    <div class="row">

                        <div class="col-12 text-center">
                            <h2 class="mb-4">Produk Pilihan kami</h1>
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

                                        $cekproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE status = 'approve'");

                                        function formatRupiah($angka) {
                                            return 'Rp ' . number_format($angka, 2, ',', '.');
                                        }

                                        if(mysqli_num_rows($cekproduk) > 0){
                                            while($dataproduk = mysqli_fetch_array($cekproduk)){
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
                                                        <a href="detail.php?idproduk=<?php echo $idproduk; ?>">
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
                                                                    <img src="<?php echo $fotoproduk; ?>" class="custom-block-image img-fluid" alt="<?php echo $fotoproduk; ?>">
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
                                                <h1 style="color: grey; font-weight: bolder; font-style: italic; font-size: 25px; text-align: center;">Produk belum tersedia</h1>
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


















            <!-- ======================================================== open ask ============================================================ -->

            <section class="faq-section section-padding" id="section_4">
                <div class="container">
                    <div class="row">

                        <!--
                        <div class="col-lg-6 col-12">
                            <h2 class="mb-4">FAQ</h2>
                        </div>
                        -->
                
                        <div class="clearfix"></div>

                        <div class="col-lg-5 col-12">
                            <img src="images/faq_graphic.jpg" class="img-fluid" alt="FAQs">
                        </div>

                        <div class="col-lg-6 col-12 m-auto">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Apa itu SVELTIER ?
                                        </button>
                                    </h2>

                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body" style="color: black; text-align: justify;">
                                           SVELTIER merupakan platform jual beli produk digital seperti source code, E-book, dll. Sveltier mulai beroperasi pada bulan desember 2024. Produk digital merupakan buah pikiran dan dapat dijadikan sumber pendapatan bagi kreatornya. Sveltier hadir untuk membantu para kreator dalam melakukan transaksi jual beli produk yang mereka ciptakan.
                                        </div>
                                    </div>
                                </div>

                                <!--
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        How to find a topic?
                                    </button>
                                    </h2>

                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            You can search on Google with <strong>keywords</strong> such as templatemo portfolio, templatemo one-page layouts, photography, digital marketing, etc.
                                        </div>
                                    </div>
                                </div>

                                -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- ======================================================== close ask ============================================================ -->






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
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</html>

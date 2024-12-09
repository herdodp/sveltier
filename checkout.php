<?php 
include "conn123.php";
session_start();

if(!isset($_SESSION['username'])){
    ?>
    <script type="text/javascript">
        alert("anda belum login. silahkan login terlebih dahulu");
        setTimeout(function(){
            window.location.href = "login.php";
        }, 1000);
    </script>
    <?php  
}

$usernamesession = $_SESSION['username'];
$takedatapembeli = mysqli_query($koneksi, "SELECT * FROM account WHERE username = '$usernamesession'");
while($datapembeli = mysqli_fetch_array($takedatapembeli)){
    $idpembeli = $datapembeli['id_user'];
}

$getidproduk = $_GET['idproduk'];

$biayalayanan = 2000;

$takedataproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$getidproduk'");
if(mysqli_num_rows($takedataproduk)  > 0){
    while($dataproduk = mysqli_fetch_array($takedataproduk)){
        $namaproduk = $dataproduk['nama_produk'];
        $kategoriproduk = $dataproduk['kategori_produk'];
        $hargaproduk = $dataproduk['harga_produk'];
        $pemilikproduk = $dataproduk['pemilik_produk'];
    }

}else{
    ?>
    <script type="text/javascript">
        alert("Produk tidak tersedia. Halaman akan kembali ke beranda dalam 2 detik");
        setTimeout(function(){
            window.location.href = "index.php";
        },1000);
    </script>
    <?php  
}

//id pemilik produk 
$takepemilik = mysqli_query($koneksi, "SELECT * FROM account WHERE username = '$pemilikproduk'");
while($datapemilik = mysqli_fetch_array($takepemilik)){
    $idpemilik = $datapemilik['id_user'];
}


$totalpembayaran = $hargaproduk + $biayalayanan;

                // open random id transaksi
               function generateRandomString($length = 10) {
                   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                   $randomString = '';

                   for ($i = 0; $i < $length; $i++) {
                       $randomString .= $characters[rand(0, strlen($characters) - 1)];
                   }

                   return $randomString;
               }

               $idtransaksi = generateRandomString();
               //close random id produk



//input transaksi
if(isset($_POST['submit'])){

    $transaksi = mysqli_query($koneksi, "INSERT INTO transaksi set id_transaksi = '$idtransaksi', id_pemilik = '$idpemilik', id_pembeli = '$idpembeli',id_produk = '$getidproduk', nama_produk = '$namaproduk', harga_produk = '$hargaproduk', foto_bukti = 'none', total_pembayaran = '$totalpembayaran', status_transaksi = 'pending'");

    if($transaksi){
        ?>
        <script type="text/javascript">
            alert("Transaksi berhasil. Silahkan lakukan pembayaran dan kirim bukti pembayarannya");
            setTimeout(function(){
                window.location.href = "index.php";
            },1000);
        </script>
        <?php 
    }

}



    function formatRupiah($angka) {
        return 'Rp ' . number_format($angka, 2, ',', '.');
    }

    $formatharga = formatRupiah($hargaproduk);
    $formatadmin = formatRupiah($biayalayanan);
    $formattotal = formatRupiah($totalpembayaran);







 ?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Pembayaran</title>

        <!-- CSS FILES -->        

        <link rel="stylesheet" type="text/css" href="checkoutstyle.css">


        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
                        
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/templatemo-topic-listing.css" rel="stylesheet"> 

    </head>




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
                    
                    <script type="text/javascript">
                        function batal(){
                            var confirmbatal = confirm("Batalkan transaksi ?");
                            if(confirmbatal == true){
                                window.location.href = "index.php";
                            }
                        }
                    </script>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-5 me-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="index.php">kembali ke Beranda</a>
                            </li>
    
                        </ul>

                    </div>
                </div>
            </nav>
            <!-- =========================================================== close navbar ====================================================== -->








    <!-- =============================================================== open main ===================================================== -->

    <main class="container">
        <h1>Metode Pembayaran</h1>
        <div class="payment-methods">

            <div class="payment-method">
                <input type="radio" id="e-wallet" name="payment" value="e-wallet">
                <label for="e-wallet">
                    <img src="images/dana.jpg?height=40&width=60" alt="DANA">
                    <span>DANA</span>
                </label>
            </div>

        </div>
        <div class="order-summary">
            <h2>DETAIL PEMBAYARAN</h2>
            <p style="color: grey; font-style: italic; ">Ini adalah halaman terakhir transaksi. Harap lakukan pengecekan ulang sebelum mengakhiri transaksi ini.</p>
            <table>
                <tr>
                    <td>Harga Produk Digital</td>
                    <td><?php echo $formatharga; ?></td>
                </tr>
                <tr>
                    <td>Biaya Layanan</td>
                    <td><?php echo $formatadmin; ?></td>
                </tr>
        
                <tr class="total">
                    <td>Total Pembelian</td>
                    <td><?php echo $formattotal; ?></td>
                </tr>
            </table>
        </div>
        <form method="POST" action="">
            <button class="btn-primary" type="submit" name="submit">Bayar dan Akhiri transaksi</button>
        </form>
    </main>

    <!-- ============================================================== close main ============================================================-->










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


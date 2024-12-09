<?php 

include "conn123.php";
session_start();

if(!isset($_SESSION['username'])){
    ?>
    <script type="text/javascript">
        alert("Anda belum login. Silahkan login terlebih dahulu");
        window.location.href = "login.php";
    </script>
    <?php  
}


$getidtransaksi = $_GET['idtransaksi'];

//sanitize 1
$getidtransaksi1 = mysqli_real_escape_string($koneksi, $getidtransaksi);

//sanitize 2
$getidtransaksi2 = strip_tags($getidtransaksi1);


if(!empty($getidtransaksi)){

    if(isset($_POST['submit'])){
        $maxfile = 10 * 1024 * 1024; //10mb

        if($_FILES['buktitransfer']['size'] > $maxfile){
            ?>
            <script type="text/javascript">
                alert("Ukuran file tidak boleh lebih dari 2 MB");
                setTimeout(function(){
                    window.location.href = "payment.php?idtransaksi=<?php echo $getidtransaksi; ?>";
                }, 1000);
            </script>
            <?php  
        }

        $targetDirFile = "buktitransfer/";
        $targetNameFile = $_FILES['buktitransfer']['name'];
        $targetfile = $targetDirFile.basename($targetNameFile);
        $limitextention = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));
        $allowtype = array("jpg","jpeg");

        if(!in_array($limitextention, $allowtype)){
            ?>
            <script type="text/javascript">
                alert("Ekstensi file bukti transfer yang diizinkan hanya jpg dan jpeg");
                setTimeout(function(){
                    window.location.href = "payment.php?idtransaksi=<?php echo $getidtransaksi; ?>"
                }, 1000);
            </script>
            <?php  
        }

        if(move_uploaded_file($_FILES['buktitransfer']['tmp_name'], $targetfile)){
            $updatebukti = "UPDATE transaksi set foto_bukti = '$targetNameFile', status_transaksi = 'process' WHERE id_transaksi = '$getidtransaksi2'";
            $connupdatebukti = mysqli_query($koneksi, $updatebukti);
            if($connupdatebukti){
                ?>
                <script type="text/javascript">
                    alert("Berhasil mengirikan bukti transaksi");
                    setTimeout(function(){
                        window.location.href = "index.php";
                    }, 1000);
                </script>
                <?php 
            }else{
                ?>
                <script type="text/javascript">
                    alert("Gagal mengirim bukti transfer. Silahkan coba lagi");
                    window.location.href = "payment.php?idtransaksi=<?php echo $getidtransaksi; ?>"
                </script>
                <?php 
            }
        }else{
            ?>
            <script type="text/javascript">
                alert("File bukti yang dikirim gagal di unggah. Silahkan coba lagi atau hubungi admin");
                window.location.href = "payment.php?idtransaksi=<?php echo $getidtransaksi; ?>";
            </script>
            <?php  
        }
       
    }

}else{
    ?>
    <script type="text/javascript">
        alert("id transaksi tidak ditemukan. Hubungi administrator untuk melaporkan kesalahan ini");
        setTimeout(function(){
            window.location.href = "index.php";
        }, 1000);
    </script>
    <?php  
}




 ?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Bukti Transfer</title>

        <!-- CSS FILES -->        


        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
                        
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/templatemo-topic-listing.css" rel="stylesheet"> 

        <link rel="stylesheet" href="styles.css">

    </head>

<body>






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







            <!-- open main -->
            <main class="container">
                <h1>Bukti Transfer Dana</h1>
                <form class="upload-form" method="POST" action="" enctype="multipart/form-data">
                    <div class="file-input-wrapper">
                        <input type="file" id="file-input" name="buktitransfer"  accept="image/*" required>
                        <label for="file-input" class="file-input-label">Choose a file</label>
                    </div>
                    <div id="file-name"></div>
                    <button type="submit" name="submit" class="submit-btn">Kirim Bukti Transfer</button>
                </form>
            </main>
            <!-- close main -->









    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>







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

    <script>
        document.getElementById('file-input').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            document.getElementById('file-name').textContent = 'Selected file: ' + fileName;
        });
    </script>
</body>
</html>


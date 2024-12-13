<?php 
include "../conn123.php";
session_start();


if(!isset($_SESSION['username'])){
    header("location:../login.php");
    exit;
}


//count transaction
$jumlahtransaksi = mysqli_query($koneksi, "SELECT COUNT(*) AS totalcountra FROM transaksi");
$rowcounttra = mysqli_fetch_assoc($jumlahtransaksi);
$counttra = $rowcounttra['totalcountra'];


//count upload product
$jumlahprodukpending = mysqli_query($koneksi, "SELECT COUNT(*) AS totalcountup FROM produk WHERE status = 'pending'");
$rowcountup  = mysqli_fetch_assoc($jumlahprodukpending);
$countrowup = $rowcountup['totalcountup'];


//jumlah user
$jumlahuser = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM account WHERE role = 'common'");
$rowuser = mysqli_fetch_assoc($jumlahuser);
$countrowuser = $rowuser['total'];

//jumlah produk
$jumlahproduk = mysqli_query($koneksi, "SELECT COUNT(*) AS totalproduk FROM produk");
$rowproduk = mysqli_fetch_assoc($jumlahproduk);
$countrowproduk = $rowproduk['totalproduk'];


//jumlah transaksi pending
$jumlahtransaksipending = mysqli_query($koneksi, "SELECT COUNT(*) AS totaltranpending FROM transaksi WHERE status_transaksi IN ('pending', 'process')");
$rowtransaksipending = mysqli_fetch_assoc($jumlahtransaksipending);
$counttranpending = $rowtransaksipending['totaltranpending'];


//jumlah transasksi selesai
$transaksiselesai = mysqli_query($koneksi, "SELECT COUNT(*) AS totaltransaksiselesai FROM history WHERE status = 'done'");
$rowtransaksiselesai = mysqli_fetch_assoc($transaksiselesai);
$counttransaksiselesai = $rowtransaksiselesai['totaltransaksiselesai'];

//jumlah laporan pengguna
$reportuser = mysqli_query($koneksi, "SELECT COUNT(*) AS laporanpengguna FROM userreport");
$rowlaporanpengguna = mysqli_fetch_assoc($reportuser);
$countrowuserreport = $rowlaporanpengguna['laporanpengguna'];




 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SVELTIER</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styleadmin.css">
</head>
<body>


    <div class="container">




        <!-- open side bar  -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>SVELTIER</h2>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashadmin.php"  class="active">Beranda</a></li>
                    <li><a href="uploadproduk.php">Upload Produk <span style="color: yellow; font-weight: bolder;">( <?php echo $countrowup; ?> )</span></a></li>
                    <li><a href="transaction.php">Transaksi <span style="color: yellow; font-weight: bolder;">( <?php echo $counttranpending; ?> )</span></a></li>
                    <li><a href="alluser.php">Daftar Pengguna</a></li>
                    <li><a href="allproduk.php">Daftar Produk</a></li>
                    <li><a href="history.php">Riwayat Transaksi</a></li>
                    <li><a href="listadmin.php">Daftar Admin</a></li>
                    <li><a href="laporanpengguna.php">Laporan Pengguna <span style="color: yellow; font-weight: bolder;">( <?php echo $countrowuserreport; ?> )</span></a></li>
                </ul>
            </nav>
        </aside>
        <!-- close side bar -->











        <!-- open main -->
        <main class="main-content">

            <script type="text/javascript">
                function logoutdash(){
                    var confirmlogout = confirm("Keluar dari halaman administrator ?");
                    if(confirmlogout == true){
                        window.location.href = "logoutdash.php";
                    }
                }
            </script>

            <header class="main-header">
                <div  style="display: flex; flex-direction: row; align-items: center; ">
                    <h1 style="margin-right: 10px;">Beranda</h1>

                    <?php 

                    if(isset($_SESSION['username'])){
                        ?>
                         <button onclick="logoutdash()" style="color: white; font-weight: bolder; padding: 10px; border-radius: 10px; margin-left: 10px; background-color: red; border: none; outline: none; outline-color: none;">Keluar</button>
                        <?php  
                    }else{

                    }

                     ?>
                   
                </div>    
            </header>



           <!--open data -->
           <div style="display: flex; flex-direction: column;">


            <!-- open row 1-->
           <div style="display: flex; flex-direction: row; justify-content: center;">   

                <!-- open jumlah member -->
                <div style="display : flex; flex-direction: column; justify-content: center; text-align: center; align-items: center;">
                    <a href="https://sveltier.my.id/dashboard/alluser.php" style="border: none; border-radius: 10px; margin: 10px; padding: 10px; height: 150px; width: 200px; text-decoration: none; outline: none; display: flex; justify-content: center; align-items: center; background-color: blue;">
                        <p style="color: white; font-weight: bolder; font-size: 35px;"><?php echo $countrowuser; ?></p>
                    </a>
                    <p style="text-align: center; color: black; font-size: 15px;">Pengguna</p>
                </div>
                <!-- close jumlah member -->

                <!-- open jumlah transaksi -->
                <div style="display : flex; flex-direction: column; justify-content: center; text-align: center; align-items: center;">
                    <a href="https://sveltier.my.id/dashboard/transaction.php" style="border: none; border-radius: 10px; margin: 10px; padding: 10px; height: 150px; width: 200px; text-decoration: none; outline: none; display: flex; align-items: center;  justify-content: center; background-color: red;">
                        <p style="color: white; font-weight: bolder; font-size: 35px;"><?php echo $counttra; ?></p>
                    </a>
                    <p style="text-align: center; color: black; font-size: 15px;">Transaksi</p>
                </div>
                <!-- close jumlah transaksi -->

                <!-- open jumlah produk yang pending -->
                <div style="display : flex; flex-direction: column; justify-content: center; text-align: center; align-items: center;">
                    <a href="https://sveltier.my.id/dashboard/uploadproduk.php" style="border: none; border-radius: 10px; margin: 10px; padding: 10px; height: 150px; width: 200px; text-decoration: none; outline: none; align-items: center; justify-content: center; display: flex; background-color: green;">
                        <p style="color: white; font-weight: bolder; font-size: 35px;"><?php echo $countrowup; ?></p>
                    </a>
                    <p style="text-align: center; color: black; font-size: 15px;">Produk Pending</p>
                </div>
                <!-- close jumlah produk yang pending -->

                <!-- open jumlah produk -->
                <div style="display : flex; flex-direction: column; justify-content: center; text-align: center; align-items: center;">
                    <a href="https://sveltier.my.id/dashboard/allproduk.php" style="border: none; border-radius: 10px; margin: 10px; padding: 10px; height: 150px; width: 200px; text-decoration: none; outline: none; align-items: center; justify-content: center; display: flex; background-color: #808000;">
                        <p style="color: white; font-weight: bolder; font-size: 35px;"><?php echo $countrowproduk; ?></p>
                    </a>
                    <p style="text-align: center; color: black; font-size: 15px;">Jumlah Produk</p>
                </div>
                <!-- close jumlah produk -->

           </div>
           <!-- close row 1 -->






        <hr style="background-color: black; height: 2px; margin-top: 20px; margin-bottom: 20px;">





           <!-- open row 2 -->
           <div style="display: flex; flex-direction: row; justify-content: center;">   


                <!-- open jumlah transaksi selesai -->
                <div style="display : flex; flex-direction: column; justify-content: center; text-align: center; align-items: center;">
                    <a href="https://sveltier.my.id/dashboard/history.php?transaction=done" style="border: none; border-radius: 10px; margin: 10px; padding: 10px; height: 150px; width: 200px; text-decoration: none; outline: none; display: flex; justify-content: center; align-items: center; background-color: blue;">
                        <p style="color: white; font-weight: bolder; font-size: 35px;"><?php echo $counttransaksiselesai; ?></p>
                    </a>
                    <p style="text-align: center; color: black; font-size: 15px;">Transaksi Selesai</p>
                </div>
                <!-- close jumlah transaksi selesai -->



                <!-- open jumlah keuntungan -->
                <div style="display : flex; flex-direction: column; justify-content: center; text-align: center; align-items: center;">
                    <a href="#" style="border: none; border-radius: 10px; margin: 10px; padding: 10px; height: 150px; width: 200px; text-decoration: none; outline: none; display: flex; justify-content: center; align-items: center; background-color: blue; pointer-events: none;">
                        <p style="color: white; font-weight: bolder; font-size: 25px;">Rp <?php echo $countrowuser; ?></p>
                    </a>
                    <p style="text-align: center; color: black; font-size: 15px;">Keuntungan</p>
                </div>
                <!-- close jumlah keuntungan -->


                <!-- open laporan pengguna -->
                <div style="display : flex; flex-direction: column; justify-content: center; text-align: center; align-items: center;">
                    <a href="https://sveltier.my.id/dashboard/laporanpengguna.php" style="border: none; border-radius: 10px; margin: 10px; padding: 10px; height: 150px; width: 200px; text-decoration: none; outline: none; display: flex; justify-content: center; align-items: center; background-color: red;">
                        <p style="color: white; font-weight: bolder; font-size: 25px;"><?php echo $countrowuser; ?></p>
                    </a>
                    <p style="text-align: center; color: black; font-size: 15px;">Laporan Pengguna</p>
                </div>
                <!-- close jumlah laporan pengguna -->




           </div>
           <!-- close row 2 -->
           


           </div>
           <!-- close data -->







            </div>
        </main>
        <!-- close main-->







    </div>









    <!-- open footer -->
    <footer class="footer">
        <p>&copy; 2024 SVELTIER. All rights reserved.</p>
    </footer>
    <!-- close footer -->






</body>

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

</html>


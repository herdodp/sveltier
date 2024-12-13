<?php 
include "../conn123.php";
session_start();

if(!isset($_SESSION['username'])){
    header("location:../login.php");
    exit;
}

//ambil data transaksi produk yang pending atau process
$taketransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status_transaksi = 'pending' or status_transaksi = 'process'");

//count transaction
$jumlahtransaksi = mysqli_query($koneksi, "SELECT COUNT(*) AS totalcountra FROM transaksi");
$rowcounttra = mysqli_fetch_assoc($jumlahtransaksi);
$counttra = $rowcounttra['totalcountra'];


//count upload product
$jumlahprodukpending = mysqli_query($koneksi, "SELECT COUNT(*) AS totalcountup FROM produk WHERE status = 'pending'");
$rowcountup  = mysqli_fetch_assoc($jumlahprodukpending);
$countrowup = $rowcountup['totalcountup'];


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
                    <li><a href="dashadmin.php">Beranda</a></li>
                    <li><a href="uploadproduk.php" >Upload Produk <span style="color: yellow; font-weight: bolder;">( <?php echo $countrowup; ?> )</span></a></li>
                    <li><a href="transaction.php" class="active">Transaksi <span style="color: yellow; font-weight: bolder;">( <?php echo $counttra; ?> )</span></a></li>
                    <li><a href="alluser.php">Daftar Pengguna</a></li>
                    <li><a href="allproduk.php">Daftar Produk</a></li>
                    <li><a href="history.php">Riwayat Transaksi</a></li>
                    <li><a href="listadmin.php">Daftar Admin</a></li>
                   <li><a href="laporanpengguna.php">Laporan Pengguna<span style="color: yellow; font-weight: bolder;">( <?php echo $countrowuserreport; ?> )</span></a></li>
                </ul>
            </nav>
        </aside>
        <!-- close side bar -->





        <!-- open table data -->
        <main class="main-content">
            <header class="main-header">
                <h1>Transaksi</h1>
            </header>
            <div class="table-container">



                <!-- open data -->
                <table class="sales-table">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>ID Pemilik</th>
                            <th>ID Pembeli</th>
                            <th>ID Produk</th>
                            <th>Nama Produk</th>
                            <!--<th>Kategori</th>-->
                            <th>Harga</th>
                            <th>Bukti</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Waktu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 


                        if(mysqli_num_rows($taketransaksi) > 0){
                            while($datatransaksi = mysqli_fetch_array($taketransaksi)){
		                        $idtransaksi = $datatransaksi['id_transaksi'];
		                        $idpemilik = $datatransaksi['id_pemilik'];
		                        $idpembeli = $datatransaksi['id_pembeli'];
		                        $idproduk = $datatransaksi['id_produk'];

		                        $namaproduk = $datatransaksi['nama_produk'];
		                        //$kategoriproduk = $datatransaksi['kategori_produk'];
		                        $hargaproduk = $datatransaksi['harga_produk'];
		                        $fotobukti = $datatransaksi['foto_bukti'];
		                        $totalpembayaran = $datatransaksi['total_pembayaran'];
		                        $statustransaksi = $datatransaksi['status_transaksi'];
		                        $timetransaksi = $datatransaksi['time_transaksi'];
	                        ?>

                        <tr>
                            <td><?php echo $idtransaksi; ?></td>
                            <td><?php echo $idpemilik; ?></td>
                            <td><?php echo $idproduk; ?></td>
                            <td><?php echo $idproduk; ?></td>
                            <td><?php echo $namaproduk; ?></td>
                            <td>Rp <?php echo $hargaproduk; ?></td>
                            <td>
                                <a href="image.php?string=<?php echo $fotobukti; ?>" style="text-decoration: none; outline: none; outline-color: none; color: blue;">
                                    <?php echo $fotobukti; ?>
                                </a>
                            </td>
                            <td><?php echo $totalpembayaran; ?></td>
                            <?php 
                            if($statustransaksi == "pending"){
                                ?>
                                <td style="color: red; font-weight: bolder;"><?php echo $statustransaksi; ?></td>
                                <?php 
                            }else if($statustransaksi == "process"){
                                ?>
                                <td style="color: green; font-weight: bolder;"><?php echo $statustransaksi; ?></td>
                                <?php 
                            }
                             ?>
                            <td><?php echo $timetransaksi; ?></td>
                            <td>
                                <button type="button" onclick="window.location.href='confirmtransaction.php?idtransaksi=<?php echo $idtransaksi; ?>'" style="color: white; font-weight: bolder; background-color: blue; border-radius: 10px; border: none; margin-left: 10px;padding: 10px;">Konfirmasi</button>
                            </td>
                        </tr>

                        <?php 
                        }

                        }else{
                            ?>
                                <h1 style="color: grey; font-weight: bolder; text-align: center; margin-top: 50px; margin-bottom: 50px; font-style: italic;">Tidak ada transaksi status pending atau process</h1>
                            <?php 
                        }
                         ?>

                    </tbody>
                </table>
                <!-- close table data -->






            </div>
        </main>
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


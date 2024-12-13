<?php 

include "../conn123.php";
session_start();

if(!isset($_SESSION['username'])){
	?>
	<script type="text/javascript">
		alert('Anda belum login');
		setTimeout(function(){
			window.location.href='../login.php';
		}, 1000);
	</script>
	<?php  
}




 				// open random id history
               function generateRandomString($length = 10) {
                   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                   $randomString = '';

                   for ($i = 0; $i < $length; $i++) {
                       $randomString .= $characters[rand(0, strlen($characters) - 1)];
                   }

                   return $randomString;
               }

               $idprodukrandom = generateRandomString();
               //close random id produk
               $statusawal = 'pending';
               //close random id history




//get string
$getstring = $_GET['transaction'];

//sanitize 1
$getstring1 = mysqli_real_escape_string($koneksi, $getstring);

//sanitize 2
$getstring2 = strip_tags($getstring1);

//cek history
$cekhistory = mysqli_query($koneksi, "SELECT * FROM history WHERE status = 'done'");


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
                    <li><a href="transaction.php">Transaksi <span style="color: yellow; font-weight: bolder;">( <?php echo $counttra; ?> )</span></a></li>
                    <li><a href="alluser.php">Daftar Pengguna</a></li>
                    <li><a href="allproduk.php">Daftar Produk</a></li>
                    <li><a href="history.php" class="active">Riwayat Transaksi</a></li>
                    <li><a href="listadmin.php">Daftar Admin</a></li>
                    <li><a href="laporanpengguna.php">Laporan Pengguna<span style="color: yellow; font-weight: bolder;">( <?php echo $countrowuserreport; ?> )</span></a></li>
                </ul>
            </nav>
        </aside>
        <!-- close side bar -->




        <!-- open table data -->
        <main class="main-content">
            <header class="main-header">
                <h1>History</h1>
            </header>
            <div class="table-container">



                <!-- open data -->
                <table class="sales-table">
                    <thead>
                        <tr>
                            <th>ID Produk</th>
                            <th>ID Transaction</th>
                            <th>ID Pemilik</th>
                            <th>ID Pembeli</th>
                            <th>ID Produk</th>
                            <th>Status</th>
                            <th>Waktu Transaksi</th>
                            <th>Waktu Selesai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 


                        if(mysqli_num_rows($cekhistory) > 0){
                            while($datahistory = mysqli_fetch_array($cekhistory)){
                                $idhistory = $datahistory['id_history'];
                                $idtransaction = $datahistory['id_transaction'];
                                $idpemilik = $datahistory['id_pemilik'];
                                $idpembeli = $datahistory['id_pembeli'];
                                $idproduk = $datahistory['id_produk'];
                                $status = $datahistory['status'];
                                $timetransaction = $datahistory['time_transaction'];
                                $timecomplete = $datahistory['time_complete'];
                            ?>

                        <tr>
                            <td><?php echo $idhistory; ?></td>
                            <td><?php echo $idtransaction; ?></td>
                            <td><?php echo $idpemilik; ?></td>
                            <td><?php echo $idpembeli; ?></td>
                            <td><?php echo $idproduk; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $timetransaction; ?></td>
                            <td><?php echo $timecomplete; ?></td>
                            <td>
                                <button type="button" onclick="window.location.href='editprofile.php?iduser=<?php echo $iduser; ?>'" style="color: white; font-weight: bolder; background-color: blue; border-radius: 10px; border: none; margin-left: 10px;padding: 10px;">Edit</button>
                            </td>
                        </tr>

                        <?php 
                        }

                        }else{
                            ?>
                                <h1 style="color: grey; font-weight: bolder; text-align: center; margin-top: 50px; margin-bottom: 50px; font-style: italic;">Belum ada transaksi yang selesai</h1>
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


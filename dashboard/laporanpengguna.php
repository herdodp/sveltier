<?php 
include "../conn123.php";
session_start();

if(!isset($_SESSION['username'])){
    header("location:../login.php");
    exit;
}

//ambil data upload produk yang pending
$takereport = mysqli_query($koneksi, "SELECT * FROM userreport");

//count transaction
$jumlahtransaksi = mysqli_query($koneksi, "SELECT COUNT(*) AS totalcountra FROM transaksi");
$rowcounttra = mysqli_fetch_assoc($jumlahtransaksi);
$counttra = $rowcounttra['totalcountra'];


//count upload product
$jumlahprodukpending = mysqli_query($koneksi, "SELECT COUNT(*) AS totalcountup FROM produk WHERE status = 'pending'");
$rowcountup  = mysqli_fetch_assoc($jumlahprodukpending);
$countrowup = $rowcountup['totalcountup'];




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
                    <li><a href="uploadproduk.php">Upload Produk <span style="color: yellow; font-weight: bolder;">( <?php echo $countrowup; ?> )</span></a></li>
                    <li><a href="transaction.php">Transaksi <span style="color: yellow; font-weight: bolder;">( <?php echo $counttra; ?> )</span></a></li>
                    <li><a href="alluser.php">Daftar Pengguna</a></li>
                    <li><a href="allproduk.php">Daftar Produk</a></li>
                    <li><a href="history.php">Riwayat Transaksi</a></li>
                    <li><a href="listadmin.php" class="active">Daftar Admin</a></li>
                    <li><a href="laporanpengguna.php">Laporan Pengguna</a></li>
                </ul>
            </nav>
        </aside>
        <!-- close side bar -->




        <!-- open table data -->
        <main class="main-content">
            <header class="main-header">
                <h1>All Product</h1>
            </header>
            <div class="table-container">



                <!-- open data -->
                <table class="sales-table">
                    <thead>
                        <tr>
                            <th>ID Report</th>
                            <th>ID User</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal Report</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 


                        if(mysqli_num_rows($takereport) > 0){
                            while($datareport = mysqli_fetch_array($takereport)){
                                $idreport = $datareport['id_report'];
                                $iduser = $datareport['id_user'];
                                $judul = $datareport['judul'];
                                $kategori = $datareport['kategori'];
                                $status = $datareport['status'];
                                $tanggalreport = $datareport['tanggal_report'];
                            ?>

                        <tr>
                            <td><?php echo $idreport; ?></td>
                            <td><?php echo $iduser; ?></td>
                            <td><?php echo $judul; ?></td>
                            <td><?php echo $kategori; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $tanggalreport; ?></td>
                            <td>
                                <button type="button" onclick="window.location.href='editprofile.php?iduser=<?php echo $iduser; ?>'" style="color: white; font-weight: bolder; background-color: blue; border-radius: 10px; border: none; margin-left: 10px;padding: 10px;">View</button>
                            </td>
                        </tr>

                        <?php 
                        }

                        }else{
                            ?>
                                <h1 style="color: grey; font-weight: bolder; text-align: center; margin-top: 50px; margin-bottom: 50px; font-style: italic;">Tidak ada Laporan yang Masuk</h1>
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


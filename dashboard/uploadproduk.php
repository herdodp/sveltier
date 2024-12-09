<?php 
include "../conn123.php";
session_start();

if(!isset($_SESSION['username'])){
    header("location:../login.php");
    exit;
}

//ambil data upload produk yang pending
$takeproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE status='pending'");


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
                    <li><a href="uploadproduk.php" class="active">Upload Produk</a></li>
                    <li><a href="transaction.php">Transaksi</a></li>
                    <li><a href="alluser.php">Daftar Pengguna</a></li>
                    <li><a href="history.php">Riwayat Transaksi</a></li>
                    <li><a href="listadmin.php">Daftar Admin</a></li>
                </ul>
            </nav>
        </aside>
        <!-- close side bar -->





        <!-- open table data -->
        <main class="main-content">
            <header class="main-header">
                <h1>Upload Produk</h1>
            </header>
            <div class="table-container">



                <!-- open data -->
                <table class="sales-table">
                    <thead>
                        <tr>
                            <th>ID Produk</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Pemilik</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th>Tanggal Upload</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 


                        if(mysqli_num_rows($takeproduk) > 0){
                            while($dataproduk = mysqli_fetch_array($takeproduk)){
                                $idproduk = $dataproduk['id_produk'];
                                $namaproduk = $dataproduk['nama_produk'];
                                $kategoriproduk = $dataproduk['kategori_produk'];
                                $hargaproduk = $dataproduk['harga_produk'];
                                $pemilikproduk = $dataproduk['pemilik_produk'];
                                $produkdilihat = $dataproduk['produk_dilihat'];
                                $status = $dataproduk['status'];
                                $tanggalupload = $dataproduk['tanggal_upload'];
                            ?>

                        <tr>
                            <td><?php echo $idproduk; ?></td>
                            <td><?php echo $namaproduk; ?></td>
                            <td><?php echo $kategoriproduk; ?></td>
                            <td>Rp <?php echo $hargaproduk; ?></td>
                            <td><?php echo $pemilikproduk; ?></td>
                            <td><?php echo $produkdilihat; ?></td>
                            <?php 
                            if($status == "pending"){
                                ?>
                                <td style="color: red;"><?php echo $status; ?></td>
                                <?php 
                            }else if($status == "approve"){
                                ?>
                                <td style="color: green;"><?php echo $status; ?></td>
                                <?php 
                            }
                             ?>
                            <td><?php echo $tanggalupload; ?></td>
                            <td>
                                <button type="button" onclick="window.location.href='confirmproduk.php?idproduk=<?php echo $idproduk; ?>'" style="color: white; font-weight: bolder; background-color: blue; border-radius: 10px; border: none; margin-left: 10px;padding: 10px;">Konfirmasi</button>
                            </td>
                        </tr>

                        <?php 
                        }

                        }else{
                            ?>
                                <h1 style="color: grey; font-weight: bolder; text-align: center; margin-top: 50px; margin-bottom: 50px; font-style: italic;">Tidak ada produk status pending</h1>
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

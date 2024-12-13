<?php 

include "conn123.php";
session_start();

if(!isset($_SESSION['username'])){
    ?>
    <script type="text/javascript">
        alert("anda belum login");
        setTimeout(function(){
            window.location.href = "login.php";
        }, 1000);
    </script>
    <?php 
}

$usernamesession = $_SESSION['username'];

$getiduser = $_GET['iduser'];
$cekdatauser = mysqli_query($koneksi, "SELECT * FROM account WHERE id_user = '$getiduser'");
if(mysqli_num_rows($cekdatauser) > 0 ){
    while($datauser = mysqli_fetch_array($cekdatauser)){
        $namalengkap = $datauser['namalengkap'];
        $saldo = $datauser['saldo'];
    }
}else{
     ?>
    <script type="text/javascript">
        alert("Data pengguna tidak ada");
        setTimeout(function(){
            window.location.href = "index.php";
        }, 1000);
    </script>
    <?php 
}




 ?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profil</title>
    <link rel="stylesheet" href="styleprofile.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Profil Pengguna</h1>
        </header>


        <main>

            <section class="user-info">
                <h2>Informasi Pengguna</h2>
                <div class="info-card">
                    <p><strong>Username:</strong> <span id="username"><?php echo $usernamesession; ?></span></p>
                    <p><strong>Saldo:</strong> <span id="balance">Rp <?php echo $saldo; ?></span></p>
                </div>
            </section>

            <section class="settings">
                <h2>Pengaturan</h2>
                <button id="settingsBtn">Ubah Pengaturan</button>
            </section>


            <!-- open transaksi berhasil -->
            <section class="transactions">
                <h2>Daftar Transaksi</h2>


                  <table>
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>ID Penjual</th>
                            <th>ID Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Bukti</th>
                            <th>Total Pembayaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                <?php 

                $cekdatahistory = mysqli_query($koneksi, "SELECT * FROM history WHERE id_pembeli = '$getiduser' and status = 'done'");
                

                if(mysqli_num_rows($cekdatahistory) > 0){

                    while($datahistory = mysqli_fetch_array($cekdatahistory)){
                    $idtransaksi = $datahistory['id_transaksi'];

                    $cekdatatransaksi = mysqli_num_rows($koneksi, "SELECT * FROM transaksi WHERE id_transaksi = '$idtransaksi'");
                    while($datatransaksi = mysqli_fetch_array($cekdatatransaksi)){
                        $idpemilik = $datatransaksi['id_pemilik'];
                        $idproduk = $datatransaksi['id_produk'];
                        $namaproduk = $datatransaksi['nama_produk'];
                        $hargaproduk = $datatransaksi['harga_produk'];
                        $fotobukti = $datatransaksi['foto_bukti'];
                        $totalpembayaran = $datatransaksi['total_pembayaran'];
                        $statustransaksi = $datatransaksi['status_transaksi'];

                    }

                    ?>


                        <tr>
                            <td style="color: black;"><?php echo $idtransaksi; ?></td>
                            <td><?php echo $idpemilik; ?></td>
                            <td><?php echo $idproduk; ?></td>
                            <td><?php echo $namaproduk; ?></td>
                            <td><?php echo $hargaproduk; ?></td>
                            <td><?php echo $fotobukti; ?></td>
                            <td><?php echo $totalpembayaran; ?></td>
                            <td><?php echo $statustransaksi; ?></td>

                        </tr>




                    <?php 
                }

                }else{
                    ?>
                    <h1 style="color: grey; text-align: center; margin-top: 10px; margin-bottom: 10px;">Belum memiliki transaksi</h1>
                    <?php 
                }

                 ?>
              
                            
                     
                    </tbody>
                </table>



            </section>
            <!-- close transaksi berhasil -->


        </main>


        <footer>
            <p>&copy; 2023 Nama Perusahaan. Hak Cipta Dilindungi.</p>
        </footer>



    </div>
</body>
</html>
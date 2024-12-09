<?php 
include "../conn123.php";
session_start();

if(!isset($_SESSION['username'])){
    header("location:../login.php");
    exit;
}

//ambil data upload produk yang pending
$takeuser = mysqli_query($koneksi, "SELECT * FROM account WHERE role = 'admin'");

//count transaction
$counttra = mysqli_query($koneksi, "SELECT * FROM transaksi");
$row_count_tra = mysqli_num_rows($counttra); 

//count upload product
$countup = mysqli_query($koneksi,"SELECT * FROM produk WHERE status = 'pending'");
$row_count_up = mysqli_num_rows($countup);




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
                    <li><a href="uploadproduk.php">Upload Produk <span style="color: yellow; font-weight: bolder;">( <?php echo $row_count_up; ?> )</span></a></li>
                    <li><a href="transaction.php">Transaksi <span style="color: yellow; font-weight: bolder;">( <?php echo $row_count_tra; ?> )</span></a></li>
                    <li><a href="alluser.php">Daftar Pengguna</a></li>
                    <li><a href="history.php">Riwayat Transaksi</a></li>
                    <li><a href="listadmin.php" class="active">Daftar Admin</a></li>
                </ul>
            </nav>
        </aside>
        <!-- close side bar -->





        <!-- open table data -->
        <main class="main-content">
            <header class="main-header">
                <h1>Administrator</h1>
            </header>
            <div class="table-container">



                <!-- open data -->
                <table class="sales-table">
                    <thead>
                        <tr>
                            <th>ID User</th>
                            <th>Nama lengkap</th>
                            <th>username</th>
                            <th>jumlah login</th>
                            <th>Last Login</th>
                            <th>Role</th>
                            <th>akun dibuat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 


                        if(mysqli_num_rows($takeuser) > 0){
                            while($datauser = mysqli_fetch_array($takeuser)){
                                $iduser = $datauser['id_user'];
                                $namalengkap = $datauser['namalengkap'];
                                $username = $datauser['username'];
                                $jumlahlogin = $datauser['jumlah_login'];
                                $lastlogin = $datauser['last_login'];
                                $role = $datauser['role'];
                                $createtime = $datauser['create_time'];
                            ?>

                        <tr>
                            <td><?php echo $iduser; ?></td>
                            <td><?php echo $namalengkap; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $jumlahlogin; ?></td>
                            <td><?php echo $lastlogin; ?></td>
                            <td><?php echo $role; ?></td>
                            <td><?php echo $createtime; ?></td>
                            <td>
                                <button type="button" onclick="window.location.href='editprofile.php?iduser=<?php echo $iduser; ?>'" style="color: white; font-weight: bolder; background-color: blue; border-radius: 10px; border: none; margin-left: 10px;padding: 10px;">Edit</button>
                            </td>
                        </tr>

                        <?php 
                        }

                        }else{
                            ?>
                                <h1 style="color: grey; font-weight: bolder; text-align: center; margin-top: 50px; margin-bottom: 50px; font-style: italic;">Tidak ada user yang terdaftar</h1>
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


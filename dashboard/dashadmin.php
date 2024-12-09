<?php 
include "conn123.php";
session_start();


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
                    <li><a href="dashadmin.php" class="active">Beranda</a></li>
                    <li><a href="uploadproduk.php">Upload Produk</a></li>
                    <li><a href="transaction.php">Transaksi</a></li>
                    <li><a href="alluser.php">Daftar Pengguna</a></li>
                    <li><a href="history.php">Riwayat Transaksi</a></li>
                    <li><a href="listadmin.php">Daftar Admin</a></li>
                </ul>
            </nav>
        </aside>
        <!-- close side bar -->






        <main class="main-content">
            <header class="main-header">
                <h1>Beranda</h1>
            </header>
            <div class="table-container">

                <!-- open data -->
                <table class="sales-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1234</td>
                            <td>John Doe</td>
                            <td>Product A</td>
                            <td>2023-05-01</td>
                            <td>$100.00</td>
                            <td><span class="status completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>#1235</td>
                            <td>Jane Smith</td>
                            <td>Product B</td>
                            <td>2023-05-02</td>
                            <td>$75.50</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>#1236</td>
                            <td>Bob Johnson</td>
                            <td>Product C</td>
                            <td>2023-05-03</td>
                            <td>$200.00</td>
                            <td><span class="status completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>#1237</td>
                            <td>Alice Brown</td>
                            <td>Product D</td>
                            <td>2023-05-04</td>
                            <td>$50.25</td>
                            <td><span class="status cancelled">Cancelled</span></td>
                        </tr>
                        <tr>
                            <td>#1238</td>
                            <td>Charlie Wilson</td>
                            <td>Product E</td>
                            <td>2023-05-05</td>
                            <td>$150.00</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>
                    </tbody>
                </table>
                <!-- close data -->



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


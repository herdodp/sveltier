<?php 
include "conn123.php";
session_start();

$usernamesession = $_SESSION['username']; 

if (isset($_POST["submit"])) {

    // Ambil data dari form
    $namaproduk = $_POST['namaProduk'];
    $deskripsiproduk = $_POST['deskripsiProduk'];
    $kategoriproduk = $_POST['kategoriProduk'];
    $hargaprodukraw = $_POST['hargaProdukRaw'];
    $namapemilik = $usernamesession;

   //cek kategori
   if (empty($kategoriproduk)) {
       ?>
       <script type="text/javascript">
          alert("kategori belum dipilih, halaman akan direfresh dalam 2 detik");
          setTimeout(function(){
            window.location.href = "upload.php";
          },2000);
       </script>
       <?php 
   }


    // Validasi input
    if (empty(trim($namaproduk)) || empty($deskripsiproduk) || empty($kategoriproduk) || empty($hargaprodukraw)) {
        echo "<script>alert('Semua kolom wajib diisi.'); window.history.back();</script>";
        ?>
        <script type="text/javascript">
         setTimeout(function(){
           window.location.href = "unggah.php"; 
         },1000);
           
        </script>
        <?php  
    }

    // Validasi harga produk
    $hargaproduk = filter_var($hargaprodukraw, FILTER_SANITIZE_NUMBER_INT);
    if ($hargaproduk <= 0) {
        echo "<script>alert('Harga produk tidak valid.'); window.history.back();</script>";
        exit();
    }

    // Cek ukuran file produk
    $maxFileSize = 100 * 1024 * 1024; // 100MB

    if ($_FILES['fileProduk']['size'] > $maxFileSize) {
        echo "<script>alert('Ukuran file produk terlalu besar. Maksimal 100MB.'); window.history.back();</script>";
        exit();
    }

    // Cek nama produk unik
    $stmt = $koneksi->prepare("SELECT * FROM produk WHERE nama_produk = ?");
    $stmt->bind_param("s", $namaproduk);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<script>alert('Nama produk sudah digunakan, coba lagi.'); window.location.href = 'upload.php';</script>";
        exit();
    }

    // Upload file produk
    $targetDirFile = "file/";
    $targetFile = $targetDirFile . basename($_FILES['fileProduk']['name']);
    $filetype = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowtypefile = array("zip");

    // Cek ekstensi file produk
    if (!in_array($filetype, $allowtypefile)) {
        echo "<script>alert('Ekstensi file yang diizinkan adalah ZIP'); window.history.back();</script>";
         ?>
        <script type="text/javascript">
         setTimeout(function(){
           window.location.href = "upload.php"; 
         },1000);
           
        </script>
        <?php  
    }

    // Cek ekstensi gambar produk
    $targetDirImage = "picfile/";
    $targetFileGambar = $targetDirImage . basename($_FILES['fileGambarProduk']['name']);
    $gambartype = strtolower(pathinfo($targetFileGambar, PATHINFO_EXTENSION));
    $allowtypegambar = array("jpg", "png");

    if (!in_array($gambartype, $allowtypegambar)) {
        echo "<script>alert('Ekstensi gambar yang diizinkan adalah JPG dan PNG'); window.history.back();</script>";
         ?>
        <script type="text/javascript">
         setTimeout(function(){
           window.location.href = "unggah.php"; 
         },1000);
           
        </script>
        <?php  
    }

               // open random id produk
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



    // Proses unggah file
    if (move_uploaded_file($_FILES["fileProduk"]["tmp_name"], $targetFile) && move_uploaded_file($_FILES["fileGambarProduk"]["tmp_name"], $targetFileGambar)) {

        // Masukkan data ke database
        $stmt = $koneksi->prepare("INSERT INTO produk (id_produk, nama_produk, foto_produk, deskripsi_produk, file_produk, kategori_produk, harga_produk, pemilik_produk, status) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssiss", $idprodukrandom, $namaproduk, $targetFileGambar, $deskripsiproduk, $targetFile, $kategoriproduk, $hargaproduk, $namapemilik, $statusawal);

        if ($stmt->execute()) {
            echo "<script>alert('Produk berhasil diunggah.'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data ke database.'); window.history.back();</script>";
        }

    } else {
        echo "<script>alert('Gagal mengunggah file atau gambar.'); window.history.back();</script>";
    }












}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload produk - Sveltier</title>
    <link rel="stylesheet" type="text/css" href="styleform.css">
</head>
<body>
    <div class="container">
        <h1>Upload produk digital kamu sekarang</h1>

        <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="namaproduk">Nama Produk</label>
                <input type="text" id="namaproduk" name="namaProduk" placeholder="Masukkan nama produk" required>
            </div>

            <div class="form-group">
                <label for="fotoproduk">Foto Produk</label>
                <input type="file" id="fotoproduk" name="fileGambarProduk">
            </div>

            <div class="form-group">
                <label for="deksripsi">Deskripsi Produk</label>
                <div style="display: flex; justify-content: center;">
                  <textarea id="deksripsi" name="deskripsiProduk" placeholder="Masukkan deskripsi produk" style="height: 150px; width:300px; resize: none; border-radius: 10px; padding: 10px;" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="fileproduk">File Produk</label>
                <input type="file" id="fileproduk" name="fileProduk" required>
            </div>

            <div class="form-group">
                <label for="Kategoriproduk">Kategori Produk</label>
                <select name="kategoriProduk" id="Kategoriproduk" style="height: 60px; width: 200px; border-radius: 10px; padding: 10px;">
                   <option value="softwareapp">Software App</option>
                   <option value="sourcecode">Source code</option>
                   <option value="ebook">E-book</option>
                </select>
            </div>

            <div class="form-group">
               <label for="username">Harga Produk</label>
               <input id="hargaProduk" type="text" id="username" name="hargaProduk" placeholder="Masukkan Harga Produk (RUPIAH)" required>

               <!-- Input hidden untuk menyimpan harga dalam format angka tanpa simbol Rp. -->
               <input type="hidden" name="hargaProdukRaw" id="hargaProdukRaw">

            </div>

                                    <!-- open scrip mengubah format rupiah -->
                                    <script type="text/javascript">
                                     document.getElementById('hargaProduk').addEventListener('input', function(e) {
                                         var value = e.target.value;

                                         // Menghapus semua karakter selain angka
                                         var angka = value.replace(/[^\d]/g, '');

                                         // Memformat angka menjadi format Rupiah
                                         var formattedValue = formatRupiah(angka);

                                         // Mengupdate nilai input dengan format Rupiah
                                         e.target.value = formattedValue;

                                         // Menyimpan angka tanpa format ke input hidden
                                         document.getElementById('hargaProdukRaw').value = angka;
                                     });

                                     // Fungsi untuk memformat angka menjadi format Rupiah
                                     function formatRupiah(value) {
                                         var number_string = value.replace(/[^,\d]/g, '').toString(),
                                             split = number_string.split(','),
                                             remainder = split[0].length % 3,
                                             rupiah = split[0].substr(0, remainder),
                                             thousands = split[0].substr(remainder).match(/\d{3}/gi);

                                         if (thousands) {
                                             separator = remainder ? '.' : '';
                                             rupiah += separator + thousands.join('.');
                                         }

                                         return rupiah ? 'Rp. ' + rupiah : '';
                                     }
                                    </script>
                                    <!-- close scrip mengubah format rupiah -->

            <div style="display: flex; flex-direction: column; justify-content: center;">
               <button type="submit" name="submit" style="background-color: blue;">Unggah Produk</button>
               <button type="button" onclick="window.location.href='index.php'" style="margin-top: 10px; background-color: red;">batal</button>   
            </div>
            

        </form>

        <p class="login-link">Butuh bantuan ? <a href="https://wa.me/6282298022695" target="_blank">Tanya Admin</a></p>

    </div>

</body>
 <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>

 
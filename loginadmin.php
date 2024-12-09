<?php 

include "conn123.php";
session_start();


if(isset($_POST["submit"])){

    //take data
    $username = $_POST['username'];
    $password = sha1($_POST['password']);


    //satinize 1
    $username1 = mysqli_real_escape_string($koneksi,  $username);
    $password1 = mysqli_real_escape_string($koneksi,  $password);

    //sanitize 2
    $username2 = strip_tags($username1);
    $password2 = strip_tags($password1);


    //cek kolom
    if(!empty(trim($username))){
        if(!empty(trim($password))){

            //cek username
            $cekusername = "SELECT * FROM account WHERE username = '$username2'";
            $connCekUsername = mysqli_query($koneksi, $cekusername);

            while($dataUser = mysqli_fetch_array($connCekUsername)){
            $iduser = $dataUser['id_user'];
                $usernameDB = $dataUser['username'];
                $passwordDB = $dataUser['password'];
            $jumlahlogin = $dataUser['jumlah_login']; 
            }


            //validating
            if(mysqli_num_rows($connCekUsername) > 0){

                if($usernameDB == $username2){
                    if($passwordDB == $password2){

                  //tambah jumlah login
                  $tambahlogin = $jumlahlogin + 1;  
                  $jumlahlogin = "UPDATE account set jumlah_login = '$tambahlogin' WHERE id_user = '$iduser'";
                  $connjumlahlogin = mysqli_query($koneksi, $jumlahlogin);

                  //last login
                  date_default_timezone_set('Asia/Jakarta'); // Atur time zone ke Jakarta
                  $logintimelast = date("Y-m-d H:i:s"); // Format tanggal dan waktu
                  $lastlogin = mysqli_query($koneksi, "UPDATE account set last_login = '$logintimelast' WHERE id_user = '$iduser'");


                        $_SESSION['username'] = $usernameDB;
                        header("location:../index.php");
                        session_start();

                    }else{
                        ?>
                        <script type="text/javascript">
                            alert("Password salah, silahkan diulangi lagi");
                            setTimeout(function(){
                                window.location.href = "login.php";
                            },2000);
                        </script>
                        <?php  
                    }
                }else{
                    ?>
                    <script type="text/javascript">
                        alert("Username tidak sesuai");
                        setTimeout(function(){
                            window.location.href = "login.php";
                        },2000);
                    </script>
                    <?php  
                }

            }else{
                ?>
                <script type="text/javascript">
                    alert("username tidak ditemukan");
                    settimeout(function(){
                        window.location.href =  "login.php";
                    },1000);
                </script>
                <?php 
            }


        }else{
            ?>
            <script type="text/javascript">
                alert("kolom password tidak boleh kosong");
                settimeout(function(){
                    window.location.href =  "login.php";
                },1000);
            </script>
            <?php  
        }
    }else{
        ?>

        <script type="text/javascript">
            alert("Kolom username tidak boleh kosong");

            settimeout(function(){
                window.location.href =  "login.php";
            },1000);
        </script>

        <?php  
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk akun - Sveltier</title>
    <link rel="stylesheet" type="text/css" href="styleform.css">
</head>
<body>
    <div class="container">
        <h1>Masuk ke dalam akun</h1>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit">Masuk</button>
        </form>
        <p class="login-link">Belum memiliki akun ? <a href="register.php">Daftar</a></p>
    </div>
</body>
 <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>
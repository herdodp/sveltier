<?php 
include "conn123.php";

if(isset($_POST['submit'])){
    $namalengkap = $_POST['namalengkap'];
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $ulangpassword = sha1($_POST['ulangpassword']);


    if(!empty(trim($namalengkap))){
        if(!empty(trim($username))){
            if(!empty(trim($password))){
                if(!empty(trim($ulangpassword))){

                    //sanitize 1
                    $namalengkap1 = mysqli_real_escape_string($koneksi, $namalengkap);
                    $username1 = mysqli_real_escape_string($koneksi, $username);
                    $password1 = mysqli_real_escape_string($koneksi, $password);
                    $ulangpassword1 = mysqli_real_escape_string($koneksi, $ulangpassword);

                    //sanitize 2
                    $namalengkap2 = strip_tags($namalengkap1);
                    $username2 = strip_tags($username1);
                    $password2 = strip_tags($password1);
                    $ulangpassword2 = strip_tags($ulangpassword1);

                    //cek username 
                    $cekusername = "SELECT * FROM account WHERE username = '$username2'";
                    $connCekUsername = mysqli_query($koneksi, $cekusername);


                    if(mysqli_num_rows($connCekUsername) > 0){
                        ?>
                        <script type="text/javascript">
                            alert("Username telah digunakan");
                            setTimeout(function() {
                                window.location.href = "register.php";
                            }, 2000);
                        </script>
                        <?php  
                    }else{



                    }

                    function generateRandomString($length = 10) {
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $randomString = '';

                        for ($i = 0; $i < $length; $i++) {
                            $randomString .= $characters[rand(0, strlen($characters) - 1)];
                        }

                        return $randomString;
                    }

                    $iduser = generateRandomString();


                    //password checking
                    if($ulangpassword == $password){
                        //insert data
                        $insertData = "INSERT INTO account set id_user = '$iduser', namalengkap = '$namalengkap2', username = '$username2', password = '$password2', role = 'common'";
                        $connInsertData = mysqli_query($koneksi, $insertData);

                        //checking progress
                        if($connInsertData){
                            ?>
                            <script type="text/javascript">
                                alert("Berhasil mendaftarkan akun, silahkan gunakan untuk login");
                                window.location.href = "login.php";
                            </script>
                            <?php  
                        }else{
                            ?>
                            <script type="text/javascript">
                                alert("Gagal mendaftar akun, silahkan hubungi administrator");
                                setTimeout(function(){
                                    window.location.href = "register.php";
                                });
                            </script>
                            <?php  
                        }
                    }else{
                        ?>
                        <script type="text/javascript">
                            alert("password yang dimasukkan harus sama, ulangi lagi");
                            setTimeout(function() {
                                window.location.href= "register.php";
                            },2000)
                        </script>
                        <?php 
                    }


                }else{
                    ?>
                    <script type="text/javascript">
                        alert("kolom nama lengkap tidak boleh kosong");
                        setTimeout(function(){
                            window.location.href = "register.php";
                        });
                    </script>
                    <?php
                }
            }else{
                ?>
                <script type="text/javascript">
                    alert("kolom nama lengkap tidak boleh kosong");
                    setTimeout(function(){
                        window.location.href = "register.php";
                    });
                </script>
                <?php   
                }
        }else{
            ?>
            <script type="text/javascript">
                alert("kolom username tidak boleh kosong");
                setTimeout(function(){
                    window.location.href = "register.php";
                });
            </script>
            <?php   
        }
    }else{
        ?>
        <script type="text/javascript">
            alert("kolom nama lengkap tidak boleh kosong");
            setTimeout(function(){
                window.location.href = "register.php";
            });
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
    <title>Daftar - Sveltier</title>
   <link rel="stylesheet" type="text/css" href="styleform.css">
</head>
<body>
    <div class="container">
        <h1>Mari bergabung bersama kami</h1>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="namalengkap">Nama Lengkap</label>
                <input type="text" id="namalengkap" name="namalengkap" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Ulang Password</label>
                <input type="password" id="confirm-password" name="ulangpassword" required>
            </div>
            <button type="submit" name="submit" >Daftar</button>
        </form>
        <p class="login-link">Sudah memiliki akun ? <a href="login.php">Masuk</a></p>
    </div>
</body>
 <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>
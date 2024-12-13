<?php 

include "../conn123.php";
session_start();

//info login
if(!isset($_SESSION['username'])){
	?>
	<script type="text/javascript">
		alert("Anda belum login, silahkan login terlebih dahulu");
		setTimeout(function(){
			window.location.href = "uploadproduk.php";
		},1000)
	</script>
	<?php  

}


$usernamesession = $_SESSION['username'];


//get string
$getstring = $_GET['string'];
$getidtransaksi = $_GET['idtransaksi'];

$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi = '$getidtransaksi'");

while($datatransaksi = mysqli_fetch_array($transaksi)){
	$idtransaksi = $datatransaksi['id_transaksi'];
	$idpemilik = $datatransaksi['id_pemilik'];
	$idpembeli = $datatransaksi['id_pembeli'];
	$idproduk = $datatransaksi['id_produk'];
	$statustransaksi = $datatransaksi['status_transaksi'];
	$timetransaksi = $datatransaksi['time_transaksi'];
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

               $idhistoryrandom = generateRandomString();
               //close random id produk
           




//jika approve atau reject
if($getstring == "approve"){


	//insert data history
	$insertdatahistory = mysqli_query($koneksi, "INSERT INTO history set id_history = '$idhistoryrandom', id_transaction = '$idtransaksi', id_pemilik = '$idpemilik', id_pembeli = '$idpembeli', id_produk = '$idproduk', status = 'done', time_transaction = '$timetransaksi'");

	//delete data transaksi
	$deletedatatransaksi = "DELETE FROM transaksi WHERE id_transaksi = '$idtransaksi' and status_transaksi = 'process'";
	$conndeletedatatransaksi = mysqli_query($koneksi, $deletedatatransaksi);

	if($insertdatahistory){
		if($conndeletedatatransaksi){
			?>
			<script type="text/javascript">
				alert("Transaksi selesai. Terima kasih");
				setTimeout(function(){
					window.location.href = "dashadmin.php";
				}, 1000);
			</script>
			<?php  
		}else{
			?>
			<script type="text/javascript">
				alert("Transaksi gagal. Tidak ada perubahan. silahkan hubungi divisi IT");
				setTimeout(function(){
					window.location.href = "dashadmin.php";
				}, 1000);
			</script>
			<?php 
		}
	}else{
		?>
		<script type="text/javascript">
			alert("Gagal memasukkan data history. silahkan hubungi admin");
			setTimeout(function(){
				window.location.href = "dashadmin.php";
			}, 1000);
		</script>
		<?php  
	}
	

}else if($getstring == "reject"){

	$updatestatusfailed = "UPDATE transaksi set status_transaksi = 'failed' WHERE id_transaksi = '$getidtransaksi2'";
	$connupdatestatusfailed = mysqli_query($koneksi, $updatestatusfailed);
	if($connupdatestatusfailed){
		?>
		<script type="text/javascript">
			alert("Berhasil konfirmasi status reject. Halaman akan refresh dalam 1 detik");
			setTimeout(function(){
				window.location.href = "dashadmin.php";
			}, 1000)
		</script>
		<?php  
	}

}


 ?>
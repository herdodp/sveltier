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


//get string
$getstring = $_GET['string'];
$getidproduk = $_GET['idproduk'];

//sanitize 1
$getstring1 = mysqli_real_escape_string($koneksi, $getstring);
$getidproduk1 = mysqli_real_escape_string($koneksi, $getidproduk);

//sanitize 2
$getstring2 = strip_tags($getstring1);
$getidproduk2 = strip_tags($getidproduk1);


//null check
if(empty($getstring)){
	if(empty($getidproduk)){

			//jika approve atau reject
			if($getstring2 == "approve"){

				$updatestatusapprove = "UPDATE produk set status = 'approve' WHERE id_produk = '$getidproduk2'";
				$connupdatestatusapprove = mysqli_query($koneksi, $updatestatusapprove);
				if($connupdatestatusapprove){
					?>
					<script type="text/javascript">
						alert("Berhasil konfirmasi status approve. Halaman akan refresh dalam 1 detik");
						setTimeout(function(){
							window.location.href = "uploadproduk.php";
						},1000)
					</script>
					<?php  
				}

			}else if($getstring2 == "reject"){

				$updatestatusreject = "UPDATE produk set status = 'reject' WHERE id_produk = '$getidproduk2'";
				$connupdatestatusreject = mysqli_query($koneksi, $updatestatusreject);
				if($connupdatestatusreject){
					?>
					<script type="text/javascript">
						alert("Berhasil konfirmasi status reject. Halaman akan refresh dalam 1 detik");
						setTimeout(function(){
							window.location.href = "uploadproduk.php";
						},1000)
					</script>
					<?php  
				}

			}




	}else{
		?>
		<script type="text/javascript">
			alert("null check id produk empty. contact our administrator");
			setTimeout(function(){
				window.location.href = "dashadmin.php";
			},1000)
		</script>
		<?php  
	}
}else{
	?>
	<script type="text/javascript">
		alert("null check string empty. contact our administrator");
		setTimeout(function(){
			window.location.href = "dashadmin.php";
		},1000)
	</script>
	<?php 
}








 ?>
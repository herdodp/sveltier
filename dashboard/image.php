<?php 

include "../conn123.php";
session_start();

if(!isset($_SESSION['username'])){
	?>
	<script type="text/javascript">
		alert("anda belum login");
		setTimeout(function(){
			window.location.href = '../login.php';
		}, 1000);
	</script>
	<?php  
}

$getstring = $_GET['string'];

//sanitize 1
$getstring1 = mysqli_real_escape_string($koneksi, $getstring);

//sanitize 2
$getstring2 = strip_tags($getstring1);




 ?>
 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title><?php echo $getstring2; ?></title>
  </head>
  <body>
 

 	<!-- open show image -->

 	<div style="display: flex; justify-content: center; margin-top: 100px; margin-bottom: 100px; margin-right: 50px; margin-left: 50px;">

 		<img src="../images/<?php echo $getstring2; ?>" class="rounded mx-auto d-block" alt="<?php echo $getstring2; ?>" style="height: 1000px; width: 1000px; border: 1px solid black; border-radius: 10px;">
 		
 	</div>

 	<!-- close show image -->






  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>

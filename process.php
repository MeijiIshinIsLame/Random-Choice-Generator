<html>

<head>

<title>Random Choice Generator</title>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
	  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	  crossorigin="anonymous">
	 </script>
	 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>
	<div class="container">
		<div class="row">
			<h1>Random Choice Generator</h1>
		</div>
	</div>


	<center><h3>
	<br><br>

	<?php
		session_start();
		
		$_SESSION['post_data'] = array_map('strip_tags', $_POST["choice"]);
		$_SESSION['title'] = strip_tags($_POST["titleChoice"]);
		
		if (!empty($_POST["choice"])){
			$randomNumber = rand(1, sizeof(array_filter($_SESSION['post_data'])));  //do not count empty elements
			$i = 0;

			echo "<b>" . $_SESSION['title'] . "</b><br><br>";
			
			foreach ($_SESSION['post_data'] as $value) {
				if ($value != ""){ //if not empty value
					$i++;
					if ($randomNumber == $i){
						echo  "<b>" . $i . ". " . $value . "</b><br>";
					} 
					else{		
						echo  $i . ". " . $value . "<br>";
					}
				}
			}	
		}
		else{
			echo "No choices were inputted! Would you like to try again?";
		}
		
	?>
	
	<br><br>
	
	<button name="retry" class="btn-lg" onclick="reloadPage();"> Retry </button>
	<a href="../" style="color:black"><button name="back" class="btn-lg">Go back</button></a>
	
	
	
	<!-- Hidden form used for resubmission -->
	<form id="choices" action="process.php" method="post">
	
		<input type="hidden" name="titleChoice" value="<?php echo $_SESSION['title'] ?>">
			<?php				
				foreach ($_SESSION['post_data'] as $choice) {
			?>
			
				<input type="hidden" name="choice[]" value="<?php echo $choice ?>">
			
			<?php } ?>
			
	</form>
	
	 <!-- Resubmits hidden form -->
	<script type="text/javascript">
		function reloadPage()
		{
			document.getElementById('choices').submit();
		}
	</script>

	</h3>
	</center>


</body>

</html>
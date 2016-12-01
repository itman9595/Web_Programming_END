<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Store</title>
		<link rel="stylesheet" type="text/css" href="Css/style.css">
		<script src="jquery.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="container">
			<div align="center"><a href="booksModifier.php" style="top: 25px; position: relative;"><button style="font-size:16px;background-color:MidnightBlue;color:white;padding:5px 20px;">Edit</button></a></div>
			<p id="pretext">Books Store</p>
			<br>
			<?php
				$user = 'root';
				$password = 'root';
				$db = 'inventory';
				$host = 'localhost';
				$port = 8889;

				$conn = new mysqli($host, $user, $password);
				if($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
				
				if ($conn->query("USE store") == TRUE) {
				}
				else {
					echo("Error using store database: " . $conn->error);
				}

				$sql = "SELECT * FROM books";
				$result = $conn->query($sql);
				$ids = array();
				$images = array();
				$titles = array();
				$descriptions = array();
				$authors = array();
				$prices = array();

				if($result->num_rows > 0) {
					echo "<div class='tabs' align='center'>";
					
					$colors = array("blueviolet", "cadetblue", "crimson", "darkorange", "darkseagreen", "darkturquoise", "dodgerblue", "gold", "khaki", "lightblue", "lime", "mediumaquamarine", "mediumpurple", "mediumslateblue", "steelblue");
				    $color = $colors[rand(0,count($colors)-1)];
				    echo "<form action='index.php' method='GET'><input type='submit' name='ChosenGenre' value='All' style='background: ".$color.";'></form>";

				    $chosenGenre = $_GET['ChosenGenre'];

					while($row = $result->fetch_assoc()) {

							$genre = $row["genre"];

						    $data = $row["genre"];
							$genres = array();
						    $token = strtok($data, "_");
						    $i = 0;
						    while($token !==false) {
						        $genres[$i++] = $token;
						        $token = strtok("_");
						    }
						    
						    $exist = false;
						    for ($i=0; $i <count($genres); $i++) {
					    		$color = $colors[rand(0,count($colors)-1)];
								echo "<form action='index.php' method='GET'><input type='submit' name='ChosenGenre' value='".$genres[$i]."' style='background: ".$color.";'></form>";
								if($chosenGenre == $genres[$i])
									$exist = true;
							}

							if($chosenGenre == null || $chosenGenre == "" || $chosenGenre == "All" || $exist)	{
							    array_push($ids, $row["id"]);
								array_push($images, $row["image"]);
								array_push($titles, $row["title"]);
								array_push($descriptions, $row["description"]);
								array_push($authors, $row["author"]);
								array_push($prices, $row["price"]);
						    }
					}
					echo "</div><br>";
					
					echo "<div class='books' align='center'>";
					
					for ($i=0; $i < count($ids); $i++) { 
						echo 
						"<div id=".$ids[$i]." align='center'>
							<image src=".$images[$i]." alt='Book #".$ids[$i]."' height='200'>
							<p>Title: ".$titles[$i]."</p>
							<p>Description:</p>
							<p id='description'>".$descriptions[$i]."</p>
							<p>Author: ".$authors[$i]."</p>
							<p>Price: ".$prices[$i]." tg</p>
						</div>";
					}
					echo "</div>";
						
				}
				else {
					echo "<h4 style='text-align:center'>NO RESULTS ON DATABASE</h4>";
				}
			?>
		</div>
	</body>
</html>
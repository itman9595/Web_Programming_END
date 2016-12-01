<?php
	$host = 'localhost';
	$user = 'root';
	$password = 'root';
	$port = 8889;

	$conn = new mysqli($host, $user, $password);
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS store";
    if ($conn->query($sql) === TRUE) {
    } else {
        alert("Error creating database: " . $conn->error);
    }

    if ($conn->query("USE store") == TRUE) {
    }
    else {
        alert("Error using store database: " . $conn->error);
    }

    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS books (
        id INT(100) UNSIGNED PRIMARY KEY,
        genre TEXT(500) NOT NULL,
        image BLOB NOT NULL,
        title TEXT(500) NOT NULL,
        description TEXT(10000) NOT NULL,
        author TEXT(500) NOT NULL,
        price FLOAT(50) NOT NULL,
        date_added TIMESTAMP
    )";

    if ($conn->query($sql) === TRUE) {
    } else {
        alert("Error creating table: " . $conn->error);
    }

    $data = $_REQUEST["queryForData"];
   
    $collection = array();
    $token = strtok($data, "`");
    $i = 0;
    while($token !==false) {
        $collection[$i++] = $token;
        $token = strtok("`");
    }

    for($i = 1; $i < count($collection); $i++) {
    	
    	$text = $collection[$i];
    	
    	for($j = 0; $j < strlen($text); $j++) {
    		$ch = $text[$j];
    		if($ch == '\\') {
    			$text = substr_replace($text, "\\\\", $j, 1);
    			$j+=2;
    		}
    		else if($ch == "'") {
    			$text = substr_replace($text, "\\'", $j, 1);
    			$j+=2;	
    		}
    		else if($ch == '"') {
    			$text = substr_replace($text, "\\\"", $j, 1);
    			$j+=2;
    		}
    	}

    	$collection[$i] = $text;

    }
    
    $sql = "SELECT id FROM books";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
    	$i = 1;
    	while($row = $result->fetch_assoc()) {
    		$sql = "UPDATE books SET id='".$i++."' WHERE id=".$row['id']."";

			if ($conn->query($sql) === TRUE) {
			} else {
			    echo "Error updating record: " . $conn->error;
			}
    	}
    }

    $id = $result->num_rows;
    $id++;

    $sql = "INSERT INTO books (id, image, genre, title, description, author, price)
    VALUES ('".$id."', '".$collection[0]."', '".$collection[1]."', '".$collection[2]."', '".$collection[3]."', '".$collection[4]."', '".$collection[5]."')";

    if ($conn->query($sql) === TRUE) {
    } else {
        alert("Error: " . $sql . "<br>" . $conn->error);
    }
	
    $conn->close();
?>
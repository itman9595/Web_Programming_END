<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" content="content">
	<title>Test</title>
</head>
<body>
	<?php 
		
		$data =  "http://localhost:8888/END/imgs/george_orwell_1984.jpg" . "`" . "Children's" . "`" . "Nineteen Eighty-Four" . "`" . "In George Orwell's 1984, Winston Smith wrestles with oppression in Oceania, a place where the Party scrutinizes human actions with ever-watchful Big Brother. Defying a ban on individuality, Winston dares to express his thoughts in a diary and pursues a relationship with Julia. These criminal deeds bring Winston into the eye of the opposition, who then must reform the nonconformist. George Orwell's 1984 introduced the watchwords for life without freedom: BIG BROTHER IS WATCHING YOU." . "`" . "George Orwell's" . "`" . "10000";

		$collection = array();
	    $token = strtok($data, "`");
	    $i = 0;
	    while($token !== false) {
	        $collection[$i++] = $token;
	        $token = strtok("`");
	    }
	    
		for($i = 0; $i < count($collection); $i++)
	    	echo $collection[$i] . "<br>";
		
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
	    	if($i == 1)
	    		echo "Genre: ".$collection[$i]."<br>";
	    	if($i == 2)
	    		echo "Title: ".$collection[$i]."<br>";
	    	if($i == 3)
	    		echo "Description: ".$collection[$i]."<br>";
	    	if($i == 4)
	    		echo "Author: ".$collection[$i]."<br>";
	    	if($i == 5)
	    		echo "Price: ".$collection[$i]."<br>";
	    }

	?>
</body>
</html>
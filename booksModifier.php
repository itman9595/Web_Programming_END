<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" content="content">
		<title>BooksDB</title>
		<link rel="stylesheet" type="text/css" href="Css/books.css">
		<script src="jquery.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="container">
			<div class="book">

				<div><a href="index.php" style=""><button style="font-size:16px;background-color:OldLace;color:#336699;padding:5px 20px;">Go Back</button></a></div>
				
				<img id='book_cover' src="imgs/unknown.png" height='200'>
				
				<p>Select a file: <input type="file" onchange="imageUpload(this)"></p>

				<p>Genre: <select id="genresList">
						<option value="Science Fiction">Science Fiction</option>
						<option value="Satire">Satire</option>
						<option value="Drama">Drama</option>
						<option value="Action and Adventure">Action and Adventure</option>
						<option value="Romance">Romance</option>
						<option value="Mystery">Mystery</option>
						<option value="Horror">Horror</option>
						<option value="Self help">Self help</option>
						<option value="Health">Health</option>
						<option value="Guide">Guide</option>
						<option value="Travel">Travel</option>
						<option value="Children's">Children's</option>
						<option value="Religion">Religion</option>
						<option value="Science">Science</option>
						<option value="History">History</option>
						<option value="Math">Math</option>
						<option value="Anthology">Anthology</option>
						<option value="Poetry">Poetry</option>
						<option value="Encyclopedias">Encyclopedias</option>
						<option value="Dictionaries">Dictionaries</option>
						<option value="Comics">Comics</option>
						<option value="Art">Art</option>
						<option value="Cookbooks">Cookbooks</option>
						<option value="Diaries">Diaries</option>
						<option value="Journals">Journals</option>
						<option value="Series">Series</option>
						<option value="Trilogy">Trilogy</option>
						<option value="Biographies">Biographies</option>
						<option value="Autobiographies">Autobiographies</option>
						<option value="Fantasy">Fantasy</option>
					</select>
					<input type="button" value="Add Genre" onclick="listGenres()">
					<div id="genres"></div>
				</p>
				<p>Title: <input type="text" id="title"></p>
				<p>Description: </p>
				<textarea id="description" rows="10" cols="30"></textarea>
				<p>Author: <input type="text" id="author"></p>
				<p>Price: <input type="text" id="price"></p>
				<input type="submit" onclick="actionSubmit()">
			</div>
		</div>
	</body>
	<script text="text/javascript">
		
		var addedGenres = [];
		function getRandomColor() {
		    var colors = ["blueviolet", "cadetblue", "crimson", "darkorange", "darkseagreen", 
		    "darkturquoise", "dodgerblue", "gold", "khaki", "lightblue", "lime", "mediumaquamarine", "mediumpurple",
		    "mediumslateblue", "steelblue"];
		    return colors[Math.floor(Math.random() * colors.length)];
		}

		function listGenres() {
			var valid = true;
			var e = document.getElementById("genresList");
			var genreName = e.options[e.selectedIndex].text;
			for (var i = 0; i < addedGenres.length; i++) {
				if(addedGenres[i] == genreName)
					valid = false;
			};
			if(valid) {
				var div = document.createElement("div");
				var node = document.createTextNode(genreName);
				div.appendChild(node);
				div.style.border = "solid 2px black";
				div.style.borderRadius = "10px";
				div.style.backgroundColor = getRandomColor();
				div.style.padding = '5px 5px';
				div.style.display = "inline-block";
				div.style.marginRight = "2px";
				div.style.marginBottom = "2px";
				var genres = document.getElementById("genres");
				genres.style.background = "white";
				genres.style.padding = "5px";
				genres.style.width = "94%";
				genres.appendChild(div);
				addedGenres.push(div.innerHTML);
			}
		}

		function imageUpload(input) {
			$('#book_cover').attr('src', "imgs/"+input.files[0].name);
		}

		function actionSubmit() {
			var genre = "";
			for (var i = 0; i < addedGenres.length; i++) {
				genre += addedGenres[i];
				if(i != addedGenres.length-1)
					 genre += "_";
			};

			var image_link = document.getElementById("book_cover").src;
			var title = document.getElementById("title").value;
			var description = document.getElementById("description").value;
			var author = document.getElementById("author").value;
			var price = document.getElementById("price").value;

			var data = image_link + "`" + genre + "`" + title + "`" + description + "`" + author + "`" + price;
			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				}
			};
			xhttp.open("GET", "checkForBooksModification.php?queryForData="+data, true);
			xhttp.send();
		}	

	</script>
</html>
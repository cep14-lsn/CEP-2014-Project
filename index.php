!ipp[setv pagename Home]
<html>
	<head>
		!ipp[_cep14_insert components/_head.html]
		<style>
			.carousel {
			    width : 100%;
			    height: 500px;
			    margin-bottom: 60px;
			    background-color: #000;
			}
			.carousel-caption {
			    z-index: 10;
			}
			.carousel .item {
			    height: 500px;
			}
			.carousel-inner > .item > img {
			    /*position: absolute;*/
			    top: 4%;
			    margin-left : auto;
			    margin-right : auto;
			    height: 300px;
			    /*width: 500px;*/
			}
		</style>
	</head>
	<body>
		!ipp[_cep14_insert components/_navbar.html]
		<div class = "container">
			<div id = "foodcarousel" class = "carousel slide" data-ride = "carousel">
				<ol class = "carousel-indicators">
					<li data-target = "#foodcarousel" data-slide-to = "0" class = "active"></li>
					<li data-target = "#foodcarousel" data-slide-to = "1"></li>
					<li data-target = "#foodcarousel" data-slide-to = "2"></li>
				</ol>
				<div class = "carousel-inner">
					<div class = "item active">
						<img src = "burgercombo.gif" alt = "First slide" />
						<div class = "container">
							<div class = "carousel-caption">
								<h1>Set Meals</h1>
								<p>Explore our diverse set meal options that will fill you up for low cost.</p>
								<p><a class = "btn btn-lg btn-primary" href = "menu.php" role = "button">Explore the menu</a></p>
							</div>
						</div>
					</div>
					<div class = "item">
						<img src = "megafries.png" alt = "Second slide" />
						<div class = "container">
							<div class = "carousel-caption">
								<h1>Fries</h1>
								<p>Our fries are known all around the region. Grab some fries and share them with friends, or eat them yourself!</p>
								<p><a class = "btn btn-lg btn-primary" href = "menu.php" role = "button">Fries and other food</a></p>
							</div>
						</div>
					</div>
					<div class = "item">
						<img src = "Tripleburger.png" alt = "Third slide" />
						<div class = "container">
							<div class = "carousel-caption">
								<h1>Burgers</h1>
								<p>Huge burgers. Few calories. That's right, more great-tasting food and less calories! What could be better?</p>
								<p><a class = "btn btn-lg btn-primary" href = "menu.php" role = "button">Find other healthy meal choices</a></p>
							</div>
						</div>
					</div>
				</div>
				<a class = "left carousel-control" href = "#foodcarousel" role = "button" data-slide = "prev"><span class = "glyphicon glyphicon-chevron-left"></span></a>
				<a class = "right carousel-control" href = "#foodcarousel" role = "button" data-slide = "next"><span class = "glyphicon glyphicon-chevron-right"></span></a>
			</div>
		</div>
		!ipp[_cep14_insert components/_footer.html]
	</body>
</html>

!ipp[setv pagename Menu]
<html>
	<head>
		!ipp[_cep14_insert components/_head.html]
		<style>
		.food-item {
			text-align : center;
			background-color : #222;
			border-radius : 10px;
			padding : 10px;
		}
		.food-item > img {
			height : 200px;
			width : auto;
			margin-left : auto;
			margin-right : auto;
		}
		.food-item > .food-desc {
			display : none;
			width : 100%;
			background-color : #444;
			border-radius : 10px;
			text-align : justify;
			padding : 10px;
		}
		.food-item:hover > .food-desc {
			display : block;
		}
		</style>
	</head>
	<script>
		var infoFood;
		var xh = new XMLHttpRequest();
		xh.onreadystatechange = function () {
			if ( xh.readyState == 4 && xh.status == 200 ) {
				infoFood = JSON.parse( xh.responseText );
			}
		}
		xh.open( "GET" , "js/food_info.json" , true )
		xh.send()
		function menuCont( $scope ) {
			$scope.foods = infoFood;
			$scope.process = function ( l ) {
				return l.join("<br>");
			}
		}
	</script>
	<body>
		<!--<div class = "menu-desc">
			<h1 style = "font-size:20pt"> A wide and delectable selection of fine foods!</h1>
			<h2 style = "font-size:8pt"> P.S. If any food item starts a conversation with you, please incinerate it.</h2>-->
		!ipp[_cep14_insert components/_navbar.html]
		<div ng-app = "" ng-controller = "menuCont" class="container-fluid">
			<div class = "container">
				<div class = "page-header">
					<h1>Set meals <small>to be had anywhere; à la carte or as a set meal</small></h1>
				</div>
				<div ng-repeat = "mealset in foods.mealSet">
					<div class = "row">
						<div class = "col-xs-12 col-md-6 meal-pic">
							<img ng-src = "{{mealset.img}}" alt = "Meal image" />
						</div>
						<div class = "col-xs-12 col-md-6 meal-info">
							<strong>{{ set.name }}</strong>
							<p class = "text-muted"><i>{{ process( mealset.desc ) }}</i></p>
							<table>
								<tr>
									<th>Nutritional Information</th>
								</tr>
								<tr>
									<td>Energy</td>
									<td>{{ mealset.nutrition.calorie }} kcal</td>
								</tr>
								<tr>
									<td></td>
									<td>{{ mealset.nutrition.calorie * 4.2 }} kJ</td>
								<tr>
									<td>Carbohydrates</td>
									<td>{{ mealset.nutrition.carbohydrate / 5 }} g</td>
								</tr>
								<tr>
									<td>Fats</td>
									<td>{{ mealset.nutrition.fats }} mg</td>
								</tr>
								<tr>
									<td>Protein</td>
									<td>{{ mealset.nutrition.protein / 5 }} g</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		!ipp[_cep14_insert components/_footer.html]
	</body>
</html>

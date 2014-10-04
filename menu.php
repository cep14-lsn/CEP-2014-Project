!ipp[setv pagename Menu]
<html>
	<head>
		!ipp[_cep14_insert components/_head.html]
		<style>
		.food-item {
			background-color : #222;
			border-radius : 10px;
			padding : 10px;
			margin : 10px;
		}
		.food-item > .food-pic {
			text-align : center;
		}
		.food-item > .food-pic > img {
			max-height : 500px;
			max-width : 100%;
		}
		</style>
	</head>
	<script>
		var infoFood;
		var xh = new XMLHttpRequest();
		xh.onreadystatechange = function () {
			if ( xh.readyState == 4 && xh.status == 200 ) {
				console.log( xh.responseText );
				infoFood = JSON.parse( xh.responseText );
			}
		}
		xh.open( "GET" , "js/food_info.json" , false );
		xh.send();
		infoFood = JSON.parse( xh.responseText );
		function menuCont( $scope ) {
			$scope.foods = infoFood;
			$scope.process = function ( l ) {
				return l.join("\n");
			}
		}
	</script>
	<body>
		<!--<div class = "menu-desc">
			<h1 style = "font-size:20pt"> A wide and delectable selection of fine foods!</h1>
			<h2 style = "font-size:8pt"> P.S. If any food item starts a conversation with you, please incinerate it.</h2>-->
		!ipp[_cep14_insert components/_navbar.html]
		<div ng-app = "" ng-controller = "menuCont" class="container-fluid">
			<div class = "container" ng-repeat = "categoryinfo in [['mealSet','Set meals','to be had anywhere; à la carte or as a set meal','setmeals'],['mealSide','Side Dishes','to eat on the go, or as supplements to a fantastic meal','sidedishes'],['drinks','Drinks','thirst quenchers','drinks']]">
				<div class = "page-header" id = "{{ categoryinfo[3] }}">
					<h1>{{ categoryinfo[1] }} <small>{{ categoryinfo[2] }}</small></h1>
				</div>
				<div ng-repeat = "mealset in foods[categoryinfo[0]]">
					<div class = "row food-item">
						<div class = "col-xs-12 col-md-6 food-pic">
							<img ng-src = "{{mealset.img}}" alt = "Meal image" />
						</div>
						<div class = "col-xs-12 col-md-6 food-info">
							<strong>{{ mealset.name }}</strong>
							<p class = "text-muted"><i>{{ process( mealset.desc ) }}</i></p>
							<table class = "table">
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

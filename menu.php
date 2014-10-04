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
			.food-lore {
				font-style:italic;
				color:#aaa;
				font-size:14px;
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
		};
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
		!ipp[_cep14_insert components/_navbar.html]
		<div data-ng-app = "" data-ng-controller = "menuCont" class="container-fluid">
			<div class = "container" data-ng-repeat = "categoryinfo in [['mealSet','Set meals','to be had anywhere; à la carte or as a set meal','setmeals'],['mealSide','Side Dishes','to eat on the go, or as supplements to a fantastic meal','sidedishes'],['drinks','Drinks','thirst quenchers','drinks']]">
				<div class = "page-header" id = "{{ categoryinfo[3] }}">
					<h1>{{ categoryinfo[1] }} <span class="text-small">{{ categoryinfo[2] }}</span></h1>
				</div>
				<div data-ng-repeat = "meal in foods[categoryinfo[0]]">
					<div class = "row food-item">
						<div class = "col-xs-12 col-md-6 food-pic">
							<img data-ng-src = "{{meal.img}}" alt = "Meal image" />
						</div>
						<div class = "col-xs-12 col-md-6 food-info">
							<div class = "page-header">
								<h2>{{ meal.name }} <span class="text-small" data-ng-show = "meal.cost.meal"><abbr title="Set Meal">{{ meal.cost.meal | currency }}</abbr> | <abbr title="&Agrave; la carte">{{ meal.cost.alc | currency }}</abbr></span><span class="text-small" data-ng-hide = "meal.cost.meal">{{ meal.cost.side | currency }}</span> <span class = "label label-primary" data-ng-show = "meal.new">NEW!</span></h2>
							</div>
							<p class = "linebreak">{{ process( meal.desc ) }}</p>
							<p class="tex-muted food-lore linebreak">{{ process( meal.lore ) }}</p>
							<table class="table">
								<tr>
									<th>Nutritional Information</th>
									<th></th>
								</tr>
								<tr>
									<td rowspan=2>Energy</td>
									<td>{{ meal.nutrition.calorie }} kcal</td>
								</tr>
								<tr>
									<td>{{ meal.nutrition.calorie * 4.2 }} kJ</td>
								<tr>
									<td>Carbohydrates</td>
									<td>{{ meal.nutrition.carbohydrate / 5 }} g</td>
								</tr>
								<tr>
									<td>Fats</td>
									<td>{{ meal.nutrition.fats }} mg</td>
								</tr>
								<tr>
									<td>Protein</td>
									<td>{{ meal.nutrition.protein / 5 }} g</td>
								</tr>
								<tr>
									<td>Sodium</td>
									<td>{{ meal.nutrition.salt }} mg</td>
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

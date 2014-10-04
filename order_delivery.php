!ipp[setv pagename Delivery]
<html>
	<head>
	!ipp[_cep14_insert components/_head.html]
	<script src="js/hash.js"></script>
		<style>
			.alc {
				color:#999;
				font-size:14px;
			}
			img.food-icon {
				max-height: 200px;
				max-width: 100%
			}
		</style>
		<script>
			var GST = 0.07;
			var SVC = 0.10;
			var infoFood;
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {
				if(xhr.readyState == 4 && xhr.status == 200){
					infoFood = JSON.parse(xhr.responseText);
				}
			};
			xhr.open("GET", "js/food_info.json", false);
			xhr.send();
			infoFood = JSON.parse(xhr.responseText);
			deliverMeal = function($scope) {
				GST = 0.07;
				SVC = 0.10;
				$scope.infoFood = infoFood;
				$scope.displayMeals = false;
				$scope.dDist = 42;
				$scope.expenseDelivery = 0;
				$scope.expenseFood = 0;
				$scope.expenseGT = 0;
				$scope.cart = {
					"mealSet": [],
					"mealSide": [],
					"drinks": []
				};
				$scope.dLocation = Math.floor(Math.random() * 1000000);
				$scope.calcCosts = function(){
					$scope.expenseFood = 0;
					var itemStack;
					var itemType;
					for(itemType in $scope.cart){
						for(itemStack in itemType){
							$scope.expenseFood += itemStack.number * $scope["infoFood"][itemStack.name]["cost"][itemStack.type];
						}
					}
					$scope.expenseDelivery = $scope.dDist * 2.5 + 1;
					$scope.expenseTotal = ($scope.expenseDelivery + $scope.expenseFood) * (1 + GST) * (1 + SVC);
				};
				$scope.updateCart = function(category, number, name, type) {
					var itemType;
					var itemStack;
					var found = false;
					for(itemType in $scope.cart){
						for(itemStack in itemType){
							if(itemType.name == name){
								found = true;
								itemType.number = number;
								break;
							}
						}
					}
					if(!found){
						$scope.cart[category].push({
							"number": number,
							"name": name,
							"type": type
						});
					}
	
					$scope.calcCosts();
				}
				$scope.calcDist = function(){
					$scope.dDist = Math.round(hash($scope.dLocation).charCodeAt(0) / 2) / 10;
				}
				$scope.dDist = $scope.calcDist;
			}
			function deliCont( $scope ) {
				$scope.foodinfo = infoFood;
				$scope.foods = [];
				$scope.newcartitem = {}
				$scope.dds = [{
					"name" : "Choose a food item ...",
					"options" : [],
					"itemclick" : $scope.newcartitem_choose
				}];
				for ( k in infoFood ) {
					for ( var i = 0 ; i < infoFood[k].length ; i++ ) {
						$scope.foods.push( infoFood[k][i] );
						$scope.dds[0].options.push( {"food":infoFood[k][i],"display":infoFood[k][i].name} );
					}
				}
				$scope.newcartitem_choose = function( item ) {
					var f = item.food;
					$scope.dds[0].name = f.name
					if ( f.cost.meal ) {
						$scope.dds.push({
							"name" : "Set Meal",
							"options" : [
								{"display" : "Set Meal"},
								{"display" : "À la carte"},
							],
							"itemclick" : $scope.newcartitem_ordermode
						});
						var sd = {
							"name" : "Select a Side Dish ...",
							"options" : []
						};
						for ( var i = 0 ; i < infoFood.mealSide.length ; i++ ) {
							sd.options.push( {"food":infoFood.mealSide[i],"display":infoFood.drinks[i].name} );
						}
						var drink = {
							"name" : "Select a Drink ...",
							"options" : []
						}
						for ( var i = 0 ; i < infoFood.drinks.length ; i++ ) {
							drink.options.push( {"food":infoFood.drinks[i],"display":infoFood.drinks[i].name} );
						}
						$scope.dds.push( sd );
						$scope.dds.push( drink );
					} else {
						while ( $scope.dds.length > 1 ) {
							$scope.dds.pop();
						}
					}
				}
			}
		</script>
	</head>
	<body>
		!ipp[_cep14_insert components/_navbar.html]
		<div class="container-fluid" data-ng-app="" data-ng-controller="deliCont">
			<div class = "page-header">
				<h1>Delivery <small>for your convenience of having your food anywhere you like</small></h1>
			</div>
			<!--<h1>Why deliver?</h1>
			<p>Exhausted after a long day of school/work? Or do you want to just laze at home with your friends and family?</p>
			<p>No problem - we can deliver the food straight to your house!</p>
			<p>For a small extra fee based on your distance from our nearest branch, you can enjoy MekDoornels&rsquo; wonderful food in the comfort of your home.</p>
			<hr>-->
			<div class = "container">
				<div class = "page-header">
					<h2>Step 1 <small>look through the menu</small></h2>
				</div>
				<p>Look for one of our wonderful and suitable meal set that suits your dietary choices here.</p>
				<p><a class="btn btn-primary" href="menu.php">Menu <span class="glyphicon glyphicon-chevron-right"></span></a></p>
				<div class = "page-header">
					<h2>Step 2 <small>choose your food</small></h2>
				</div>
				<abbr title = "All of them!">Which one of those meals just beg to be eaten?</abbr>
				<p>So choose any of them now!</p>
				<div class = "panel panel-primary">
					<div class = "panel-heading">
						New Item
					</div>
					<div class = "panel-body">
						<div class = "btn-group" ng-repeat = "dd in dds">
							<button type = "button" class = "btn btn-default dropdown-toggle" data-toggle = "dropdown">
								{{ dd.name }}
								<span class = "caret"></span>
							</button>
							<ul class = "dropdown-menu" role = "menu">
								<li ng-repeat = "c in dd.options">
									<a href = "#" ng-click = "c.itemclick( c )">
										{{ c.display }}
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<a href = "#" ng-click = "addrow()" class = "btn btn-primary">Add to Cart</a>
				<div class = "panel panel-primary">
					<div class = "panel-heading">
						Items in Cart
					</div>
					<div class = "panel-body">
						<table class = "table">
							<tr>
								<th>Item</th>
								<th>Cost</th>
								<th>Qty</th>
								<th>Price</th>
							</tr>
							<!--<tr ng-repeat = "item in items">
								<th>{{ item.name }}</th>
								<th>{{ item.cost }}</th>
								<th>{{ item.qty }}</th>
								<th>{{ item.price }}</th>
							</tr>-->
						</table>
					</div>
				</div>
				<div class = "page-header">
					<h2>Step 3 <small>choose where you are eating</small></h2>
				</div>
				<p>Select where you want to eat!</p>
				<table class = "table">
					<tr>
						<td>Postal Code</td>
					</tr>
					<tr>
						<td>Distance</td>
					</tr>
					<tr>
						<td>Delivery Expenses</td>
					</tr>
					<tr>
						<td>Food Expenditure</td>
					</tr>
					<tr>
						<td>Total Expenditure</td>
					</tr>
				</table>
				<a href = "#" ng-click = "order()" class = "btn btn-primary">Place order <span class = "glyphicon glyphicon-chevron-right"></span></a>
			</div>
		</div>
		!ipp[_cep14_insert components/_footer.html]
	</body>
</html>

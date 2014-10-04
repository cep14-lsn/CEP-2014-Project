!ipp[setv pagename Delivery]
<html>
    <head>
        !ipp[_cep14_insert components/_head.html]
        <script src="js/md5.js"></script>
		<style>
			.alc {
				color:#999;
				font-size:14px;
			}
		</style>
		<script>
			var infoFood;
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {
				if(xhr.readyState == 4 && xhr.status == 200){
					console.log(xh.responseText);
					infoFood = JSON.parse(xh.responseText);
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
				$scope.dDist = 0;
				$scope.expenseDelivery = 0;
				$scope.expenseFood = 0;
				$scope.expenseGT = 0;
				$scope.cart = {
					"mealSet": [],
					"mealSide": [],
					"drinks": []
				};
				$scope.dLocation = "Summit of Olympus Mon";

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
					// Hash dLocation
				}

			}
		</script>
    </head>
    <body>
        !ipp[_cep14_insert components/_navbar.html]
        <div class="container-fluid" data-ng-app="" data-ng-controller="deliverMeal">
	        <h1>Why deliver?</h1>
	        <p>Exhausted after a long day of school/work? Or do you want to just laze at home with your friends and family?</p>
	        <p>No problem - we can deliver the food straight to your house!</p>
	        <p>For a small extra fee based on your distance from our nearest branch, you can enjoy MekDoornels&rsquo; wonderful food in the comfort of your home.</p>
	        <hr>
	        <h1>Step 1: Look through the Menu</h1>
	        <p>Look for one of our wonderful and suitable meal set that suits your dietary choices here.</p>
	        <p><a class="btn btn-primary" href="menu.php">Menu <span class="glyphicon glyphicon-chevron-right"></span></a></p>
	        <hr>
	        <h1>Step 2: Choose your food</h1>
			<p>Which one of those meals just beg to be eaten? (Answer: it's all of them!)</p>
			<p>Current cost: {{ expenseTotal | currency }}</p>
			<p>So choose any of them now!</p><br>
			<div class="container-fluid">
				<h2>A. Set Meals</h2>
				<p>Fun for the whole family! Order one per person. Available only as a set.</p>
				<div class="container-fluid" data-ng-repeat="mealSet in infoFood.mealSet">
					<h3>{{ mealSet.name }}</h3>
					<img data-ng-src="{{ mealSet.img }}" class="food-icon" alt="Meal icon">
					<p>Unit Cost: <abbr title="As a set">{{ mealSet.cost.meal | currency }}</abbr> | <abbr title="As &agrave; la carte at a branch"><span class="alc">{{ mealSet.cost.alc | currency }}</span></abbr></p>
					<p>Quantity: <input type="number" data-ng-model="mealSet.qty" data-ng-change="updateCart('mealSet', mealSet.qty, mealSet.name, 'meal')"></p>
					<p>Total Cost: {{ mealSet.cost.meal * mealSet.qty | currency }} </p>
				</div>
			</div>
			<br>
	        <div class="container-fluid">
				<h2>B. Side Meals</h2>
				<p>A quick snack when watching something exciting, be it movies, football, anime...</p>
				<div class="container-fluid" data-ng-repeat="mealSide in infoFood.mealSide">
					<h3>{{ mealSide.name }}</h3>
					<img data-ng-src="{{ mealSide.img }}" class="food-icon" alt="Meal icon">
					<p>Unit Cost: {{ mealSide.cost.side | currency }}</p>
					<p>Quantity: <input type="number" data-ng-model="mealSide.qty" data-ng-change="updateCart('mealSide', mealSide.qty, mealSide.name, 'side')"></p>
					<p>Total Cost: {{ mealSide.cost.side * mealSide.qty | currency }}</p>
				</div>
			</div>
			<br>
			<div class="container-fluid">
				<h2>C. Drinks</h2>
				<p>Satisfying thirst quenchers!</p>
				<div class="container-fluid" data-ng-repeat="drinks in infoFood.drinks">
					<h3>{{ drinks.name }}</h3>
					<img data-ng-src="{{ drinks.img }}" class="food-icon" alt="Meal icon">
					<p>Unit Cost: {{  drinks.cost.side | currency }}</p>
					<p>Quantity: <input type="number" data-ng-model="drinks.qty" data-ng-change="updateCart('drinks', drinks.qty, drinks.name, 'side')"></p>
					<p>Total Cost: {{ drinks.cost.side * drinks.qty | currency }}</p>
				</div>
			</div>
			<hr>
			<h1>Step 3: Choose where you are eating</h1>
			<p>Select where you would like to eat!</p>
			<table>
				<tr>
					<td>Postal Code</td>
					<td><input type="number" data-ng-model="dLocation" data-ng-change="calcDist()"></td>
				</tr>
				<tr>
					<td>Distance</td>
					<td>{{ dDist }} km</td>
				</tr>
				<tr>
					<td>Delivery Expenses</td>
					<td>{{ expenseDelivery | currency }}</td>
				</tr>
				<tr>
					<td>Food Expenditure</td>
					<td>{{ expenseFood | currency }}</td>
				</tr>
				<tr>
					<td>Total Expenditure</td>
					<td>{{ expenseTotal | currency }}</td>
				</td>
			</table>
        </div>
        !ipp[_cep14_insert components/_footer.html]
    </body>
</html>

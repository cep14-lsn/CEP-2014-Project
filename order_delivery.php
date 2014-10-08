!ipp[setv pagename Delivery]
<html>
	<head>
	!ipp[_cep14_insert components/_head.html]
	<script src="js/hash.js"></script>
		<style>
			img.food-icon {
				max-height: 200px;
				max-width: 100%
			}
		</style>
		<script>
			var GST = 0.07;
			var SVC = 0.10;
			var COST_PER_KM = 0.2;
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
			function deliCont( $scope , $filter ) {
				$scope.itemclick = function( item ) {
					item.handler( item );
				}
				$scope.newcartitem_ordermode = function( item ) {
					$scope.dds[1].name = item.display;
					if ( item.display == "Set Meal" ) {
						while ( $scope.dds.length > 1 ) {
							$scope.dds.pop();
						}
						$scope.newcartitem_choose( {"food":$scope.newcartitem.food} );
					} else {
						while ( $scope.dds.length > 2 ) {
							$scope.dds.pop();
						}
						$scope.newcartitem.mode = "alc";
						delete $scope.newcartitem.drink;
						delete $scope.newcartitem.side;
					}
				}
				$scope.newcartitem_mealside = function( item ) {
					$scope.dds[2].name = item.display;
					$scope.newcartitem.side = item.food;
				}
				$scope.newcartitem_drink = function( item ) {
					$scope.dds[3].name = item.display;
					$scope.newcartitem.drink = item.food;
				}
				$scope.newcartitem_choose = function( item ) {
					var f = item.food;
					$scope.dds[0].name = f.name;
					$scope.newcartitem.food = f;
					delete $scope.newcartitem.drink;
					delete $scope.newcartitem.side;
					delete $scope.newcartitem.mode;
					while ( $scope.dds.length > 1 ) {
						$scope.dds.pop();
					}
					if ( f.cost.meal ) {
						$scope.dds.push({
							"name" : "Set Meal",
							"options" : [
								{ "display" : "Set Meal" , "handler" : $scope.newcartitem_ordermode },
								{ "display" : "À la carte" , "handler" : $scope.newcartitem_ordermode },
							]
						});
						$scope.newcartitem.mode = "set";
						var sd = {
							"name" : "Select a Side Dish ...",
							"options" : []
						};
						for ( var i = 0 ; i < infoFood.mealSide.length ; i++ ) {
							sd.options.push( {"food":infoFood.mealSide[i],"display":infoFood.mealSide[i].name,"handler":$scope.newcartitem_mealside} );
						}
						sd.options.push( {"food":{"name":""},"display":"None","handler":$scope.newcartitem_mealside} );
						var drink = {
							"name" : "Select a Drink ...",
							"options" : []
						}
						for ( var i = 0 ; i < infoFood.drinks.length ; i++ ) {
							drink.options.push( {"food":infoFood.drinks[i],"display":infoFood.drinks[i].name,"handler":$scope.newcartitem_drink} );
						}
						drink.options.push( {"food":{"name":""},"display":"None","handler":$scope.newcartitem_drink} );
						$scope.dds.push( sd );
						$scope.dds.push( drink );
					}
				}
				$scope.itemcost = function( item ) {
					return item.food ? item.mode ? item.mode == "alc" ? item.food.cost.alc : item.food.cost.meal : item.food.cost.side : 0;
				}
				$scope.addcart = function() {
					$scope.newcartitem.instr = $scope.instr;
					$scope.items.push( $scope.newcartitem );
					$scope.totalcost = 0;
					for ( var i = 0 ; i < $scope.items.length ; i++ ) {
						$scope.totalcost += $scope.itemcost( $scope.items[i] );
						$scope.totalcost += $scope.items[i].instr.trim() ? 0.30 : 0;
					}
					$scope.updatePostalCode()
					$scope.instr = "";
					$scope.newcartitem = {};
					$scope.dds = [{
						"name" : "Choose a food item ...",
						"options" : []
					}];
					for ( var i = 0 ; i < $scope.foods.length ; i++ ) {
						$scope.dds[0].options.push( {"food":$scope.foods[i],"display":$scope.foods[i].name,"handler":$scope.newcartitem_choose} );
					}
				}
				$scope.canaddcart = function () {
					return $scope.newcartitem.food && !( $scope.newcartitem.mode == "set" && !( $scope.newcartitem.side && $scope.newcartitem.drink ) );
				}
				$scope.updatePostalCode = function () {
					if ( $scope.pc && $scope.pc.length == 6 && $scope.pc < 1000000 ) {
						var s = $scope.pc;
						var r = "";
						for ( var i = 0 ; i < s.length ; i++ ) {
							r += s[ s.length - i - 1 ];
						}
						$scope.distance = hashdigest( hash( s ) ) * hashdigest( hash( r ) ) / 100;
						$scope.distancecharge = $scope.distance * COST_PER_KM;
						$scope.foodgst = $scope.totalcost * GST;
						$scope.svccharge = ( $scope.totalcost + $scope.distancecharge + $scope.foodgst + 3 ) * SVC;
					}
				}
				$scope.order = function () {
					if ( !confirm("Are you sure you want to place this order?") ) {
						tellUser("Order cancelled.");
						return;
					}
					tellUser( $filter("currency")( $scope.totalcost + $scope.distancecharge + $scope.foodgst + $scope.svccharge + 3 ) + " has been deducted from your account. Please enjoy your food." );
					$scope.addcart();
					$scope.foods = [];
					$scope.items = [];
					$scope.totalcost = 0;
					$scope.distance = 0;
					$scope.distancecharge = 0;
					$scope.foodgst = 0;
					$scope.svccharge = 0;
					$scope.pc = "";
					for ( var i = 0 ; i < 6 ; i++ ) {
						$scope.pc += Math.floor( Math.random() * 10 );
					}
				}
				$scope.canorder = function () {
					return $scope.pc && $scope.pc.length == 6 && $scope.pc < 1000000 && $scope.items.length > 0;
				}
				$scope.removecart = function( item ) {
					for ( var i = 0 ; i < $scope.items.length ; i++ ) {
						if ( $scope.items[i] == item ) {
							$scope.items.splice( i , 1 );
							break;
						}
					}
					$scope.totalcost = 0;
					for ( var i = 0 ; i < $scope.items.length ; i++ ) {
						$scope.totalcost += $scope.itemcost( $scope.items[i] );
					}
					$scope.updatePostalCode()
				}
				$scope.foodinfo = infoFood;
				$scope.totalcost = 0;
				$scope.distance = 0;
				$scope.distancecharge = 0;
				$scope.foodgst = 0;
				$scope.svccharge = 0;
				$scope.instr = "";
				$scope.foods = [];
				$scope.items = [];
				$scope.newcartitem = {}
				$scope.dds = [{
					"name" : "Choose a food item ...",
					"options" : []
				}];
				for ( k in infoFood ) {
					for ( var i = 0 ; i < infoFood[k].length ; i++ ) {
						$scope.foods.push( infoFood[k][i] );
						$scope.dds[0].options.push( {"food":infoFood[k][i],"display":infoFood[k][i].name,"handler":$scope.newcartitem_choose} );
					}
				}
				$scope.pc = "";
				for ( var i = 0 ; i < 6 ; i++ ) {
					$scope.pc += Math.floor( Math.random() * 10 );
				}
				$scope.updatePostalCode()
			}
		</script>
	</head>
	<body>
		!ipp[_cep14_insert components/_navbar.html]
		<div class = "page-header">
			<h1>Delivery <span class="text-small">for your convenience of having your food anywhere you like</span></h1>
		</div>
		<div class="container-fluid" data-ng-app="" data-ng-controller="deliCont">
			<div class = "container">
				<div class = "page-header">
					<h2>Step 1 <span class="text-small">look through the menu</span></h2>
				</div>
				<p>Look for one of our wonderful and suitable meal sets that suits your dietary choices here.</p>
				<p><a class="btn btn-primary" href="menu.php">Menu <span class="glyphicon glyphicon-chevron-right"></span></a></p>
				<div class = "page-header">
					<h2>Step 2 <span class="text-small">choose your food</span></h2>
				</div>
				<abbr title = "All of them!">Which one of those meals just beg to be eaten?</abbr>
				<p>So choose any of them now!</p>
				<div class = "panel panel-primary">
					<div class = "panel-heading">
						New Item
					</div>
					<div class = "panel-body">
						<div class = "row">
							<div class = "col-xs-12">
								<div class = "btn-group">
									<div class = "btn-group" data-ng-repeat = "dd in dds">
										<button type = "button" class = "btn btn-default dropdown-toggle" data-toggle = "dropdown">
											{{ dd.name }}
											<span class = "caret"></span>
										</button>
										<ul class = "dropdown-menu" role = "menu">
											<li data-ng-repeat = "c in dd.options">
												<a href = "#" onclick = "return false;" data-ng-click = "itemclick( c )">
													{{ c.display }}
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class = "row">
							<div class = "col-xs-12 col-md-4">
								<p><abbr title = "30 cents charged per item with attached requests">Preparation instructions / requests</abbr>:</p>
							</div>
							<div class = "col-xs-12 col-md-8">
								<input type = "text" class = "form-control" data-ng-model = "instr" maxlength = "60" />
							</div>
						</div>
					</div>
				</div>
				<a href = "#" onclick = "return false;" data-ng-click = "addcart()" class = "btn btn-primary" data-ng-show = "canaddcart()"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</a>
				<a class = "btn btn-primary" disabled = "disabled" data-ng-hide = "canaddcart()"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</a>
				<div class = "panel panel-primary">
					<div class = "panel-heading">
						Items in Cart
					</div>
					<div class = "panel-body">
						<table class = "table">
							<tr>
								<th>Item</th>
								<th>Price</th>
							</tr>
							<tr data-ng-repeat = "item in items">
								<td>
									{{ item.food.name + ( item.mode ? item.mode == "alc" ? " / À la carte" : ( " / Set Meal / " + item.side.name + ( item.side.name && item.drink.name ? " + " : "" ) + item.drink.name ) : "" ) }}
									<abbr title = "All funds raised in this manner go to the Take-a-Wish Foundation." data-ng-hide = "item.mode != 'set' || item.side.name || item.drink.name">Paying extra for nothing</abbr>
									<p class = "in-the-line" data-ng-show = "item.instr.trim()"><br />Special Order: {{ item.instr.trim() }}</p>
								</td>
								<td>{{ itemcost(item) | currency }} <abbr data-ng-show = "item.instr.trim()" title = "Attached request">+ $0.30</abbr><button type = "button" data-ng-click = "removecart(item)" class = "close"><span data-aria-hidden = "true" class="glyphicon glyphicon-remove"></span><span class = "sr-only">Close</span></button></td>
							</tr>
							<tr>
								<td>Total Cost</td>
								<td>{{ totalcost | currency }}</td>
							</tr>
						</table>
					</div>
				</div>
				<div class = "page-header">
					<h2>Step 3 <span class="text-small">choose where you are eating</span></h2>
				</div>
				<p>Select where you want to eat!</p>
				<table class = "table">
					<tr>
						<td>Postal Code</td>
						<td><input type = "text" data-ng-model = "pc" class = "form-control{{ pc.length == 6 && pc < 1000000 ? '' : ' data-ng-invalid' }}" data-ng-change = "updatePostalCode()" /></td>
					</tr>
					<tr>
						<td>Distance</td>
						<td>{{ distance }} km</td>
					</tr>
					<tr>
						<td>Delivery Expenses</td>
						<td><abbr title = "Distance Charge">{{ distancecharge | currency }}</abbr> + <abbr title = "Base Delivery Cost">$3.00</abbr></td>
					</tr>
					<tr>
						<td>Food Expenditure</td>
						<td>{{ totalcost | currency }}</td>
					</tr>
					<tr>
						<td>GST (7%)</td>
						<td>{{ foodgst | currency }}</td>
					</tr>
					<tr>
						<td>Service Charge (10%)</td>
						<td>{{ svccharge | currency }}</td>
					</tr>
					<tr>
						<td>Total Expenditure</td>
						<td>{{ totalcost + distancecharge + foodgst + svccharge + 3 | currency }}</td>
					</tr>
				</table>
				<a href = "#" onclick = "return false;" data-ng-click = "order()" class = "btn btn-primary ng-hide" data-ng-show = "canorder()"><span class="glyphicon glyphicon-ok-circle"></span> Place order</a>
				<a class = "btn btn-primary ng-hide" disabled = "disabled" data-ng-hide = "canorder()"><span class="glyphicon glyphicon-ok-circle"></span> Place order</a>
			</div>
		</div>
		!ipp[_cep14_insert components/_footer.html]
	</body>
</html>

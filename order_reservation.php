!ipp[setv pagename Reservation]
<html>
	<head>
		!ipp[_cep14_insert components/_head.html]
		<script src="js/md5.js"></script>
		<script>
			var GST = 0.07;
			var SVC = 0.10;

			pad = function(str, desired, padChar){
				// Pads a string to a desired length with char
				if(padChar === undefined){padChar = "0"};

				if(str.length > desired){
					throw new Error("input string is longer than desired length");
				} else if(str.length == desired){
					return str;
				} else {
					var padded = str;

					for(var i = str.length; i < desired; i++){
						padded = padChar + padded;
					}

					return padded;
				}
			}

			reserver = function($scope){
				// Default values
				$scope.rLocation = "The Abyss";
				$scope.tablesTotal = 42;
				$scope.vacancies = 24;
				$scope.intended = 0;
				$scope.cost = 0;

				$scope.updateCosts = function() {
					if($scope.intended > $scope.vacancies) {
						$scope.intended = 0;
						alert("There are not enough tables!")
					} else {
						$scope.cost = $scope.intended * 6 * (1 + GST) * (1 + SVC);
					}
				}

				$scope.updateLocation = function() {
                    $scope.tablesTotal = Math.round(Math.min(Math.max(parseInt(md5($scope.rLocation), 16) / 5e+35, 15), 150));
                    $scope.vacancies = Math.round($scope.tablesTotal * Math.random());
                    $scope.updateCosts();

                    if($scope.vacancies == 0){
                        $("#vacancy").css("color", "#f30");
                    } else {
                        $("#vacancy").css("color", "#fff");
                    }
                }

				$scope.deduct = function() {
					if(!confirm("Are you sure you want to reserve " + $scope.intended + " tables at " + $scope.rLocation + " for " + $scope.cost + "?")){
						alert("Not reserved.");
						return null;
					}

					var rCode = pad(Date().getTime().toString(16), 16); // Timestamp as Unix time
					rCode += pad($scope.intended.toString(16), 4);
					rCode += $scope.rLocation();
					$scope.codeReserved = md5(rCode);
					// Presumably, a server-side database would be updated here with the hash and the information.
					// A function would also be called to check if the time slot was available.

					alert($filter("currency")($scope.cost) + " has been deducted from your account. Use the reservation code and keep it safe.");
				}
			}
		</script>
	</head>
	<body>
		!ipp[_cep14_insert components/_navbar.html]
		<div class="container-fluid" ng-app="" ng-controller="reserver">
			<h1>Why reserve?</h1>
			<p>Sometimes, it can be difficult for you and your friends or family to find a space just for you at the MekDoornels restaurant.</p>
			<p>Popularity can be both a blessing and a curse.</p>
			<p>However, for you, we have just the right solution - Seat Reservation!</p>
			<p>For just a few dollars, we can find you an available seat and reserve it for you.</p>
			<p>Note: All reservations are limited to 2 hours.</p>
			<hr>

			<h1>Reservation Services</h1>
			<table id="reserve">
				<tr>
					<td>Store Location</td>
					<td><select ng-model="rLocation" ng-change="updateLocation()">
						<option>The Abyss</option>
						<option>Foo Bar</option>
						<option>Bermuda Triangle</option>
						<option>Airstrip One</option>
						<option>Mordor</option>
						<option>USS Enterprise</option>
						<option>Cybertron</option>
						<option>Death Star II</option>
						<option>Hogsmeade</option>
						<option>Ba Sing Se</option>
						<option>Atlantis South</option>
						<option>Mt. Vesuvius</option>
						<option>The Rude Sandstorm</option>
						<option>The Capitol</option>
					</select></td>
				</tr><tr>
					<td>Total Tables</td>
					<td>{{ tablesTotal }}</td>
				</tr><tr>
					<td>Vacancies</td>
					<td><span id="vacancies">{{ vacancies }}</span></td>
				</tr><tr>
					<td>Reserve Tables</td>
					<td><input type="number" ng-model="intended" ng-change="updateCosts()"></td>
				</tr><tr>
					<td>Cost</td>
					<td>{{ cost|currency }}</td>
				</tr>
			</table>
			<p><a class="btn btn-primary" href="#" ng-click="deduct()">Process Deduction</a></p>
			<br>
			<p>Use this reservation code: {{ codeReserved }}</p>
		</div>
		!ipp[_cep14_insert components/_footer.html]
	</body>
</html>

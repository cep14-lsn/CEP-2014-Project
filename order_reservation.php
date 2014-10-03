!ipp[setv pagename Reservation]
<html>
	<head>
		!ipp[_cep14_insert components/_head.html]
		<script src="js/md5.js"></script>
		<script>
			var GST = 0.07;
			var SVCT = 0.10;
			var r_location = "nowhere";

			deduct = function() {return null;};

			reserver = function($scope){
				$scope.tablesTotal = Math.ceil(Math.max(Math.log(parseInt(md5($scope.rLocation), 16)) * 20, 150));
				$scope.vacancies = Math.round($scope.tablesTotal * Math.random());

				if($scope.vacancies == 0){
					$("#vacancy").css("color", "#f30");
				}

				if($scope.intended > $scope.vacancies) {
					$scope.intended = 0;
					alert("There are not enough tables!")
				} else {
					$scope.cost = $scope.intended * 12.5 * (1 + GST) * (1 + SVCT);
				}

				deduct = function() {
					var now = Date();
					alert($scope.cost + " has been deducted from your account.");
					var codeFinal = $scope.tablesTotal.toString(16) + $scope.vacancies.toString(16) + $scope.intended.toString(16);
					$scope.reservation_code = md5(now.toSource() + codeFinal);
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
			<hr>

			<h1>Reservation Services</h1>
			<table id="reserve">
				<tr>
					<td>Store Location</td>
					<td><select ng-model="rLocation">
						<option>Foo Bar</option>
						<option>Bermuda Triangle Branch</option>
						<option>Mordor Branch</option>
						<option>Hogsmeade Branch</option>
						<option>Ba Sing Se</option>
						<option>Atlantis Branch</option>
						<option>Mt. Vesuvius Branch</option>
						<option>The Rude Sandstorm</option>
					</select></td>
				</tr><tr>
					<td>Total Tables</td>
					<td>{{ tablesTotal }}</td>
				</tr><tr>
					<td>Vacancies</td>
					<td><span id="vacancies">{{ vacancies }}</span></td>
				</tr><tr>
					<td>Reserve Tables</td>
					<td><input type="number" ng-model="intended"></td>
				</tr><tr>
					<td>Cost</td>
					<td>{{ cost|currency }}</td>
				</tr>
			</table>
			<p><a class="btn btn-primary" href="#" onclick="deduct()">Process Deduction</a></p>
			<br>
			<p>Use this reservation code: {{ reservation_code }}</p>
		</div>
		!ipp[_cep14_insert components/_footer.html]
	</body>
</html>

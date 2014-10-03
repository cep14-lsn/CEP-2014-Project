!ipp[setv pagename Reservation]
<html>
	<head>
		!ipp[_cep14_insert components/_head.html]
		<script src="js/md5.js"></script>
	</head>
	<body>
		!ipp[_cep14_insert components/_navbar.html]
		<div class="container-fluid" ng-app="svcReserve" ng-controller="reserver">
			<h1>Why reserve?</h1>
			<p>Sometimes, it can be difficult for you and your friends or family to find a space just for you at the MekDoornels restaurant.</p>
			<p>Popularity can be both a blessing and a curse.</p>
			<p>However, for you, we have just the right solution - Seat Reservation!</p>
			<p>For just a few dollars, we can find you an available seat and reserve it for you.</p>
			<hr>

			<h1>Reservation Services</h1>
			<p>Store Location: <select ng-model="location">
				<option>Foo Bar</option>
				<option>Bermuda Triangle Branch</option>
				<option>Mordor Branch</option>
				<option>Hogsmeade Branch</option>
				<option>Ba Sing Se</option>
				<option>Atlantis Branch</option>
				<option>Mt. Vesuvius Branch</option>
				<option>The Rude Sandstorm</option>
			</select></p>
			<p>Total Tables: {{ tablesTotal }}</p>
			<p>Vacancies: <span id="vacancies">{{ vacancies }}</span></p>
			<p>Reserve Tables: <input type="number" ng-model="intended"></p>
			<p>Cost: {{ cost|currency }}</p>
			<p><a class="btn btn-primary" href="#" onclick="deduct()">Process Deduction</a></p>
			<br>
			<p>Use this reservation code: {{ reservation_code }}</p>
		</div>
		<script>
			var GST = 0.07;
			var SVCT = 0.10;

			deduct = function() {return null;};

			reserver = function($scope){
				$scope.tablesTotal = Math.ceil(Math.max(Math.log(parseInt(md5(location), 16)) * 20, 150));
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
		!ipp[_cep14_insert components/_footer.html]
	</body>
</html>

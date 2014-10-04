!ipp[setv pagename Reservation]
<html>
	<head>
		!ipp[_cep14_insert components/_head.html]
		<script src="js/hash.js"></script>
		<script>
			var BASE_COST = 6;
			var ADDITIONAL_CHARGE = 10;
			var GST = 0.07;
			var SVC = 0.10;
			
			function pad( str , dl , c ) {
				if ( dl <= str.length ) {
					return str.substring( 0 , dl );
				} else {
					while ( str.length < dl ) str = ( c ? c : "0" ) + str;
					return str;
				}
			}
			function tellUser( s ) {
				alert( s );
			}
			function resvCont( $scope ) {
				$scope.changeLocation = function () {
					if ( !$scope.locInfo[ $scope.loc ] ) {
						var tables = Math.min( Math.max( hashdigest( hash( $scope.loc ) ) , 15 ) , 150 ) , vacancies = Math.round( tables * Math.random() );
						$scope.locInfo[ $scope.loc ] = {
							"tables" : tables,
							"vacancies" : vacancies,
							"cost" : ( BASE_COST + ( 1 - vacancies / tables ) * ADDITIONAL_CHARGE ) * ( 1 + GST ) * ( 1 + SVC ),
						}
					}
				}
				$scope.refreshCost = function () {
					var li = $scope.locInfo[ $scope.loc ]
					li.cost = ( BASE_COST + ( 1 - li.vacancies / li.tables ) * ADDITIONAL_CHARGE ) * ( 1 + GST ) * ( 1 + SVC );
				}
				$scope.reserve = function () {
					if ( ! confirm("Do you want to reserve " + $scope.ir + " tables at " + $scope.loc + "?" ) ) {
						tellUser("Reservation cancelled.");
						return;
					}
					var rcode = pad( Date().getTime().toString(16) , 16 );
					rcode += pad( $scope.ir.toString( 16 ) , 4 );
					rcode += $scope.loc;
					tellUser( $filter("currency")($scope.locInfo[$scope.loc].cost) + " has been deducted from your account. Keep the reservation code and show it when entering." )
					$scope.rcode = btoa( rcode );
					$scope.vacancies -= $scope.ir;
					$scope.ir = 0;
					$scope.refreshCost();
				}
				$scope.locInfo = {};
				$scope.loc = "The Abyss";
				$scope.changeLocation();
			}
		</script>
	</head>
	<body>
		!ipp[_cep14_insert components/_navbar.html]
		<div class="container-fluid" ng-app="" ng-controller="resvCont">
			<div class = "page-header">
				<h1>Reservation Services <small>for your convenience of getting a seat</small></h1>
			</div>
			<table class = "table">
				<tr>
					<td>Select Location</td>
					<td>
						<select ng-model = "loc" ng-change = "changeLocation()">
							<option>The Abyss</option>
							<option>Foo Bar</option>
							<option>Mausoleum at Halicarnassus</option>
							<option>Hanging Gardens of Babylon</option>
							<option>Temple of Artemis at Epheus</option>
							<option>Colossus of Rhodes</option>
							<option>Statue of Zeus at Olympia</option>
							<option>Lighthouse of Alexandra</option>
							<option>Minotaur Labyrinth</option>
							<option>Bermuda Triangle</option>
							<option>Sagittarius A*</option>
							<option>Luskan</option>
							<option>In the Mariana Trench</option>
							<option>The Nautilius</option>
							<option>Proxima Centauri</option>
							<option>Diagon Alley</option>
							<option>Lumiose City</option>
							<option>The Matrix</option>
							<option>Airstrip One</option>
							<option>Mordor</option>
							<option>USS Enterprise</option>
							<option>Cybertron</option>
							<option>Death Star II</option>
							<option>Ba Sing Se Middle Ring</option>
							<option>Atlantis South</option>
							<option>Mt. Vesuvius</option>
							<option>The Rude Sandstorm</option>
							<option>The Capitol</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Total number of tables</td>
					<td>{{ locInfo[loc].tables }}</td>
				</tr>
				<tr>
					<td>Vacancies</td>
					<td>{{ locInfo[loc].vacancies }}</td>
				</tr>
				<tr>
					<td>Reserve tables</td>
					<td>
						<input type = "number" class = "form-control" ng-model = "ir" ng-class = "{{ ir <= locInfo[loc].vacancies ? 'bg-success' : 'bg-warning' }}" />
						<span class = "input-group-addon" ng-show = "ir > locInfo[loc].vacancies"><span class = "glyphicon glyphicon-warning-sign"></span></span>
					</td>
				</tr>
				<tr>
					<td>Total Cost</td>
					<td>{{ locInfo[loc].cost * ir | currency }}</td>
				</tr>
			</table>
			<a class="btn btn-primary" href="#" ng-click="deduct()" ng-hide = "rcode">Process Deduction</a>
			<p ng-show = "rcode">Use this reservation code: {{ rcode }}</p>
		</div>
		!ipp[_cep14_insert components/_footer.html]
	</body>
</html>

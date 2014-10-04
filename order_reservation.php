!ipp[setv pagename Reservation]
<html>
	<head>
		!ipp[_cep14_insert components/_head.html]
		<style>
			input.form-control.ng-invalid {
				background-color : #d77;
			}
		</style>
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
			function resvCont( $scope , $filter ) {
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
					if ( $scope.ir <= 0 ) {
						tellUser("Invalid reservation");
						return;
					}
					if ( $scope.ir > $scope.locInfo[ $scope.loc ].vacancies ) {
						tellUser("Unable to reserve more tables than vacancies.");
						return;
					}
					if ( !confirm("Do you want to reserve " + $scope.ir + " tables at " + $scope.loc + "?" ) ) {
						tellUser("Reservation cancelled.");
						return;
					}
					var rcode = "MekDoornels Reservation :: ";
					rcode += pad( new Date().getTime().toString(16) , 16 ) + " :: ";
					rcode += pad( $scope.ir.toString( 16 ) , 4 ) + " :: ";
					rcode += $scope.loc;
					tellUser( $filter("currency")($scope.locInfo[$scope.loc].cost * $scope.ir) + " has been deducted from your account. Keep the reservation code and show it when entering." );
					reservation = {};
					reservation.rcode = btoa( rcode );
					reservation.text = "Reservation for " + $scope.ir + " tables at " + $scope.loc;
					$scope.locInfo[ $scope.loc ].vacancies -= $scope.ir;
					$scope.ir = 0;
					$scope.refreshCost();
					$scope.reservations.push( reservation );
				}
				$scope.locInfo = {};
				$scope.loc = "The Abyss";
				$scope.ir = 0;
				$scope.reservations = [];
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
						<select ng-model = "loc" ng-change = "changeLocation()" class = "form-control">
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
						<input type = "number" ng-model = "ir" class = "{{ 'form-control' + ( ir <= locInfo[loc].vacancies && ir > 0 ? '' : ' ng-invalid' ) }}" />
					</td>
				</tr>
				<tr>
					<td>Total Cost</td>
					<td>{{ locInfo[loc].cost * ir | currency }}</td>
				</tr>
			</table>
			<a class="btn btn-primary" href="#" ng-click="reserve()">Process Deduction</a>
			<div class = "panel panel-primary" ng-show = "reservations.length > 0">
				<div class = "panel-heading">
					Reservation
				</div>
				<div class = "panel-body">
					<div ng-repeat = "reservation in reservations">
						<p>{{ reservation.text }}</p>
						<p class = "well">{{ reservation.rcode }}</p>
					</div>
				</div>
			</div>
		</div>
		!ipp[_cep14_insert components/_footer.html]
	</body>
</html>

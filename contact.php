!ipp[setv pagename Contact]
<html>
	<head>
		!ipp[_cep14_insert components/_head.html]
		<script>
		function clCont( $scope ) {
			$scope.contactList = [
				{
					"name":"Carl",
					"email":"carl@me.com",
					"profile-pic":"https://dl.dropboxusercontent.com/u/547441/minion/carl.jpg",
					"contact":{
						"home":1234567,
						"mobile":7654322
					}
				},
				{
					"name":"Dave",
					"email":"dave@me.com",
					"profile-pic":"https://dl.dropboxusercontent.com/u/547441/minion/dave.jpg",
					"contact":{
						"home":3344422,
						"mobile":3232323
					}
				},
				{
					"name":"Jerry",
					"email":"jerry@me.com",
					"profile-pic":"https://dl.dropboxusercontent.com/u/547441/minion/jerry.jpg",
					"contact":{
						"home":5555555,
						"mobile":4433221
					}
				},
				{
					"name":"Kevin",
					"email":"kevin@me.com",
					"profile-pic":"https://dl.dropboxusercontent.com/u/547441/minion/kevin.jpg",
					"contact":{
						"home":5453433,
						"mobile":1111111
					}
				},
				{
					"name":"Phil",
					"email":"phil@me.com",
					"profile-pic":"https://dl.dropboxusercontent.com/u/547441/minion/phil.jpg",
					"contact":{
						"home":4545455,
						"mobile":333322
					}
				},
				{
					"name":"Stuart",
					"email":"stuart@me.com",
					"profile-pic":"https://dl.dropboxusercontent.com/u/547441/minion/stuart.jpg",
					"contact":{
						"home":5656564,
						"mobile":8765443
					}
				},
				{
					"name":"Tim",
					"email":"tim@me.com",
					"profile-pic":"https://dl.dropboxusercontent.com/u/547441/minion/tim.jpg",
					"contact":{
						"home":8888776,
						"mobile":9999008
					}
				},
				{
					"name":"Tom",
					"email":"tom@me.com",
					"profile-pic":"https://dl.dropboxusercontent.com/u/547441/minion/tom.jpg",
					"contact":{
						"home":1234111,
						"mobile":7654222
					}
				}
			];
		}
		</script>
		<style>
			.contact {
				padding : 5px;
				margin : 5px;
				width : 100%;
				background-color : #222;
				border-radius : 10px;
			}
			.contact > .contact-pic {
				text-align : center;
				margin-left : auto;
				margin-right : auto;
			}
			.contact > .contact-info {
				text-align : justify;
			}
			@media ( max-width : 767px ) {
				.contact > .contact-info {
					text-align : center;
				}
			}
		</style>
	</head>
	<body>
		!ipp[_cep14_insert components/_navbar.html]
		<div class = "page-header">
			<h1>Contacts <small>should you have any enquiries or complaints</small></h1>
		</div>
		<div class = "container" ng-app = "" ng-controller = "clCont">
			<div class = "row contact" ng-repeat = "p in contactList">
				<div class = "col-xs-12 col-sm-2 contact-pic">
					<img ng-src = "{{ p['profile-pic'] }}" alt = "Profile Picture" class = "img-circle" />
				</div>
				<div class = "col-xs-12 col-sm-9 contact-info">
					<strong>{{ p.name }}</strong>
					<a class = "text-muted" ng-href = "mailto:{{ p.email }}"><i>{{ p.email }}</i></a>
					<p>H {{ p.contact.home }} / M {{ p.contact.mobile}}</p>
				</div>
			</div>
		</div>
		!ipp[_cep14_insert components/_footer.html]
	</body>
</html>

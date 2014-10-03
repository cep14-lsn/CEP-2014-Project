!ipp[setv pagename Menu]
<html>
	<head>
		!ipp[_cep14_insert components/_head.html]
		<style>
		.food-item {
			text-align : center;
			background-color : #222;
			border-radius : 10px;
			padding : 10px;
		}
		.food-item > img {
			height : 200px;
			width : auto;
			margin-left : auto;
			margin-right : auto;
		}
		.food-item > .food-desc {
			display : none;
			width : 100%;
			background-color : #444;
			border-radius : 10px;
			text-align : justify;
			padding : 10px;
		}
		.food-item:hover > .food-desc {
			display : block;
		}
		</style>
	</head>
	<body>
		<!--<div class = "menu-desc">
			<h1 style = "font-size:20pt"> A wide and delectable selection of fine foods!</h1>
			<h2 style = "font-size:8pt"> P.S. If any food item starts a conversation with you, please incinerate it.</h2>-->
		!ipp[_cep14_insert components/_navbar.html]


		<div data-ng-app="list-menu" class="container-fluid">
		    <h1>Set meals</h1>
		    <p>These are meals to have anywhere. You can either purchase it &agrave; la carte or as a full meal.</p>
		    <div data-ng-controller="listMealSet">
		        <div data-ng-repeat="mealSet in infoFood">
		            <h2>{{mealSet.name}}</h2>
		            <img data-ng-src="{{mealSet.img}}">
		            <p>{{mealSet.finalDesc}}</p>
		            <table>
		                <tr>
		                    <th>Substance</th>
		                    <th>Amount</th>
		                </tr>
		                <tr>
		                    <td>Energy</td>
		                    <td>{{mealSet.nutrition.calorie}} calories</td>
		                </tr>
		                <tr>
		                    <td>Carbohydrates</td>
		                    <td>{{mealSet.nutrition.carbohydrate / 5}} g</td>
		                </tr>
		                <tr>
		                    <td>Fats</td>
		                    <td>{{mealSet.nutrition.fats}} mg</td>
		                </tr>
		                <tr>
		                    <td>Proteins</td>
		                    <td>{{mealSet.nutrition.protein / 5}} g</td>
		                </tr>
		                <tr>
		                    <td>Sodium</td>
		                    <td>{{mealSet.nutrition.salt}} mg</td>
		                </tr>
		            </table>

		        </div>
		    </div>
		</div>
		<script src="js/menu.js"></script>
		!ipp[_cep14_insert components/_footer.html]
	</body>
</html>

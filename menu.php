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
	<script>
		var infoFood = {
    "mealSet": [
        {
            "name": "Burger Combo",
            "img": "burgercombo.gif",
            "nutrition": {
                "calorie": 100,
                "carbohydrate": 170,
                "fats": 20,
                "protein": 800,
                "salt": 10
            },
            "desc": [
                "For more conservative customers, we have our traditional Burger Combo meal.",
                "You can order an upgraded version for $1.00 more with 20% less fat."
            ],
            "lore": [
                "'My kingdom for a burger!'",
                "~ Rich Ard IV"
            ],
            "stock": 200,
            "cost": {
                "a la carte": 3,
                "meal": 4
            }
        },
        {
            "name": "MultiBurger (TM)",
            "img": "Tripleburger.png",
            "nutrition": {
                "calorie": 80,
                "carbohydrate": 135,
                "fats": 2,
                "protein": 500,
                "salt": 6
            },
            "desc": [
                "Order your very own customized MultiBurger (TM) today. Each layer consists of a succulent beef steak with fresh cheddar cheese, with lettuce and tomato at the top.",
                "NOTE: Nutrition values and cost values above are given per layer of burger. Add $1, 20 calories, 5 g of carbohydrate for the lettuce and tomato.",
                "Only available a la carte."
            ],
            "lore": [
                "'We are many, we are one.'",
                "~ Rescue Heroes: The Movie"
            ],
            "stock": 500,
            "cost": {
                "layer": 1.50,
                "base": 1
            }
        },
        {
            "name": "PizzaCake"
            "img": "pizza_cake.jpg",
            "nutrition": {
                "calorie": 135,
                "carbohydrate": 250,
                "fats": 20,
                "protein": 750,
                "salt": 10
            },
            "desc": [
                "Fusing two traditional favorites - the pizza and the cake, we get the PizzaCake!",
                "It is a wonderful meal that you can spend as long as you like eating.",
                "Studies have also shown it reduces waistlines by 5 cm (provided you are obese)."
            ],
            "lore": [
                "'PizzaCake Delivery, 6-222-6-111!' (Disclaimer: not a valid phone number)",
                "~ Anonymous"
            ]
        }
    ],
    "mealSide": [
        {
            "name": "Mega Fries",
            "img": "megafries.png",
            "nutrition": {
                "calorie": 40,
                "carbohydrate": 90,
                "fats": 1,
                "protein": 2,
                "salt": 12
            },
            "desc": [
                "Mmm... tasty, mouthwatering fries. Made from freshly harvested potatoes and oceanic salt only."
            ],
            "lore": [
                "'I believe you speak French?' ~ Host",
                "'Yes, french fries and french toast!' ~ Maury"
            ],
            "stock": 1337,
            "cost": {
                "side": 1.20
            }
        },
        {
            "name": "Fresh Lemon Fruit",
            "img": "combustible_lemon.png",
            "nutrition": {
                "calorie": 1000,
                "carbohydrate": 30,
                "fats": 0,
                "protein": 5,
                "salt": 4
            },
            "desc": [
                "What could be more enjoyable on a hot summer day other than fresh fruit?",
                "Don't get sour though, there is plenty for everyone!",
                "NOTE: Ignore the label on the side and the wiring at the ends, it is merely decoration that is edible."
            ],
            "lore": [
                "'When life gives you lemons, don't make lemonade. Make life take the lemons back!",
                "Get mad! I don't want your damn lemons, what the hell am I supposed to do with them?",
                "Demand to see life's manager! Make life rue the day it thought it could give Cave Johnson lemons!",
                "Do you know who I am? I'm the man who's gonna burn your house down. With the lemons!",
                "I'm gonna get my engineers to invent a combustible lemon that burns your house down!'",
                "~ Cave Johnson"
            ],
            "stock": 200,
            "cost": {
                "side": 4.00
            }
        }
    ],
    "drinks": [
        {
            "name": "Purple Drank",
            "img": "purple_drank.jpg",
            "nutrition": {
                "calorie": 20,
                "carbohydrate": 32,
                "fats": 0,
                "protein": 5,
                "salt": 2
            },
            "desc": [
                "Purple Drank [sic] is a inspirational and thought-provoking drink.",
                "A must-drink before any important events such as national examinations and career interviews.",
                "It also cures any acute coughing problems."
            ],
            "lore": [
                "'Roses are red, / Violets are blue. / Purple drank is purple, / Wait, violets aren't blue.'",
                "~ Gammer Gurton's Garland"
            ],
            "stock": 9001,
            "cost": {
                "side": 1.20
            }
        },
        {
            "name": "Moonshine",
            "img": "moonshine.jpg",
            "nutrition": {
                "calorie": 15,
                "carbohydrate": 25,
                "fats": 0,
                "protein": 8,
                "salt": 0
            },
            "desc": [
                "Tapped from our lunar industries, we bring you the freshest moonshine of Planet Earth.",
                "Moonshine is an enjoyable drink that provides infinite entertainment when consumed with friends",
                "You can purchase our Mid-Autumn Festival special edition too! (Whilst Stocks Last)"
            ],
            "stock": 2014,
            "cost": {
                "side": 2.00
            }
        }
    ]
};
		var xh = new XMLHttpRequest();
		xh.onreadystatechange = function () {
			if ( xh.readyState == 4 && xh.status == 200 ) {
				console.log( xh.responseText );
				infoFood = JSON.parse( xh.responseText );
			}
		}
		xh.open( "GET" , "js/food_info.json" , true );
		xh.send();
		function menuCont( $scope ) {
			$scope.foods = infoFood;
			$scope.process = function ( l ) {
				return l.join("<br>");
			}
		}
	</script>
	<body>
		<!--<div class = "menu-desc">
			<h1 style = "font-size:20pt"> A wide and delectable selection of fine foods!</h1>
			<h2 style = "font-size:8pt"> P.S. If any food item starts a conversation with you, please incinerate it.</h2>-->
		!ipp[_cep14_insert components/_navbar.html]
		<div ng-app = "" ng-controller = "menuCont" class="container-fluid">
			<div class = "container">
				<div class = "page-header">
					<h1>Set meals <small>to be had anywhere; à la carte or as a set meal</small></h1>
				</div>
				<div ng-repeat = "mealset in foods.mealSet">
					<div class = "row">
						<div class = "col-xs-12 col-md-6 meal-pic">
							<img ng-src = "{{mealset.img}}" alt = "Meal image" />
						</div>
						<div class = "col-xs-12 col-md-6 meal-info">
							<strong>{{ set.name }}</strong>
							<p class = "text-muted"><i>{{ process( mealset.desc ) }}</i></p>
							<table>
								<tr>
									<th>Nutritional Information</th>
								</tr>
								<tr>
									<td>Energy</td>
									<td>{{ mealset.nutrition.calorie }} kcal</td>
								</tr>
								<tr>
									<td></td>
									<td>{{ mealset.nutrition.calorie * 4.2 }} kJ</td>
								<tr>
									<td>Carbohydrates</td>
									<td>{{ mealset.nutrition.carbohydrate / 5 }} g</td>
								</tr>
								<tr>
									<td>Fats</td>
									<td>{{ mealset.nutrition.fats }} mg</td>
								</tr>
								<tr>
									<td>Protein</td>
									<td>{{ mealset.nutrition.protein / 5 }} g</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		!ipp[_cep14_insert components/_footer.html]
	</body>
</html>

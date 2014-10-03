infoFood = jQuery.getJSON(($.getJSON("js/food_info.json", function(data) {return data})));

listMealSet = function($scope){
    $scope.infoFood = infoFood.mealSet;
    $scope.infoFood.finalDesc = $scope.infoFood.desc.join("<br>");
};
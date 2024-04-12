// references to the elements
var searchBtn = document.getElementById('search-btn');
var mealList = document.getElementById('meal');
var mealDetailsContent = document.querySelector('.meal-details-content');
var recipeCloseBtn = document.getElementById('recipe-close-btn');
var searchInput = document.getElementById('search-input'); 


// Function to perform search
function performSearch() {
    var searchInputTxt = searchInput.value.trim(); 
    getMealList(searchInputTxt); 
}


searchBtn.addEventListener('click', performSearch);


mealList.addEventListener('click', function(event) {
    getMealRecipe(event);
});


recipeCloseBtn.addEventListener('click', function() {
    mealDetailsContent.parentElement.classList.remove('showRecipe');
});


searchInput.addEventListener('keypress', function(event) {

    if (event.key === 'Enter') {
        performSearch(); 
    }
});


// Function to get meal list that matches with the ingredients
function getMealList(searchInputTxt) {
    fetch('https://www.themealdb.com/api/json/v1/1/filter.php?i=' + searchInputTxt)
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        var html = "";
        if (data.meals) {
            data.meals.forEach(function(meal) {
                html += '<div class="meal-item" data-id="' + meal.idMeal + '">'
                    + '<div class="meal-img">'
                    + '<img src="' + meal.strMealThumb + '" alt="food">'
                    + '</div>'
                    + '<div class="meal-name">'
                    + '<h3>' + meal.strMeal + '</h3>'
                    + '<a href="#" class="recipe-btn"> Recipe</a>'
                    + '</div>'
                    + '</div>';
            });
            mealList.classList.remove('notFound');
        } else {
            html = "We currently dont have any meals with that ingredient. Come back later! ";
            mealList.classList.add('notFound');
        }
        mealList.innerHTML = html;
    });
}



// Function to get recipe of the meal
function getMealRecipe(event) {
    event.preventDefault();
    if (event.target.classList.contains('recipe-btn')) {
        var mealItem = event.target.parentElement.parentElement;
        fetch('https://www.themealdb.com/api/json/v1/1/lookup.php?i=' + mealItem.dataset.id)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            mealRecipeModal(data.meals);
        });
    }
}


// Function to create a modal
function mealRecipeModal(meal) {
    console.log(meal);
    meal = meal[0];
    var instructions = meal.strInstructions.split('\n');
    var html = '<h2 class="recipe-title">' + meal.strMeal + '</h2>'
        + '<div class="recipe-instruct">'
        + '<h3 class="instruction-heading">Instructions:</h3>';

    for (var i = 0; i < instructions.length; i++) {
        html += '<p class="instruction-text">' + instructions[i] + '</p>';
    }

    html += '</div>'
        + '<div class="recipe-meal-img">'
        + '<img src="' + meal.strMealThumb + '" alt="">'
        + '</div>'
        + '<div class="recipe-link">'
        + '<a href="' + meal.strYoutube + '" target="_blank">Watch video tutorial</a>'
        + '</div>';
    mealDetailsContent.innerHTML = html;
    mealDetailsContent.parentElement.classList.add('showRecipe');
}

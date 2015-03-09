var activeMovie = [];		// the entire object of the actvie movie
var movieObjects = [];  	// all movie objects currently listed in the search lives here
var searchItems = [];  		// contains imdbID's that is used to make sure 1 title can't be shown several times in the search list.


function postSearchFromInput(search) {   // post request, search multiple movies titles.

	$('.spinner').show();
	
	$.post('search', {search: search}, function(data) {
		
		$('.spinner').hide();
		$('.search-li').remove();
		var movies = $.parseJSON(data);
		var movieTitles = movies;
					
		for (var i = 0; i < 5; i++) { // amount of search results

			postTitles(movieTitles, i);
						
		}	
	});
}

function postTitles(obj, counter) { // post request, search by title

	if ( (obj.status === "success") ) {
		$('.spinner').show();
		$.post('search-title', {title: obj.data.names[counter].name }, function(data) {
			
			$('.spinner').hide();
			var dataResponse = $.parseJSON(data);
			var movie = dataResponse;
			
			if (  ( movie.Response !== "False" ) && ( movie.Poster != "N/A" ) && ( searchItems.indexOf(movie.imdbID) == -1 ) && 
				( movie.Title != "N/A" ) && ( movie.Type != "game" ) && ( movie.imdbRating != "N/A" ) ) {
					searchItems.push(movie.imdbID);
					movieObjects.push(movie);
					createSearchResultsView(movie);
									
			}
		});
	}	
}

function createSearchResultsView(movie) {  // insert list elements with movie content
	$('.search-result').append('<li id="' + movie.imdbID + '" class="search-li">' +
											'<p class="rating">' + movie.imdbRating + '</p>' +
											'<div class="poster">' +
												'<img src="' + movie.Poster + '">' +
											'</div>' +
											'<p class="movie-title">' + movie.Title + '</p>' + 
										'</li>'
	);
}

function createMovieSpecView(movie) {
	$('.movie-spec').empty();
	$('.movie-spec').append('<h2>' + movie.Title + '</h2>' +
									'<p><span>' + movie.Genre + '</span></p>' +
									'<div class="info-section">' +		
										'<img src="' + movie.Poster + '">' +
										'<ul>' +
											'<li class="save-movie"><span>Save to My movies</span></li>' +
											'<li>Rating: <span>' + movie.imdbRating + '</span></li>' +
											'<li>Runtime: <span>' + movie.Runtime + '</span></li>' +
											'<li>Year: <span>' + movie.Year + '</span></li>' +
										'</ul>' +
									'</div>' +
									'<p class="plot">' + movie.Plot + '</p>'	
		);
}

/* ===================================== */


$(document).ready(function() {  // Document ready



	/* == search movie related == */
	
	var delayedTimer;
	
	$('#search').on('keyup', function(event) {  // on keyup, search api for match
		
		clearTimeout(delayedTimer);
		
		movieObjects = [];
		searchItems = [];

		delayedTimer = setTimeout(function() {
			
			var movieTitle = $('#search').val();

			if ( movieTitle === "" ) {
				$('.search-li').hide();
			}else {
				
				postSearchFromInput(movieTitle);
			}
		}, 400);
	});

	$('.search-result').on('click', '.search-li', function() { // show movie spec on the clicked movie
		activeMovie = [];
		for (var i = 0; i < movieObjects.length; i++) {
			if (this.id === movieObjects[i].imdbID) {
				activeMovie.push(movieObjects[i]);
				$('.movie-spec').show();
				createMovieSpecView(movieObjects[i]);

			}
		}
	});

	$('.movie-spec').on('click', '.save-movie', function() {
		$.post('movies', {movie: activeMovie}, function(data) {
			console.log(data);
		});
	});

	$('#search').focusout(function() {
		setTimeout(function() {
			$('.spinner').hide();
			$('.search-li').hide();
		}, 200);
			
	});
	
	$('#search').focus(function() {
		$('.search-li').show();
	});

 	/* == search movie END == */
	

});
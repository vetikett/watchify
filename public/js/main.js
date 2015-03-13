var activeMovie = [];		// the entire object of the actvie movie
var movieObjects = [];  	// all movie objects currently listed in the search lives here
var searchItems = [];  		// contains idIMDB's that is used to make sure 1 title can't be shown several times in the search list.


function postSearchFromInput(search) {   // post request, search multiple movies titles.

	$('.spinner').show();
	
	$.post('search', {search: search}, function(data) {
		$('.spinner').hide();
		$('.search-li').remove();

        var movies = data;

        var counter = 0;
        movies.forEach(function() {
            handleMovie(movies, counter);
            counter += 1;
        }); // amount of search results

	});
}

function handleMovie(movie, counter) {
    if (    ( movie[counter].urlPoster != "" )  &&
            ( movie[counter].urlPoster != "http://image.tmdb.org/t/p/w396" ) &&
            ( ! movie[counter].urlPoster.match(/media-imdb/gi) ) &&
            ( searchItems.indexOf(movie[counter].idIMDB) == -1 ) &&
            ( movie[counter].rating != "" )
    ) {

        searchItems.push(movie[counter].idIMDB);
        movieObjects.push(movie[counter]);

        createSearchResultsView(movie[counter]);

    }
}

function createSearchResultsView(movie) {  // insert list elements with movie content
	$('.search-result').append('<li id="' + movie.idIMDB + '" class="search-li">' +
											'<p class="rating">' + movie.rating + '</p>' +
											'<div class="poster">' +
												'<img src="' + movie.urlPoster + '">' +
											'</div>' +
											'<p class="movie-title">' + movie.title + '</p>' +
										'</li>'
	);
}

function createMovieSpecView(movie) {
	$('.movie-spec').empty();
	$('.movie-spec').append('<h2>' + movie.title + '</h2>' +
									'<p><span>' + movie.genres[0] + '</span></p>' +
									'<div class="info-section">' +		
										'<img src="' + movie.urlPoster + '">' +
										'<ul>' +
											'<li class="save-movie"><span>Save to My movies</span></li>' +
											'<li>Rating: <span>' + movie.rating + '</span></li>' +
											'<li>Runtime: <span>' + movie.runtime[0] + '</span></li>' +
											'<li>Year: <span>' + movie.year + '</span></li>' +
										'</ul>' +
									'</div>' +
									'<p class="plot">' + movie.simplePlot + '</p>'
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
				if (( event.keyCode != 37 ) &&
                    ( event.keyCode != 38 ) &&
                    ( event.keyCode != 39 ) &&
                    ( event.keyCode != 40 )
                ) {
                    postSearchFromInput(movieTitle);
                }
			}
		}, 800);
	});

	$('.search-result').on('click', '.search-li', function() { // show movie spec on the clicked movie
		activeMovie = [];
		for (var i = 0; i < movieObjects.length; i++) {
			if (this.id === movieObjects[i].idIMDB) {
				activeMovie.push(movieObjects[i]);
				$('.movie-spec').show();
				createMovieSpecView(movieObjects[i]);

			}
		}
	});

	$('.movie-spec').on('click', '.save-movie', function() {
		$.post('movies', {movie: activeMovie}, function(data) {
			$('.main')
                .prepend('<p class="movie-added-flash alert alert-success">Movie added!</p>');
            $('.movie-added-flash').delay(2000).slideUp();
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

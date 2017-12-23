$('document').ready(function() {
  $('#resultsrow').addClass('hidden');
  $( "#autocomplete" ).click(function ( e, data ) {
    $('#resultsrow').load(document.URL +  ' #resultsrow');
    $('#resultsrow').removeClass('hidden');
    $term = $('#searchtext').val();
    $.post("includes/searchmovie.php","term="+$term, function(data, textStatus) {
    var directive = {
      '.moviethumb': {
        'movie<-results': {
          '.poster@src': function(movie) {
            if(movie.item.poster_path == null) {
              return 'images/no_poster.jpg'
            }
            else {
              return 'http://image.tmdb.org/t/p/w500' + movie.item.poster_path
            }},
          '.title': 'movie.title',
          '.date': 'movie.release_date',
          '.btn1@href': function(movie) {
            return 'includes/addmovie.php?list=user&tmdbid=' + movie.item.id
          },
          '.btn2@href': function(movie) {
            return 'includes/addmovie.php?list=watch&tmdbid=' + movie.item.id
          }
        }
      }
    };
    $p('#resultsrow').render(data, directive);
  }, "json")
})
})

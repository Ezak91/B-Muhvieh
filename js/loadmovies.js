function loadMovies(userid,list) {
    $('#movierow').load(document.URL +  ' #movierow');

    $.post("includes/loadmovie.php","userid="+userid+"&list="+list, function(data, textStatus) {
    var directive = {
      '.moviethumb': {
        'movie<-': {
          '.movielink@href': function(movie) {
            return 'index.php?inc=movieinfo.php&tmdbid=' + movie.item.tmdb_id
          },
          '.poster@src': function(movie) {
            if(movie.item.poster_path == null) {
              return 'images/no_poster.jpg'
            }
            else {
              return 'images/cover' + movie.item.poster_path
            }},
          '.title': 'movie.title',
          '.date': 'movie.release_date',
          '.btn1@href': function(movie) {
            return 'includes/addmovie.php?list=watch&tmdbid=' + movie.item.tmdb_id
          },
          '.btn1+': function(movie) {
            if(list == 'watch') {
              return 'Unwatch'
            }
            return ' Add to watchlist'
          },
          '#icon1@class+': function(movie) {
            return ' glyphicon-eye-open'
          },
          '.btn2@href': function(movie) {
            return 'includes/removemovie.php?tmdbid=' + movie.item.tmdb_id + "&list=user"
          },
          '.btn2@class+': function(movie) {
            if(list == 'watch') {
              return ' hidden '
            }
            return '';
          },
          '#icon2@class+': function(movie) {
            return ' glyphicon-trash'
          }
        }
      }
    };
    $p('#movierow').render(data, directive);
  }, "json")
}

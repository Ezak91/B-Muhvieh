function loadMovieInfo(tmdbid) {
    $('#inforow').load(document.URL +  ' #inforow');
    $.post("includes/loadmovieInfo.php","tmdbid="+tmdbid, function(data, textStatus) {
    var directive = {
      '.jumbotron': {
        'movie<-': {
          '.img@style+': function(movie) {
            return "background: #000 top center no-repeat url(images/backdrop"+ movie.item.backdrop_path +");"
          },
          '.media-object@src': function(movie) {
            return "images/cover"+movie.item.poster_path
          },
          '.media-heading': function(movie) {
            return "<b>"+movie.item.title+"</b> (" + parseInt(movie.item.release_date) + ")"
          },
        '.c100@class+': function(movie) {
          return "p"+movie.item.vote_average*10
        },
        '#percent': function(movie) {
          return  movie.item.vote_average*10 + "%"
        },
        '#movie_desc': function(movie) {
          return  movie.item.overview
        }
        }
      }
    };
    $p('#inforow').render(data, directive);
  }, "json")
}

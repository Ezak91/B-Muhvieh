function loadMovieInfo(tmdbid) {
    $.post("includes/loadmovieInfo.php","tmdbid="+tmdbid+"&action=movie", function(data, textStatus) {
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
        '.runtime+': function(movie) {
          return  " " + movie.item.runtime + " min."
        },
        '.date+': function(movie) {
          return  " " + movie.item.release_date
        },
        '.original_title+': function(movie) {
          return  " " + movie.item.original_title
        },
        '.original_language+': function(movie) {
          return  " " + movie.item.original_language
        },
        '.budget+': function(movie) {
          return  " " + movie.item.budget + " $"
        },
        '.revenue+': function(movie) {
          return  " " + movie.item.revenue + " $"
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

function loadActorInfo(tmdbid) {
    $.post("includes/loadmovieInfo.php","tmdbid="+tmdbid+"&action=actor", function(data, textStatus) {
    var directive = {
      '.actorhumb': {
        'movie<-': {
          '.poster@src': function(movie) {
            return "https://image.tmdb.org/t/p/w640"+ movie.item.profile_path
          },
          '.actorlink@href': function(movie) {
            return "https://www.themoviedb.org/person/"+movie.item.id
          },
          '.name': function(movie) {
            return movie.item.name
          },
          '.character': function(movie) {
            return movie.item.character
          }
        }
      }
    };
    $p('#actorrow').render(data, directive);
  }, "json")
}

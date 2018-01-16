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
        '#percent@title': function(movie) {
          return  movie.item.vote_count + " Votes"
        },
        '#homepage@href': function(movie) {
          return  movie.item.homepage
        },
        '#tmdb@href': function(movie) {
          return "https://www.themoviedb.org/movie/" + movie.item.tmdb_id
        },
        '#imdb@href': function(movie) {
          return  "http://www.imdb.com/title/" + movie.item.imdb_id
        },
        '.trailer@onclick': function(movie) {
          return  "changeVideo('"+movie.item.trailer_id+"')"
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
      '.actorthumb': {
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

function loadCrewInfo(tmdbid) {
    $.post("includes/loadmovieInfo.php","tmdbid="+tmdbid+"&action=crew", function(data, textStatus) {
    var directive = {
      '.crewthumb': {
        'movie<-': {
          '.poster@src': function(movie) {
            return "https://image.tmdb.org/t/p/w640"+ movie.item.profile_path
          },
          '.crewlink@href': function(movie) {
            return "https://www.themoviedb.org/person/"+movie.item.id
          },
          '.name': function(movie) {
            return movie.item.name
          },
          '.job': function(movie) {
            return movie.item.job
          }
        }
      }
    };
    $p('#crewrow').render(data, directive);
  }, "json")
}

function loadGenre(tmdbid) {
    $.post("includes/loadmovieInfo.php","tmdbid="+tmdbid+"&action=genre", function(data, textStatus) {
    var directive = {
      '.genre': {
        'movie<-': {
          '.label-info': function(movie) {
            return movie.item.name
          }
        }
      }
    };
    $p('.genrerow').render(data, directive);
  }, "json")
}

function loadRecommendations(tmdbid) {
    $.post("includes/recommendations.php","tmdbid="+tmdbid, function(data, textStatus) {
    var directive = {
      '.recommendthumb': {
        'movie<-': {
          '.poster@src': function(movie) {
            return "http://image.tmdb.org/t/p/w500"+ movie.item.poster_path
          },
          '.title': function(movie) {
            return movie.item.title
          },
          '.release_date': function(movie) {
            return movie.item.release_date
          }
        }
      }
    };
    $p('#recommendrow').render(data, directive);
  }, "json")
}

$(document).ready(function(){
  $("#myModal").on("hidden.bs.modal",function(){
    $("#iframeYoutube").attr("src","#");
  })
})

function changeVideo(vId){
  var iframe=document.getElementById("iframeYoutube");
  iframe.src="https://www.youtube.com/embed/"+vId;

  $("#myModal").modal("show");
}

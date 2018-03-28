<?php
if(!isset($_SESSION["userid"])) {
  echo "You are not allowed to see this";
  exit;
}
else {
  include("movieinfo.html");
}
?>
<script type="text/javascript">
    //add movie if not exist already
    <?php
      if(isset($_GET["mode"])) {
        $id = $_GET['tmdbid'];
        echo "
        var request = new XMLHttpRequest();
        request.open('GET', 'includes/addmovie.php?list=none&tmdbid=$id', false);
        request.send(null);
        ";
      }
    ?>
    loadMovieInfo(<?php echo$_GET["tmdbid"];?>);
    loadActorInfo(<?php echo$_GET["tmdbid"];?>);
    loadCrewInfo(<?php echo$_GET["tmdbid"];?>);
    loadRecommendations(<?php echo$_GET["tmdbid"];?>);
    loadGenre(<?php echo$_GET["tmdbid"];?>);
</script>

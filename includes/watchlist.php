<?php
if(!isset($_SESSION["userid"])) {
  echo "You are not allowed to see this";
  exit;
}
else {
  include("movies.html");
}
?>
<script type="text/javascript">
    loadMovies(<?php echo$_SESSION["userid"];?>,"watch");
</script>

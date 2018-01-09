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
    loadMovieInfo(<?php echo$_GET["tmdbid"];?>);
    loadActorInfo(<?php echo$_GET["tmdbid"];?>);
</script>

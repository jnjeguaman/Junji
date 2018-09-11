<?php 
ini_set("display_errors", 0);
extract($_GET);
?>
<!-- page content -->
  <div class="right_col" role="main">

  <?php if (isset($_REQUEST["action"])): ?>
      <?php include($_REQUEST["action"].".php") ?>
    <?php endif ?>
    
  </div>
  <!-- /page content -->
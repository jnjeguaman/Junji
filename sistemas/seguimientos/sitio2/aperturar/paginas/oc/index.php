<!-- page content -->
  <div class="right_col" role="main">

  <?php if (isset($_REQUEST["action"])): ?>
      <?php include($_REQUEST["action"].".php") ?>
    <?php endif ?>
    
  </div>
  <!-- /page content -->
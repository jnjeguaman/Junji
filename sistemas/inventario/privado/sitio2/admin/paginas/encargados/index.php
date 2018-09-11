  <div class="right_col" role="main">
    <?php if (isset($_REQUEST["action"])): ?>
      <?php include($_REQUEST["action"].".php") ?>
    <?php else: ?>
      <?php include("contenido.php") ?>
    <?php endif ?>
  </div>
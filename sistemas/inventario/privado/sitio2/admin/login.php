<?php
extract($_POST);
require_once("includes/config.php");
$error = NULL;
if($cmd == "login")
{
  //BUSCAMOS AL USUARIO
  $sql = "SELECT * FROM admin WHERE admin_user = '".$username."'";
  $res = mysql_query($sql,$dbh);
  $row = mysql_fetch_array($res);
  if(intval(mysql_num_rows($res)) === 0)
  {
    //USUARIO NO EXISTE
    $error.= "El Usuario no existe en nuestros registros";
  }else{
    // EL USUARIO EXISTE, COMPARAMOS LAS CONTRASEÑAS
    $dbPwd = $row["admin_password"];
    $frmPwd = md5($password);
    if(intval(strcmp($dbPwd,$frmPwd)) === 0)
    {
      $_SESSION["admin"] = $row;
      $_SESSION["admin"]["Conectado"] = true;
      header("Location: ./");
    }else{
      $error.="Contraseña incorrecta";
    }
  }
}
?>
<body style="background:#F7F7F7;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
            <h3>ADMINISTRACION</h3>
            <div>
              <input type="text" name="username" id="username" class="form-control" placeholder="Usuario" required="" value="<?php echo $username ?>"/>
            </div>
            <div>
              <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required="" value="<?php echo $password ?>"/>
            </div>
            <div>
              <!--<a class="btn btn-default submit" href="index.html">Log in</a>!-->
              <button type="submit" class="btn btn-danger submit">Entrar!</button>
              <a class="reset_pass" href="#">¿Perdiste la contraseña?</a>

            </div>
            <div class="clearfix"></div>
            <div class="separator">
              <?php echo $error ?>
              <p class="change_link">
              <!-- New to site? -->
                <!-- <a href="#toregister" class="to_register"> Create Account </a> -->
                <a href="../inicio.php" class="to_register">INEDIS</a>
              </p>
              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> JUNJI <?php echo Date("Y") ?></h1>

                <p>©2014 - <?php echo Date("Y") ?> Junta Nacional de Jardines Infantiles.</p>
              </div>
            </div>
            <input type="hidden" name="cmd" value="login">
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
      <div id="register" class="animate form">
        <section class="login_content">
          <form>
            <h1>Create Account</h1>
            <div>
              <input type="text" class="form-control" placeholder="Username" required="" />
            </div>
            <div>
              <input type="email" class="form-control" placeholder="Email" required="" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Password" required="" />
            </div>
            <div>
              <a class="btn btn-default submit" href="index.html">Submit</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              <p class="change_link">Already a member ?
                <a href="#tologin" class="to_register"> Log in </a>
              </p>
              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>

</body>

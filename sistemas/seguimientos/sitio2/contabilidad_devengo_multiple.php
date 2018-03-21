<?php
require_once("inc/config.php");
session_start();
extract($_POST);
?>
<!DOCTYPE html>
<html>
<head>
	<title>SIGEJUN</title>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
<style type="text/css">
	body {
		margin-left: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
	}
	.Estilo1 {
		font-family: Verdana;
		font-weight: bold;
		font-size: 10px;
		color: #003063;
		text-align: left;
	}
	.Estilo1b {
		font-family: Verdana;
		font-weight: bold;
		font-size: 8px;
		color: #003063;
		text-align: left;
	}
	.Estilo1c {
		font-family: Verdana;
		font-weight: bold;
		font-size: 8px;
		color: #003063;
		text-align: right;
	}
	.Estilo2 {
		font-family: Verdana;
		font-size: 10px;
		text-align: left;
	}
	.Estilo2b {
		font-family: Verdana;
		font-size: 9px;
		text-align: left;
	}
	.link {
		font-family: Geneva, Arial, Helvetica, sans-serif;
		font-size: 10px;
		font-weight: bold;
		color: #00659C;
		text-decoration:none;
		text-transform:uppercase;
	}
	.link:over {
		font-family: Geneva, Arial, Helvetica, sans-serif;
		font-size: 10px;
		color: #0000cc;
		text-decoration:none;
		text-transform:uppercase;
	}
	.Estilo4 {
		font-size: 10px;
		font-weight: bold;
	}
	.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif; 
		font-size: 15px; font-weight: bold; }
	</style>

	<!-- main calendar program -->
	<script type="text/javascript" src="librerias/calendar.js"></script>

	<!-- language for the calendar -->
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
  adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>

  <body>
  	<div class="navbar-nav ">
  		<div class="container">
  			<div class="navbar-header">
  				<?
  				require("inc/top.php");
  				?>
  			</div>
  		</div>
  	</div>

  	<div class="container">
  		<div class="row">
  			<div class="col-sm-2 col-lg-2">
  				<div class="dash-unit2">
  					<?
  					require("inc/menu_1.php");
  					?>

  				</div>
  			</div>

  			<div class="col-sm-10 col-lg-10">
  				<div class="dash-unit2">

            <table>
              <tr>
                <td class="Estilo7">DEVENGOS</td>
              </tr>
              <tr>
                <td class="link" align="left"><a href="contabilidad_devengo.php">VOLVER</a></td>
              </tr>
            </table>
            <br><br>

            <form action="contabilidad_devengo_multiple_gr.php" method="POST" enctype="multipart/form-data" name="form1" id="form1">
              <table class="table table-hover table-stripped">
               <thead>
                <th class="Estilo1">Folio</th>
                <th class="Estilo1">Rut</th>
                <th class="Estilo1">Proveedor</th>
                <th class="Estilo1">N&deg; Documento</th>
                <th class="Estilo1">Monto Documento</th>
                <th class="Estilo1">Tipo Documento</th>
                <th class="Estilo1">Recepcion Of. Partes</th>
              </thead>

              <tbody> 

              <?php
              $contador = 1;
              for($i=1;$i<=$totalRegistros;$i++)
              {
                if($var[$i] <> "")
                {
                 $sql2 = "SELECT * FROM dpp_etapas a INNER JOIN dpp_facturas b ON a.eta_id = b.fac_eta_id WHERE eta_id = ".$var[$i];
                 $res2 = mysql_query($sql2);
                 $row2 = mysql_fetch_array($res2);

                 $vartipodoc1=$row2["eta_tipo_doc"];
                 if ($vartipodoc1=='Factura') {
                  $vartipodoc2=$row2["eta_tipo_doc2"];
                  if ($vartipodoc2=="f")
                    $vartipodoc="Factura";
                  if ($vartipodoc2=="b")
                    $vartipodoc="Boleta Servicio";
                  if ($vartipodoc2=="r")
                    $vartipodoc="Recibo";
                  if ($vartipodoc2=="n")
                    $vartipodoc="N.Credito";
                  if ($vartipodoc2=="bh" or $vartipodoc2=="BH" or $vartipodoc2=="BHS")
                    $vartipodoc="Honorario";
                }
                if ($vartipodoc1=='Honorario') {
                  $vartipodoc="Honorario";
                }

                echo "<tr>";
                echo "<td class='Estilo1'>".$row2["eta_folio"]."</td>";
                echo "<td class='Estilo1'>".number_format($row2["eta_rut"],0,".",".")."-".$row2["eta_dig"]."</td>";
                echo "<td class='Estilo1'>".mb_convert_encoding($row2["eta_cli_nombre"],"iso-8859-1")."</td>";
                echo "<td class='Estilo1'>".$row2["eta_numero"]."</td>";
                echo "<td class='Estilo1'>$".number_format($row2["eta_monto"],0,".",".")."</td>";
                echo "<td class='Estilo1'>".$vartipodoc."</td>";
                echo "<td class='Estilo1'>".date("d-m-Y",strtotime($row2["eta_fecha_recepcion"]))."</td>";
                echo "</tr>";
                echo "<input type='hidden' name='var[".$contador."]' value='".$row2["eta_id"]."'>";
                echo "<input type='hidden' name='var2[".$contador."]' value='".$row2["fac_id"]."'>";
                $contador++;
              }
            }	
            ?>
            </tbody>
          </table>

          <hr>

          <table  class="table table-bordered">
           <tr>
            <td class="Estilo7" colspan="2" align="left" >INFORMACION DE DEVENGO</td>
          </tr>
          <tr>
            <td class="Estilo1">Fecha Devengo</td>
            <td align="left">
             <input type="text" name="eta_fdevengo" id="eta_fdevengo"  class="Estilo1" style="background-color: lightgray" required/>
             <img src="calendario.gif" id="f_trigger_c2" style="cursor:pointer;" title="Seleccionar Fecha">
             <script type="text/javascript">
              Calendar.setup({
                            inputField     :    "eta_fdevengo",     // id of the input field
                            ifFormat       :    "%Y-%m-%d",      // format of the input field
                            button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
                            align          :    "Bl",           // alignment (defaults to "Bl")
                            singleClick    :    true
                          });
                        </script>
                      </td>
                    </tr>
                    <tr>
                     <td class="Estilo1">Doc. Comprobante Contable (PDF)</td>
                     <td><input type="file" name="fac_devengo_archivo" id="fac_devengo_archivo" class="Estilo1" required onChange="validaArchivo()"></td>
                   </tr>
                   <tr>
                     <td class="Estilo1">N&deg; Comprobante Contable</td>
                     <td align="left"><input type="number" name="fac_nro_contable" id="fac_nro_contable" required class="Estilo1"></td>
                   </tr>
                 </table>
                 <input type="hidden" name="totalRegistros" value="<?php echo $contador ?>">
                 <button>Actualizar</button>
               </form>

             </div>
           </div>
         </div>

       </div>

       <script type="text/javascript">
         function validaArchivo()
         {
		//VALIDAMOS LA EXTENSION DEL ARCHIVO
		var archivo1 = document.form1.fac_devengo_archivo.value;
		if(archivo1 != "")
		{
			var extension = archivo1.split(".").pop().toUpperCase();
			if(extension != "PDF" && extension != "XLSX" && extension != "XLS" && extension != "CSV" && extension != "MSG") 
			{
				alert("La extension permitida es : PDF.");
				document.form1.fac_devengo_archivo.focus();
				document.form1.fac_devengo_archivo.value= "";
				return false;
			}
		}
	}
</script>
</body>

</html>		
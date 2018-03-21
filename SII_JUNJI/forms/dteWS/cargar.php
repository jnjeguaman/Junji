<?php
// ini_set("display_errors", 1);
// error_reporting(E_ALL);
if(isset($_FILES["sii_dte"]))
{

    $extension = pathinfo($_FILES["sii_dte"]["name"],PATHINFO_EXTENSION);
    $ruta = "tmp/".date("YmdHis").".".$extension;
    
    copy($_FILES["sii_dte"]["tmp_name"], $ruta);
    $respuesta = grabarRecibido($ruta);

    if($respuesta["Respuesta"])
    {

        if($respuesta["Mensaje"]["Correctos"] > 0)
        {
        echo '<div class="alert alert-success" role="alert">Exito! <i class="fa fa-check"></i>. Se cargó un total de <strong>'.$respuesta["Mensaje"]["Correctos"].'</strong> registros en la base de datos.</div>';
        }

         if($respuesta["Mensaje"]["Incorrectos"] > 0)
        {
        echo '<div class="alert alert-danger" role="alert">
        Error! <i class="fa fa-warning"></i>. Se '.$respuesta["Mensaje"]["Incorrectos"].'
        </div>
        ';
    }

    }else{
        echo '
        <div class="alert alert-danger" role="alert">
            <i class="fa fa-warning"></i> '.$respuesta["Mensaje"].'
        </div>
        ';
    }

    unlink($ruta);
}

?>
<div class="alert alert-warning" role="alert">
    Con motivo de la modificación a ley 19.983, introducida por la Ley 20.956, que señala que el Recibo de las Mercaderías o Servicios Prestados se
    debe efectuar dentro de los 8 días a contar de la recepción del DTE, caso contrario se presumirá recibida la mercadería o que los servicios han sido
    prestados si es que no se ha Reclamado en contra de su contenido o de la falta total o parcial de la entrega de las mercaderías o de la prestación
    del servicio, el SII habilitó en su sitio una aplicación que permite a los contribuyentes relacionados con un DTE (emisor, receptor o tenedor vigente
    del DTE) consultar o registrar la aceptación o reclamo a dicho DTE.
</div>
<form class="form-horizontal" action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" enctype="multipart/form-data" onsubmit="return valida()">
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h4 class="panel-title">Web Service de Consulta y Registro de Aceptación/Reclamo a DTE recibido</h4>
        </div>
        <!-- CONTENIDO -->
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label">Archivo Excel <span class="asterisk">*</span></label>
                <div class="col-sm-3">
                    <input type="file" name="sii_dte" id="sii_dte" required class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 col-sm-offset-3">
                    <button type="submit" class="btn btn-dark mr5">CARGAR</button>
                </div>
            </div>

        </div>

    </div>
</form>

<script type="text/javascript">
    function valida()
    {
        if(confirm("¿ESTÁ SEGURO DE PROCEDER CON LA CARGA DE INFORMACIÓN?"))
        {
            blockUI();
            return true;
        }else{
            return false;
        }
    }
</script>
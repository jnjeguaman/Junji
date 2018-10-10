<!DOCTYPE html>
<html>
<head>
    <title>INEDIS</title>
    <link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <script src="librerias/jquery-1.11.3.min.js"></script>
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
</head>
<body>
    <div>
		<?php include("inc/menu_1b.php"); ?>
	</div>
    <div style="margin-top:150pcx;">
        <div>
            <h3 class="Estilo2titulo">Reclasificar</h1>
        </div>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">Región de Destino</div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="cmbRegion" class="col-sm-3 control-label">SELECCIONA REGION DE DESTINO</label>
                            <div class="col-sm-3">
                                <select name="cmbRegion" class="form-control" id="cmbRegion" ></select>
                            </div>
                            <label for="txtOc1" class="col-sm-2 control-label">ORDEN DE COMPRA</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" id="txtOc1" placeholder="">
                            </div>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" id="txtOc1" placeholder="">
                            </div>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" id="txtOc1" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtOc1" class="col-sm-3 control-label">N° RECEPCIÓN TÉCNICA</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="txtOc1" placeholder="">
                            </div>
                            <label for="txtOc1" class="col-sm-3 control-label">N° RECEPCIÓN CONFORME</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="txtOc1" placeholder="">
                            </div>
                            <div class="col-sm-2">
                            <button type="submit" class="btn btn-info">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Región de Destino</div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on("ready",function(){
            
            function GetRegiones(){
                $.ajax({
                    type:"POST",
			        async:true,
			        url:"controlador/controlador_reclasificar.php",
                    data:{
                        'accion':'ListarRegiones'
                    },
                    success:function(e){
                        $("#cmbRegion").empty();
                        $("#cmbRegion").append("<option value=''>" + "Seleccione..." + "</option>");
                        
                        if (e.campos.length > 0){
                            $.each(e.campos, function(key, value){
                                $("#cmbRegion").append("<option value=" + value.region_id + ">" + value.region_glosa + "</option>");
                            });
                        } 
                    },
                    failure:function(e){
                        console.log(e);
                    }
                });
            }

            function Buscar(){
                $.ajax({
                    type:"POST",
			        async:true,
			        url:"controlador/controlador_reclasificar.php",
                    data:{
                        'accion':'Buscar'
                    },
                    success:function(e){
                        $("#cmbRegion").empty();
                        $("#cmbRegion").append("<option value=''>" + "Seleccione..." + "</option>");
                        
                        if (e.campos.length > 0){
                            $.each(e.campos, function(key, value){
                                $("#cmbRegion").append("<option value=" + value.region_id + ">" + value.region_glosa + "</option>");
                            });
                        } 
                    },
                    failure:function(e){
                        console.log(e);
                    }
                });
            }

            GetRegiones();
        });
    </script>
</body>
</html>
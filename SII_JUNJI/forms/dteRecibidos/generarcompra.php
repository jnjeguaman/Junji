<?php 
require_once("includes/functions.region.php");
require_once("includes/functions.referencia.php");
$regiones = getRegiones();
$referencias = getReferencia();
//$impuestos = getImpuestosAsociadosDocumento(1);
//print_r($impuestos);
//exit();

?>
<form class="form-control" id="FormCompras" name="FormCompras" novalidate>
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h4 class="panel-title">FORMULARIO COMPRAS</h4>
        </div>
        <!-- CONTENIDO -->
        <div class="panel-body">
            <div class="form-group col-md-12">
                <label class=" col-form-label col-form-label-sm col-sm-3">RUT <span class="asterisk">*</span></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control form-control-sm" required="" name="iecv_rut" id="iecv_rut" placeholder="Ingresar Rut" onkeyup="getClienteDetalle(this.value)">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control form-control-sm" required="" name="iecv_dv" id="iecv_dv" style="width: 50%" placeholder="DV">
                    </div>
            </div>
            <div class="form-group col-md-12">
                <label class="col-sm-3 control-label">TIPO DE DOCUMENTO <span class="asterisk">*</span></label>
                <div class="col-sm-9">
                    <select class="form-control" name="iecv_tipo_dcto" id="iecv_tipo_dcto">
                        <option value="">Seleccionar...</option>
                        <?php foreach ($referencias as $key => $value): ?>
                            <?php if ($value["ref_codigo"] == 30 || $value["ref_codigo"] == 45 || $value["ref_codigo"] == 60 || $value["ref_codigo"] == 50 || $value["ref_codigo"] == 40 || $value["ref_codigo"] == 43 || $value["ref_codigo"] == 33 || $value["ref_codigo"] == 34 || $value["ref_codigo"] == 46 || $value["ref_codigo"] == 56 || $value["ref_codigo"] == 61 || $value["ref_codigo"] == 32 ): ?>
                                <option value="<?php echo ($value["ref_id"].'-'.$value["ref_codigo"]) ?>"><?php echo "(".$value["ref_codigo"].") ".$value["ref_glosa"] ?></option>
                            <?php endif ?>
                        <?php endforeach ?>
                        
                    </select>
                </div>
            </div>
            <div id="OtrosImpGlobal">
            <div class="form-group col-md-12">
                <label class="col-sm-3 control-label">OTROS IMPUESTOS </label>
                <div class="col-sm-9">
                    <select class="form-control" id="iecv_otros_imp" name="iecv_otros_imp">
                    <option value="">Impuesto no seleccionado</option>
                    </select>
                </div>
            </div>
             <div class="form-group col-md-12" id="OtrosImp" style="display: none;">
                <div class="col-md-6">
                    <label class=" col-form-label col-form-label-sm col-sm-8 bg-primary" style="border-radius: 10px; height: 35px"><b><u><i>TASA OTROS IMPUESTOS</i></u></b></label>
                    <div class="col-sm-4">
                        <input placeholder="$" type="number" class="form-control" id="iecv_otros_imp_tasa" name="iecv_otros_imp_tasa">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class=" col-form-label col-form-label-sm col-sm-8 bg-primary" style="border-radius: 10px; height: 35px" ><b><u><i>MONTO OTROS IMPUESTOS</i></u></b></label>
                    <div class="col-sm-4">
                        <input placeholder="$" type="number" class="form-control" required="" name="iecv_otros_imp_monto" id="iecv_otros_imp_monto">
                    </div>
                </div>
            </div>
            </div>

            <div class="form-group col-md-12">
                <label class=" col-form-label col-form-label-sm col-sm-3">FOLIO <span class="asterisk">*</span></label>
                <div class="col-sm-9">
                    <input type="number" class="form-control form-control-sm" required="" name="iecv_folio" id="iecv_folio">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class=" col-form-label col-form-label-sm col-sm-3">NOMBRE CLIENTE <span class="asterisk">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" required="" name="iecv_cliente" id="iecv_cliente">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="col-sm-3 control-label">REGIÓN <span class="asterisk">*</span></label>
                <div class="col-sm-9">
                    <select class="form-control" name="iecv_region" id="iecv_region">
                        <option value="0" selected>Seleccionar...</option>
                        <?php foreach ($regiones as $key => $value): ?>
                            <option value="<?php echo $value["region_id"] ?>"><?php echo utf8_encode($value["region_glosa"]) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class=" col-form-label col-form-label-sm col-sm-3">FECHA EMISIÓN <span class="asterisk">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm FeChAs" id="iecv_fecha" name="iecv_fecha">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class=" col-form-label col-form-label-sm col-sm-3">IVA <span class="asterisk">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="iecv_iva" name="iecv_iva" value="0">
                </div>
            </div>
            <div  id="IvaNoRecGlobal">
                <div class="form-group col-md-12">
                    <label class="col-sm-3 control-label">IVA NO RECUPERABLE </label>
                    <div class="col-sm-9">
                        <select class="form-control" name="iecv_iva_norec" id="iecv_iva_norec">
                            <option value="0" selected>Seleccionar...</option>
                            <option value="1" >Compras destinadas a IVA a generar operaciones no gravadas o exentas</option>
                            <option value="2" >Facturas de proveedores registrados fuera de plazo</option>
                            <option value="3" >Gastos rechazados</option>
                            <option value="4" >Entregas gratuitas (premios, bonificaciones, etc.) recibidas</option>
                            <option value="9" >Otros</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12" id="IvaNoRec" style="display: none;">
                    <label class=" col-form-label col-form-label-sm col-sm-3 bg-primary" style="border-radius: 60px 20px 5px 90px; height: 35px"><b><u><i>MONTO IVA NO RECUPERABLE</i></u></b></label>
                    <div class="col-sm-9">
                        <input placeholder="$" type="number" class="form-control form-control-sm" id="iecv_iva_norec_monto" name="iecv_iva_norec_monto">
                    </div>
                </div>
            </div>
             <div class="form-group col-md-12">
                <label class=" col-form-label col-form-label-sm col-sm-3">IVA USO COMÚN </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="iecv_iva_usocomun" name="iecv_iva_usocomun">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class=" col-form-label col-form-label-sm col-sm-3">NETO <span class="asterisk">*</span></label>
                <div class="col-sm-9">
                    <input placeholder="$" type="number" class="form-control form-control-sm" id="iecv_neto" name="iecv_neto" value="0">
                </div>
            </div>
            <div class="form-group col-md-12" id="MontoExento">
                    <label class=" col-form-label col-form-label-sm col-sm-3">MONTO EXENTO</label>
                    <div class="col-sm-9">
                        <input placeholder="$0000000" type="number" class="form-control" id="iecv_exento" name="iecv_exento" value="0">
                    </div>
            </div>
            <div class="form-group col-md-12">
                <label class=" col-form-label col-form-label-sm col-sm-3">TOTAL <span class="asterisk">*</span></label>
                <div class="col-sm-9">
                    <input placeholder="$" type="number" class="form-control form-control-sm" id="iecv_total" name="iecv_total" value="0">
                </div>
            </div>
            <div class="form-group col-md-12">
            <label class=" col-form-label col-form-label-sm col-sm-3"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-dark mr5 pull-left">GENERAR</button>
                    <button type="button" id="LimpiarForm" class="btn btn-danger mr5 pull-left">LIMPIAR FORMULARIO</button>
                    <!-- <button type="reset" class="btn btn-dark">Reset</button> -->
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="emisor_region" value="<?php echo $_SESSION["sii"]["usuario_region"] ?>">
</form>
<script type="text/javascript" charset="utf-8">
    $(function(){
        $(".FeChAs").datepicker({
                dateFormat : 'yy-mm-dd'
            });
        $('#iecv_rut').Rut({
                digito_verificador: '#iecv_dv',
                formatOn: 'keyup',
                validateOn: 'keyup',
                on_error: function(){ alert('Rut incorrecto');
                $("#iecv_rut").val("");
                $("#iecv_dv").val("");
                document.getElementById('iecv_rut').focus();
            }
        });
    });
    $("#iecv_otros_imp").on('change', function(event) {
        event.preventDefault();
        var option = $('option:selected', this).attr('tasa');
        if(event.val != ""){
            $('#iecv_otros_imp_tasa').val(option);
         $('#OtrosImp').show();
        }else{
         $('#OtrosImp').hide();
         $('#iecv_otros_imp_tasa').val("");
         $('#iecv_otros_imp_monto').val(""); 
        }
    });
    
    $("#iecv_tipo_dcto").on('change', function(event) {
        event.preventDefault();
        var iddocu = "";
        var cod = "";

        if(event.val != ""){
            var ar0idar1cod = $(this).val().split("-");
            iddocu = ar0idar1cod[0];
            cod = ar0idar1cod[1];
            //console.log("paso el if "+iddocu+" "+cod);
        }
         $.ajax({
                type:"POST",
                url:"includes/functions.referencia.php",
                data: {iddoc: iddocu},
                dataType:"json",
                beforeSend: function(){
                    blockUI();
                },
                success : function (response) {  
                $('#iecv_otros_imp').empty();
                $('#iecv_otros_imp').append($('<option>', { 
                                value: "",
                                text : "Impuesto no seleccionado" 
                            }));
                    if(response != null){               
                        $(response).each(function( index,value ) {
                            var a  = JSON.parse(value);
                             $('#iecv_otros_imp').append($('<option>', { 
                                value: a.otros_imp_cod,
                                tasa: a.otros_imp_tasa,
                                text : "( COD: "+a.otros_imp_cod+" ) "+a.otros_imp_glosa 
                            }));
                        });
                    }
                    unBlockUI();
                },
                complete : function(){
                    unBlockUI();
                }
            });

        if(iddocu == "9" || iddocu == "10"){
         $("#iecv_iva_norec").val("0").trigger("change");
         $('#iecv_iva_norec_monto').val("");
         $('#IvaNoRecGlobal').hide();
        }else{
         $('#IvaNoRecGlobal').show();
         $('#IvaNoRec').hide();
        }

        if(iddocu == "2" || iddocu == "12"){
             //$("#MontoExento").show().children('div').children('input').val("");
             $("#iecv_iva_norec").val("0").trigger("change");
             $('#iecv_iva_norec_monto').val("");
             $('#IvaNoRecGlobal').hide();
             $("#iecv_otros_imp").val("").trigger("change");
             $('#iecv_otros_imp_tasa').val("");
             $('#iecv_otros_imp_monto').val(""); 
             $('#OtrosImpGlobal').hide();
        }else{
            //$("#MontoExento").hide().children('div').children('input').val("");
            $('#OtrosImpGlobal').show();
            $('#OtrosImp').hide();
        }

    });

    $("#iecv_iva_norec").on('change', function(event) {
        event.preventDefault();
        if(event.val != "0"){
         $('#IvaNoRec').show();
        }else{
         $('#iecv_iva_norec_monto').val("");
         $('#IvaNoRec').hide(); 
        }
    });

    $('#FormCompras').on("submit",function(){
        var data = $(this).serializeArray();
            $.ajax({
                type:"POST",
                url:"includes/functions.controllercompra.php",
                data:data,
                dataType:"JSON",
                beforeSend: function(){
                    blockUI();
                },
                success : function (response) {
                    unBlockUI();
                    if(response.Respuesta)
                    {
                        $('#LimpiarForm').trigger('click');
                        jQuery.gritter.add({
                            title: 'Exito!',
                            text: response.Mensaje,
                            class_name: 'growl-success',
                                // image: 'images/logo.png',
                                sticky: false,
                                time: ''
                            });
                        // setTimeout(function(){
                        //  window.location.href='?pagina=factura&ori=ver';
                        // },1500);
                    }else{
                        jQuery.gritter.add({
                            title: 'Ha ocurrido un error!',
                            text: response.Mensaje,
                            class_name: 'growl-danger',
                                // image: 'images/logo.png',
                                sticky: false,
                                time: ''
                            });
                    }
                }
            });
        return false;
    })
        $('#LimpiarForm').click(function() {
            $("#FormCompras")[0].reset();
            $("#iecv_tipo_dcto").val("").trigger("change");
            $("#iecv_iva_norec").val("0").trigger("change");
            $("#iecv_otros_imp").val("").trigger("change");
            $('#OtrosImp').hide();
            $('#IvaNoRec').hide();
            // $('#MontoExento').hide();
             jQuery.gritter.add({
                            title: 'Exito!',
                            text: "Formulario limpiado",
                            class_name: 'growl-success',
                                // image: 'images/logo.png',
                                sticky: false,
                                time: ''
                            });
        });
    function getClienteDetalle(input)
    {
        var data = ({command : "getClienteDetalleRut",cliente_rut : input});
        $.ajax({
            type:"POST",
            url:"includes/functions.cliente.php",
            data:data,
            dataType:"JSON",
            success : function ( response ) {
                if(response != false){
                $("#iecv_cliente").val(response[1]["cliente_empresa"]);
                $("#iecv_dv").val(response[1]["cliente_dv"]);
                $("#iecv_region").val(response[1]["provincia_region_id"]);
                }
            }
        });
    }
    
</script>
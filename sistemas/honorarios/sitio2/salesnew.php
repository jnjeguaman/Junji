<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("Y-m-d");
?>
<html>
<head>
<title>Animalfeeds</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
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
.Estilo7 {font-size: 12px; font-weight: bold; }
-->
</style>
<link rel="stylesheet" type="text/css" href="select_dependientes.css">
<script type="text/javascript" src="select_dependientes.js"></script>
<script type="text/javascript" src="ajaxclient.js"></script>
</head>
<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="../librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="../librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="../librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="../librerias/calendar-setup.js"></script>
  
<SCRIPT LANGUAGE ="JavaScript">
  function aparece(){


     if (document.form1.commodity.value == 'Other') {
       document.form1.specifications.style.display='';
     } else {
       document.form1.specifications.style.display='none';
     }
     if (document.form1.commodity.value == 'Fishmeal') {
       seccion1.style.display="";
     } else {
       seccion1.style.display="none";
    }
     if (document.form1.commodity.value == 'Fishoil') {
       seccion2.style.display="";
     } else {
       seccion2.style.display="none";
    }
 }

</script>
<body>
<img src="images/pix.gif" width="1" height="10">
<table width="752" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#003063">
  <tr>
    <td width="1009">
	  <?
	  require("inc/top.php");      
	  ?>
      <table width="750" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="165" valign="top">
		  <?
		  require("inc/menu_2.php");
		  ?>		  </td>
          <td valign="top"><strong>
            <img src="images/pix.gif" width="1" height="10">
                    </strong>            <table width="530" border="0" cellspacing="0" cellpadding="0">
            </table>
            <table width="529" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/tab1.gif" width="530" height="23"></td>
              </tr>
              <tr>
                <td align="center" background="images/tabfon.gif"><table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">SALE CONTRACT (NEW)</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1"><a href="sales2.php" class="link">Search</a> </td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>


                   <tr>
                    <td height="50" colspan="3">
                    
					<table width="488" border="0" cellspacing="0" cellpadding="0">
					  <form name="form1" action="savesalesnew.php" method="post">
                           <tr>
                             <td  valign="top" class="Estilo1">Acronym </td>
                             <td>
                                <select name="prefix" class="Estilo1">
                                 <option value="0">Select...</option>
                                 <?
                                  $sql2 = "Select * from af_acronym";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["acro_desc"] ?>"><? echo $row2["acro_desc"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1">Date </td>
                             <td>  <input type="text" name="date" class="Estilo2" value="<? echo $date_in ?> "id="f_date_c" readonly="1">
<img src="calendario.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
                             </td>

                             <td valign="center" class="Estilo1">Sellers </td>
                             <td class="Estilo1"class="Estilo1">
                               <input type="hidden" name="sellers" class="Estilo2" value="<? echo $_SESSION["company"] ?>"><p><? echo $_SESSION["company"] ?></p>
                             </td>

                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Buyers </td>
                             <td>
                             <select name="buyers" class="Estilo1" onchange="traerDatos(document.form1.buyers.value)">
                                 <option value="0">Select...</option>
                                 <?
                                  $sql2 = "Select * from af_client";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);
                                 
                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["cli_id"] ?>"><? echo $row2["cli_name"] ?></option>
                                 
                                 <?
                                   }
                                 ?>
                                 

                               </select> </td>
                            </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">Tonnage </td>
                             <td class="Estilo1" colspan=3> <input type="text" name="tonnageu" class="Estilo2" size="4" > Metric Tons <input type="text" name="tonnagepor" class="Estilo2" size="4" >% More or Less <input type="text" name="tonnage" class="Estilo2" size="20" >  </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Packing </td>
                             <td colspan=3 class="Estilo1">
                                 <input type="text" name="packing" class="Estilo2" size="30" >

                             Shipped in
                             <select name="packing3" class="Estilo1">
                                   <option value="0">Seleccione...</option>
                                 <?
                                  $sql5 = "Select * from af_shippedin";
                                  //echo $sql;
                                  $res5 = mysql_query($sql5);

                                   while($row5 = mysql_fetch_array($res5)){

                                 ?>
                                    <option value="<? echo $row5["ship_desc"] ?>"><? echo $row5["ship_desc"] ?></option>

                                 <?
                                   }
                                 ?>
                             </select>

                             </td>
                           </tr>

                         <tr>
                             <td  valign="center" class="Estilo1">Commodity </td>
                             <td colspan=3> <select name="commodity" class="Estilo1"  onChange="aparece()">
                                <option value="0">Select...</option>
                                 <?
                                  $sql3 = "Select * from af_commodity";
                                  //echo $sql;
                                  $res3 = mysql_query($sql3);

                                   while($row3 = mysql_fetch_array($res3)){

                                 ?>
                                    <option value="<? echo $row3["comm_desc"] ?>"><? echo $row3["comm_desc"] ?></option>

                                 <?
                                   }
                                 ?>
                                  </select>

                              </td>

                           </tr>
                           
                           <tr>
                             <td  valign="center" class="Estilo1">Specifications </td>
                             <td colspan=3 class="Estilo1">
                             <textarea rows="3" cols="35" name="specifications"  style='display:none;'></textarea>&nbsp;
                           <div id="seccion1" style="display:none">
                              <table>
                              <tr>
                                <td>
                              <table border=0>
                                 <tr>
                                  <td class="Estilo1">Spec</td><td class="Estilo1">Value</td><td class="Estilo1">Range</td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="var1[1]" class="Estilo2" size="12" value="Proteina"></td>
                                  <td class="Estilo1"><input type="text" name="var2[1]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="var3[1]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="var1[2]" class="Estilo2" size="12" value="Grasa"></td>
                                  <td class="Estilo1"><input type="text" name="var2[2]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="var3[2]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="var1[3]" class="Estilo2" size="12" value="Humedad"></td>
                                  <td class="Estilo1"><input type="text" name="var2[3]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="var3[3]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="var1[4]" class="Estilo2" size="12" value="Sal-Arena"></td>
                                  <td class="Estilo1"><input type="text" name="var2[4]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="var3[4]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="var1[5]" class="Estilo2" size="12" value="Arena"></td>
                                  <td class="Estilo1"><input type="text" name="var2[5]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="var3[5]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="var1[6]" class="Estilo2" size="12" value="Antioxidante"></td>
                                  <td class="Estilo1"><input type="text" name="var2[6]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="var3[6]" class="Estilo2" size="6" ></td>
                                </tr>
                               </table>
                               </td>
                               <td>
                              <table border=0>
                                 <tr>
                                  <td class="Estilo1">Spec Aditional</td><td class="Estilo1">Value</td><td class="Estilo1">Range</td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="var1[7]" class="Estilo2" size="12" value="Ceniza"></td>
                                  <td class="Estilo1"><input type="text" name="var2[7]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="var3[7]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="var1[8]" class="Estilo2" size="12" value="TVN"></td>
                                  <td class="Estilo1"><input type="text" name="var2[8]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="var3[8]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="var1[9]" class="Estilo2" size="12" value="FEA"></td>
                                  <td class="Estilo1"><input type="text" name="var2[9]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="var3[9]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="var1[10]" class="Estilo2" size="12" value="Histamina"></td>
                                  <td class="Estilo1"><input type="text" name="var2[10]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="var3[10]" class="Estilo2" size="6" ></td>
                                </tr>
                               </table>
                               
                               </td>
                               </tr>
                               </table>
                               Other Specs <input type="text" name="commoditytxt" class="Estilo2" size="43" >
                              </div>


                           <div id="seccion2" style="display:none">
                              <table>
                              <tr>
                                <td>
                              <table border=0>
                                 <tr>
                                  <td class="Estilo1">Spec</td><td class="Estilo1">Value</td><td class="Estilo1">Range</td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[1]" class="Estilo2" size="18" value="Grade"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[1]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[1]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[2]" class="Estilo2" size="18" value="Origin"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[2]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[2]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[3]" class="Estilo2" size="18" value="Free Fatty Acid (FFA)"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[3]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[3]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[4]" class="Estilo2" size="18" value="Moisture + Impurities"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[4]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[4]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[5]" class="Estilo2" size="18" value="Unsaponifiable Matters"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[5]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[5]" class="Estilo2" size="6" ></td>
                                </tr>
                               </table>
                               </td>
                               <td>
                              <table border=0>
                                 <tr>
                                  <td class="Estilo1">Spec Aditional</td><td class="Estilo1">Value</td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[6]" class="Estilo2" size="12" value="Species"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[6]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[6]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[7]" class="Estilo2" size="12" value="Iodine Value (Hanus)"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[7]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[7]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[8]" class="Estilo2" size="12" value="Color (Gardner)"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[8]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[8]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[9]" class="Estilo2" size="12" value="Antioxidant (optional)"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[9]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[9]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[10]" class="Estilo2" size="12" value="Omega-3"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[10]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[10]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[11]" class="Estilo2" size="12" value="EPA"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[11]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[11]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[12]" class="Estilo2" size="12" value="DHA"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[12]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[12]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[13]" class="Estilo2" size="12" value="Anisidine"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[13]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[13]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[14]" class="Estilo2" size="12" value="Peroxide Value"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[14]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[14]" class="Estilo2" size="6" ></td>
                                </tr>
                                <tr>
                                  <td class="Estilo1"><input type="text" name="varo1[15]" class="Estilo2" size="12" value="Totox"></td>
                                  <td class="Estilo1"><input type="text" name="varo2[15]" class="Estilo2" size="4" ></td>
                                  <td class="Estilo1"><input type="text" name="varo3[15]" class="Estilo2" size="6" ></td>
                                </tr>


                               </table>

                               </td>
                               </tr>
                               </table>
                              </div>


                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Price USD</td>
                             <td class="Estilo1">  <input type="text" name="price" class="Estilo2" size="10" > Per Metric Ton </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Basis  </td>
                             <td><select name="basis" class="Estilo1">
                                   <option value="0">Seleccione...</option>
                             <?
                                  $sql6 = "Select * from af_basis";
                                  //echo $sql;
                                  $res6 = mysql_query($sql6);

                                   while($row6 = mysql_fetch_array($res6)){

                                 ?>
                                    <option value="<? echo $row6["bas_desc"] ?>"><? echo $row6["bas_desc"] ?></option>

                                 <?
                                   }
                                 ?>

                             </select>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Destination </td>
                             <td colspan=4 class="Estilo1">
                                  <input type="text" name="paises" class="Estilo2" size="40" >

                              </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Shipping period </td>
                             <td colspan=3 class="Estilo1">
                                  <input type="text" name="shippingd1" class="Estilo2" size="12" value="<? echo $date_in ?> "id="f_date_c2" readonly="1">
<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

                                  to
                                  <input type="text" name="shippingd2" class="Estilo2" size="12" value="<? echo $date_in ?> "id="f_date_c3" readonly="1">
<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c3",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c3",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
                                  
                              </td>

                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Payment Terms </td>
                             <td colspan=3>
                                  <input type="text" name="paymentterms" class="Estilo2" size="50" >

                              </td>

                           </tr>
                           
                           <tr>
                             <td  valign="center" class="Estilo1">Unloading Rate </td>
                             <td colspan=3> <input type="text" name="unloadrate" class="Estilo2" size="60" value="CONTAINER REDELIVERY AS PER CUSTOMARY CONTAINER TERMS BY SHIPPING AGENTS AT DESTINATION"> </td>

                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Trader </td>
                             <td colspan=3>
                                  <select name="trader" class="Estilo1">
                                    <option value="0">Seleccione...</option>
                                       <?
                                  $sql8 = "Select * from af_trader";
                                  //echo $sql;
                                  $res8 = mysql_query($sql8);

                                   while($row8 = mysql_fetch_array($res8)){

                                 ?>
                                    <option value="<? echo $row8["tra_desc"] ?>"><? echo $row8["tra_desc"] ?></option>

                                 <?
                                   }
                                 ?>
                                  </select>

                              </td>
                           </tr>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Broker 1 </td>
                             <td colspan=3 class="Estilo1">
                                  <select name="broker" class="Estilo1">
                                    <option value="0">Seleccione...</option>
                                       <?
                                  $sql9 = "Select * from af_broker";
                                  //echo $sql;
                                  $res9 = mysql_query($sql9);

                                   while($row9 = mysql_fetch_array($res9)){

                                 ?>
                                    <option value="<? echo $row9["bro_name"] ?>"><? echo $row9["bro_name"] ?></option>

                                 <?
                                   }
                                 ?>
                                  </select> Comission 1
                                    <input type="text" name="comission" class="Estilo2" size="10">%
                              </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Broker 2 </td>
                             <td colspan=3 class="Estilo1">
                                  <select name="broker2" class="Estilo1">
                                    <option value="0">Seleccione...</option>
                                       <?
                                  $sql9 = "Select * from af_broker";
                                  //echo $sql;
                                  $res9 = mysql_query($sql9);

                                   while($row9 = mysql_fetch_array($res9)){

                                 ?>
                                    <option value="<? echo $row9["bro_name"] ?>"><? echo $row9["bro_name"] ?></option>

                                 <?
                                   }
                                 ?>
                                  </select> Comission 2
                                    <input type="text" name="comission2" class="Estilo2" size="10">%
                              </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Documents 1</td>
                             <td colspan=3 class="Estilo1">
                              <?
                                  $sql10 = "Select * from af_document";
                                  //echo $sql;
                                  $res10 = mysql_query($sql10);
                                   $cont=1;
                                   while($row10 = mysql_fetch_array($res10)){
                                  ?>

                              <input type='checkbox' class="Estilo2" name='var22[<? echo $cont ?>]' value='<? echo $row10["doc_id"] ?>  ' >
                              <input type='text' class="Estilo2b" name='var33[<? echo $cont ?>]' value='<? echo $row10["doc_desc"] ?>  ' size="65">
                               <br>
                                <?
                                 $cont++;
                                   }
                                 ?>
                               </td>
                             
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Other Doc. </td>
                             <td colspan=3> <textarea rows="3" cols="35" name="documents" ></textarea> </td>
                           </tr>
                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    SAVE SALE NEW    " > </td>
                           </tr>



                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      
                      <tr>
                      <td><br></tr>
                      </tr>

                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>



</td>
  </tr>
 
 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>

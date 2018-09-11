<?php
require("inc/config.php");
//echo " $numerooc1 $numerooc2 $numerooc3  ";
$dato1=$_POST['numerooc1'];
$dato2=$_POST['numerooc2'];
$dato3=$_POST['numerooc3'];
$numero=$dato1."-".$dato2."-".$dato3;
$codigo="1876-503-cm14";
/*
$sql="select * from compra_orden where oc_numero='$numero' ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row["oc_numero"]<>"")
  echo "1";
//else {
    */
//echo "estoy afuera";
$client = new SoapClient("http://www.mercadopublico.cl/wsoc/wsGetOc.asmx?WSDL", array('login' => "16574870-0", 'password' => "Mcastrol1234", 'trace' => 1));
//echo $codigo;
//exit();
// print_r($client);
$codigo=$numero;

//echo $codigo;



$params = array('trace' => 1, "porCode" => $codigo, 'login' => "jjvillagrav", 'password' => "jv5050");
$respuesta=$client->GenerateXMLOCbyCode($params);
$vars=$client->__getLastResponse();
//print_r($respuesta);
echo "<br><br>";
//  $contenido2 = utf8_encode ($contenido2);
  $contenido=$vars;
  $contenido = str_replace("&lt;","<",$contenido);
  $contenido = str_replace('&quot;','"',$contenido);
  $contenido = str_replace('&gt;',">",$contenido);
  $contenido = str_replace('&gt;&lt;',"/>",$contenido);
  $contenido = str_replace("Ó","O",$contenido);
  $contenido = str_replace('<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><GenerateXMLOCbyCodeResponse xmlns="wsGetOC"><GenerateXMLOCbyCodeResult>',"",$contenido);
  $contenido = str_replace('</GenerateXMLOCbyCodeResult></GenerateXMLOCbyCodeResponse></soap:Body></soap:Envelope>',"",$contenido);


  $xmlObject = simplexml_load_string($contenido);

  $cantidad=$xmlObject->ListSummary->OrdersQuantity."|";
  $total=$xmlObject->ListSummary->OrdersTotalAmount."|";
 // echo $xmlObject->OrdersList->Order->OrderHeader->OrderNumber->BuyerOrderNumber."|";
 // echo $xmlObject->OrdersList->Order->OrderHeader->OrderReferences->QuoteReference->RefNum."|";
 // echo $xmlObject->OrdersList->Order->OrderHeader->OrderReferences->OtherOrderReferences->ReferenceCoded->ReferenceDescription."|";
  

// $xmlObject->OrdersList->Order->OrderHeader->OrderReferences->QuoteReference->RefNum."<br>";
   $totallinea=$xmlObject->OrdersList->Order->OrderSummary->NumberOfLines;

//  echo $xmlObject->OrdersList->Order->OrderHeader->OrderDates->PromiseDate."|";

  $rut=$xmlObject->OrdersList->Order->OrderHeader->OrderParty->SellerParty->PartyID->Ident;

$pizza  = "porción1 porción2 porción3 porción4 porción5 porción6";
$rutparte = explode("-", $rut);
$rut= $rutparte[0]; // porción1
$dig= $rutparte[1]; //porción2

  $rut = str_replace(".","",$rut);
   $nombreproveedor=$xmlObject->OrdersList->Order->OrderHeader->OrderParty->SellerParty->NameAddress->Name1;
/*
//  echo $rut."|";



//  echo $xmlObject->OrdersList->Order->OrderHeader->OrderCurrency->CurrencyCoded."|";
//  echo $xmlObject->OrdersList->Order->OrderHeader->OrderReferences->QuoteReference->RefNum[0]."|";



   echo "<br><br>";
   echo "cantidad:$cantidad  <br>";
   echo "total:$total  <br>";
   echo "totallinea:$totallinea  <br>";
*/

//     /OrdersResults/OrdersList/Order/OrderHeader/OrderCurrency/CurrencyCoded
//       /OrdersResults/OrdersList/Order/OrderHeader/OrderReferences/OtherOrderReferences/ReferenceCoded/ReferenceDescription

//  $contenido = str_replace("&lt;","<",$contenido);


//}
//  echo $xmlObject->OrdersList->Order->OrderDetail->ListOfItemDetail->ItemDetail->BaseItemDetail->ItemIdentifiers->ItemDescription."|";





  



?>

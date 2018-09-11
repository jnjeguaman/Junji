<?php
require("inc/config.php");
$dato1=$_POST['d'];
$dato2=$_POST['e'];
$dato3=$_POST['f'];
$numero=$dato1."-".$dato2."-".$dato3;
$codigo="1876-503-cm14";

$sql="select * from compra_orden where oc_numero='$numero' ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row["oc_numero"]<>"")
  echo "1";
else {
//echo "estoy afuera";
$client = new SoapClient("http://www.mercadopublico.cl/wsoc/wsGetOc.asmx?WSDL", array('login' => "jjvillagrav", 'password' => "jv5050", 'trace' => 1));
//echo $codigo;
//exit();

// $codigo=$numero;
$codigo = isset($oc) ? $oc : $numero;

echo $codigo;



$params = array('trace' => 0, "porCode" => $codigo, 'login' => "jjvillagrav", 'password' => "jv5050");
$respuesta=$client->GenerateXMLOCbyCode($params);
$vars=$client->__getLastResponse();

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

  echo $xmlObject->ListSummary->OrdersQuantity."|";
  echo $xmlObject->ListSummary->OrdersTotalAmount."|";
  echo $xmlObject->OrdersList->Order->OrderHeader->OrderNumber->BuyerOrderNumber."|";
  echo $xmlObject->OrdersList->Order->OrderHeader->OrderReferences->QuoteReference->RefNum."|";
  echo $xmlObject->OrdersList->Order->OrderHeader->OrderReferences->OtherOrderReferences->ReferenceCoded->ReferenceDescription."|";
  echo $xmlObject->OrdersList->Order->OrderHeader->OrderDates->PromiseDate."|";

  $rut=$xmlObject->OrdersList->Order->OrderHeader->OrderParty->SellerParty->PartyID->Ident;

  $rut = str_replace(".","",$rut);
  echo $rut."|";

  echo $xmlObject->OrdersList->Order->OrderHeader->OrderCurrency->CurrencyCoded."|";
  echo $xmlObject->OrdersList->Order->OrderHeader->OrderReferences->QuoteReference->RefNum[0]."|";

//     /OrdersResults/OrdersList/Order/OrderHeader/OrderCurrency/CurrencyCoded
//       /OrdersResults/OrdersList/Order/OrderHeader/OrderReferences/OtherOrderReferences/ReferenceCoded/ReferenceDescription

//  $contenido = str_replace("&lt;","<",$contenido);


}
//  echo $xmlObject->OrdersList->Order->OrderDetail->ListOfItemDetail->ItemDetail->BaseItemDetail->ItemIdentifiers->ItemDescription."|";



  
  



?>

<script language="JavaScript">
function checkFields( rut, dv, clave, tipo )

{
  var tmpstr = "";
  for ( i=0; i < rut.length ; i++ )
    if ( rut.charAt(i) != ' ' && rut.charAt(i) != '.' && rut.charAt(i) !=
'-' )
      tmpstr = tmpstr + rut.charAt(i);
  rut = tmpstr;
  texto = rut + dv

  if ( rut == "")
  {
    file://alert("Complete todos los datos, por favor.");
    return false;
  }
  if ( !checkRutField(rut,dv,tipo) )
    return false;
  if ( !checkDV( texto, tipo ) )
    return false;
  return true;
}

//////////////////////////////////////////////////



function checkCDV( dvr,tipo )

{
  dv = dvr + ""
  if ( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv
!= '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  &&
dv != 'K')
  {
    return false;
  }
  return true;
}



//////////////////////////////////////////////////



function checkDV( crut,tipo )

{
  largo = crut.length;
  if ( largo < 2 )
  {
    return false;
  }

  if ( largo > 2 )
    rut = crut.substring(0, largo - 1);
  else
    rut = crut.charAt(0);
  dv = crut.charAt(largo-1);
  checkCDV( dv,tipo );

  if ( rut == null || dv == null )
      return 0

  var dvr = '0'

  suma = 0
  mul  = 2

  for (i= rut.length -1 ; i >= 0; i--)
  {
    suma = suma + rut.charAt(i) * mul
    if (mul == 7)
      mul = 2
    else
      mul++
  }


  res = suma % 11
  if (res==1)
    dvr = 'k'
  else if (res==0)
    dvr = '0'
  else
  {
    dvi = 11-res
    dvr = dvi + ""
  }

  if ( dvr != dv.toLowerCase() )
  {
    return false
  }

      return true

}



function checkPinField()

{

  if ( window.document.real_exa.CLAVE.value.length == 0 )
  {
    return false;
  }
  if ( window.document.real_exa.CLAVE.value.length != 4 )
  {
    return false;
  }



  for (i=0; i < window.document.real_exa.CLAVE.value.length ; i++ )
  {
    if ( window.document.real_exa.CLAVE.value.charAt(i) !="0" &&
window.document.real_exa.CLAVE.value.charAt(i) != "1" &&
window.document.real_exa.CLAVE.value.charAt(i) !="2" &&
window.document.real_exa.CLAVE.value.charAt(i) != "3" &&
window.document.real_exa.CLAVE.value.charAt(i) != "4" &&
window.document.real_exa.CLAVE.value.charAt(i) !="5" &&
window.document.real_exa.CLAVE.value.charAt(i) != "6" &&
window.document.real_exa.CLAVE.value.charAt(i) != "7" &&
window.document.real_exa.CLAVE.value.charAt(i) !="8" &&
window.document.real_exa.CLAVE.value.charAt(i) != "9" )
    {
      return false;
    }
  }
  return true;
}

function checkRutField(texto,dv,tipo)
{
  if (dv=='k'){
 dv='K';
 }

  texto = texto + dv;
  var tmpstr = "";

  for ( i=0; i < texto.length ; i++ )
    if ( texto.charAt(i) != ' ' && texto.charAt(i) != '.' && texto.charAt(i)
!= '-' )
      tmpstr = tmpstr + texto.charAt(i);
  texto = tmpstr;
  largo = texto.length;

  if ( largo < 2 )
  {
    return false;
  }


  for (i=0; i < largo ; i++ )
  {
    if ( texto.charAt(i) !="0" && texto.charAt(i) != "1" && texto.charAt(i)
!="2" && texto.charAt(i) != "3" && texto.charAt(i) != "4" && texto.charAt(i)
!="5" && texto.charAt(i) != "6" && texto.charAt(i) != "7" && texto.charAt(i)
!="8" && texto.charAt(i) != "9" && texto.charAt(i) !="k" && texto.charAt(i)
!= "K" )
    {
  return false;
    }
  }

  var invertido = "";

  for ( i=(largo-1),j=0; i>=0; i--,j++ )
    invertido = invertido + texto.charAt(i);

  var dtexto = "";

  dtexto = dtexto + invertido.charAt(0);
  dtexto = dtexto + '-';
  cnt = 0;

  for ( i=1,j=2; i<largo; i++,j++ )
  {
    if ( cnt == 3 )
    {
      dtexto = dtexto + '.';
      j++;
   dtexto = dtexto + invertido.charAt(i);
      cnt = 1;
    }
    else
    {
      dtexto = dtexto + invertido.charAt(i);
      cnt++;
    }
  }

  invertido = "";

 for ( i=(dtexto.length-1),j=0; i>=2; i--,j++ )
 if (dtexto.charAt(i) == "k")
  invertido = invertido + "K";
 else
  invertido = invertido + dtexto.charAt(i);

  if ( checkDV(texto,tipo) )
  {
  return true;
  }
   else
   {
  return false;
 }
 }

</script>
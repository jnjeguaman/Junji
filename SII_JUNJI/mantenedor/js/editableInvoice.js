function print_today() {
  // ***********************************************
  // AUTHOR: WWW.CGISCRIPT.NET, LLC
  // URL: http://www.cgiscript.net
  // Use the script, just leave this message intact.
  // Download your FREE CGI/Perl Scripts today!
  // ( http://www.cgiscript.net/scripts.htm )
  // ***********************************************
  var now = new Date();
  var months = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
  var date = ((now.getDate()<10) ? "0" : "")+ now.getDate();
  function fourdigits(number) {
    return (number < 1000) ? number + 1900 : number;
  }
  var today =  months[now.getMonth()] + " " + date + ", " + (fourdigits(now.getYear()));
  return today;
}

// from http://www.mediacollege.com/internet/javascript/number/round.html
function roundNumber(number,decimals) {
  var newString;// The new rounded number
  decimals = Number(decimals);
  if (decimals < 1) {
    newString = (Math.round(number)).toString();
  } else {
    var numString = number.toString();
    if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
      numString += ".";// give it one at the end
    }
    var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
    var d1 = Number(numString.substring(cutoff,cutoff+1));// The value of the last decimal place that we'll end up with
    var d2 = Number(numString.substring(cutoff+1,cutoff+2));// The next decimal, after the last one we want
    if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
      if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
        while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
          if (d1 != ".") {
            cutoff -= 1;
            d1 = Number(numString.substring(cutoff,cutoff+1));
          } else {
            cutoff -= 1;
          }
        }
      }
      d1 += 1;
    } 
    if (d1 == 10) {
      numString = numString.substring(0, numString.lastIndexOf("."));
      var roundedNum = Number(numString) + 1;
      newString = roundedNum.toString() + '.';
    } else {
      newString = numString.substring(0,cutoff) + d1.toString();
    }
  }
  if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
    newString += ".";
  }
  var decs = (newString.substring(newString.lastIndexOf(".")+1)).length;
  for(var i=0;i<decimals-decs;i++) newString += "0";
  //var newNumber = Number(newString);// make it a number if you like
  return newString; // Output the result to the form field (change for your purposes)
}

function update_total() {
  var total = 0;
  $('.price').each(function(i){
    price = $(this).html().replace("$","");
    if (!isNaN(price)) total += Number(price);
  });

  //total = roundNumber(total,0);
  iva = parseInt(0.19*total);
  $('#subtotal').val(total);
 $("#iva").val(iva);
 $('#total').val(total+iva);
  update_balance();
}

function update_balance() {
  // var due = $("#total").html().replace("$","") - $("#paid").val().replace("$","");
  var due = $("#total").html().replace("$","");
  due = roundNumber(due,2);
  
  $('.due').html("$"+due);
}

function update_price() {
  var row = $(this).parents('.item-row');
  var price = row.find('.cost').val().replace("$","") * row.find('.qty').val();
  //price = roundNumber(price,0);
  isNaN(price) ? row.find('.price').html("N/A") : row.find('.price').html("$"+price);
  
  update_total();
}

function bind() {
  $(".cost").blur(update_price);
  $(".qty").blur(update_price);
}

$(document).ready(function() {

  $('input').click(function(){
    $(this).select();
  });

  $("#paid").blur(update_balance);
   
  $("#addrow").click(function(){
    var rowCount = $(".mb30 tr").length-6;
    $("#totalElementos").val(rowCount);

    var tablaItems = '<tr class="item-row">';
    tablaItems+='<td><a class="delete" href="javascript:;" title="Remove row">X</a></td>';
    tablaItems+='<td class="item-name"><div class="delete-wpr"><input type="text" name="sii_item['+rowCount+']" id="sii_item_'+rowCount+'" class="form-control" required></div></td>';
    tablaItems+='<td><select name="sii_tipo['+rowCount+']" id="sii_tipo_'+rowCount+'" class="form-control"><option value="0" selected>AFECTO</option><option value="1">EXENTO</option></select></td>';
    tablaItems+='<td><input type="text" onChange="checkCantidad(this.value,'+rowCount+')" name="sii_producto_qty['+rowCount+']" id="sii_producto_qty_'+rowCount+'" class="qty form-control" required value="0"></td>';
    tablaItems+='<td><input type="text" onChange="checkCosto(this.value,'+rowCount+')"name="sii_producto_costo['+rowCount+']" id="sii_producto_costo_'+rowCount+'" class="cost form-control" required value="0"></td>';
    tablaItems+='<td><input type="number" min="0" max="100" onChange="checkDescuento(this.value,'+rowCount+')"name="sii_producto_desc['+rowCount+']" id="sii_producto_desc_'+rowCount+'" class="desc form-control" required value="0"></td>';
    tablaItems+='<td><input type="text" name="var1['+rowCount+']" id="var1_'+rowCount+'" class="form-control" readonly></td>';
    tablaItems+='<input type="hidden" name="montoDescuento['+rowCount+']" id="montoDescuento_'+rowCount+'" value="0">';
    tablaItems+='</tr>';

    $(".item-row:last").after(tablaItems);
    if ($(".delete").length > 0) $(".delete").show();
    // bind();
  });
  
  bind();
  
  $(".delete").live('click',function(){
    //$("#totalElementos").val($("#totalElementos").val() - 1);
    $(this).parents('.item-row').remove();
    update_total();
    if ($(".delete").length < 1) $(".delete").hide();
  });
  
  $("#cancel-logo").click(function(){
    $("#logo").removeClass('edit');
  });
  $("#delete-logo").click(function(){
    $("#logo").remove();
  });
  $("#change-logo").click(function(){
    $("#logo").addClass('edit');
    $("#imageloc").val($("#image").attr('src'));
    $("#image").select();
  });
  $("#save-logo").click(function(){
    $("#image").attr('src',$("#imageloc").val());
    $("#logo").removeClass('edit');
  });
  
  $("#date").val(print_today());
  
});
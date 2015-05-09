 <script>
 //check session variable
 var session
$(window ).load("sessionstart.php",function(varet){
  session= varet;
  alert (session);

  })

  //Code for turning span to input:
   var ldata
   var ser
   var rowid
   var textbox=false;
    $("#Pending").on('click','.td',function(){
      if(!textbox){
        var tdid= $(this).attr('id');
        var cellname= $("#"+tdid).html().replace(/ /g,'');
        rowid=$(this).parent('.tr').attr('id');
          //alert(cellname);
        var celldata= $(this).children("span").html();
        $(this).children("span").remove();
        var inputinfo= $('<input />', {'type': 'text','class': 'txtToInput', 'name': cellname, 'value': celldata, 'Primary':'', 'onchange':'updatepending()'});
        $(this).append(inputinfo);
        $(inputinfo).focus();
        textbox=true;

      }
    });
    //Code for turning input to span:
      $("#Pending").on('blur','.td',function(){
         if(textbox){
               var celldata= $(this).children("input").val();

                   $(this).children("input").remove();
                      var shpan= "<span> "+celldata+"</span >" ;

                        $(this).append(shpan);
                           textbox=false;
                     }
                       if ($(this).attr('id') == 'td6'){
                       //$(this).siblings("#td6").children().html()
            // $(this).attr('id').html();
            // alert(parseFloat($(this).siblings('#td5').text()));
            //  alert(parseFloat($(this).siblings('#td7').text()));
            // alert(parseFloat(celldata)*parseFloat($(this).siblings('#td5').text()));
             var num= parseFloat(celldata)*parseFloat($(this).siblings('#td5').text())
             //alert(num +" wee");
                $(this).siblings('#td7').children().remove();
                $(this).siblings('#td7').append("<span> "+num.toString()+"</span >") ;
              }

      });

    function changeLineTotal(){
            var QTY=  $(this).siblings("#td5").children().html();
           var UP= $(this).siblings("#td6").children().html();
           var LT = parseFloat(QTY) * parseFloat(UP);
           //$(this).siblings("#td7").children().html()= QTY * UP;
          alert( $(this).siblings("#td6").children().html());
    };


      //Code for submission of changed row.
       $("#Pending").on('click','.subchange',function(){

            var v=$(this).parents('tr').attr('id');
                    var serializethis
                    serializethis="Primary"+"="+$(this).parents('.tr').attr('Primary')+"&"
           $("#"+v).children("td").each(function(index,element){
                     var tdid =  $(this).attr('id');
                     var cellname= $("#head"+" #"+tdid).text().replace(/ /g,'');

                     var mystring=$(this).children("span").text()
                       serializethis+=cellname+"="+mystring;//+"&";


                if(tdid=="td7") {
                   // alert ("exit");
                    return false;
                }
                else
                {
                  serializethis+="&";
                }

             });


                $.post("update.php",serializethis,function(info){
                   //alert (info);
                  $("#Pending table").remove();
                    $.post("pending.php",function(info){
                        var tbl= "<table>";
                       ldata=info;
                        var icount=0;
                        var obj= $.parseJSON(info);

                            tbl+=
                            "<tr id=head>"
                            +"<th id=td1> Job </th>"
                            +"<th id=td2> Vendor </th>"
                            +"<th id=td3> Item NO </th>"
                            +"<th id=td4> Item Name </th>"
                            +"<th id=td5> Qty </th>"
                            +"<th id=td6> Unit Price </th>"
                            +"<th id=td7> Line Total </th>"
                            +"<th id=td8> Approve </th>"
                            +"<th id=td9> Update </th>"
                            +"<th id=td10> Delete </th>"
                            //+"<th id=td11> Delete </th>"
                            +"</tr>";
                               icount++;
                             //  alert(  icount + " is icount");
                             tbl+=
                                 "<tr id=tr"+icount+" "+"class=tr"+" "+"Primary="+">"
                          	+"<td id=td1 class=td><span>"+"</span></td>"
                           	+"<td id=td2 class=td><span>"+"</span></td>"
                            	+"<td id=td3 class=td><span>"+"new order"+"</span></td>"
                             	+"<td id=td4 class=td><span>"+"</span></td>"
                              	+"<td id=td5 class=td><span>"+"</span></td>"
                              	+"<td id=td6 class=td><span>"+"</span></td>"
                              	+"<td id=td7 class=td><span>"+"</span></td>"
                              	+"<td align='center'><input type='checkbox' name='approve' value='approved' ></td>"
                                +"<td align='center'><button type='button' class='subchange' id='subchange"+icount+"' value='button text' style='width:100;height:25'></td>"
                                +"<td align='center'><input type='checkbox' name='delete' ></td>"
                               	+"</tr>" ;

                        $.each(obj,function(index,value){
                                 icount++;
                        	//var newRow =
                         	 tbl+=
                                 "<tr id=tr"+icount+" "+"class=tr"+" "+"Primary="+value.Primary+">"
                          	+"<td id=td1 class=td><span>"+value.Job+"</span></td>"
                           	+"<td id=td2 class=td><span>"+value.Vendor+"</span></td>"
                            	+"<td id=td3 class=td><span>"+value.ItemNo+"</span></td>"
                             	+"<td id=td4 class=td><span>"+value.ItemName+"</span></td>"
                              	+"<td id=td5 class=td><span>"+value.Qty+"</span></td>"
                              	+"<td id=td6 class=td><span>"+value.UnitPrice+"</span></td>"
                              	+"<td id=td7 class=td><span>"+value.LineTotal+"</span></td>"
                              	+"<td align='center'><input type='checkbox' name='approve' value='approved' ></td>"
                                +"<td align='center'><button type='button' class='subchange' id='subchange"+icount+"' value='button text' style='width:100;height:25'></td>"
                                +"<td align='center'><input type='checkbox' name='delete' ></td>"
                               	+"</tr>" ;
                                	//$(newRow).appendTo("#Pending");
                         });
                         tbl+="</table>";
                         $(tbl).appendTo("#Pending");
                              //	$("#Pending").append(	$("#Pending").html(info));
                });
                });

       });

     

      //Code for tabulating all existing pending orders:
        $.post("pending.php",function(info){
                        var tbl= "<table>";
                       ldata=info;
                        var icount=0;
                        var obj= $.parseJSON(info);

                            tbl+=
                            "<tr id=head>"
                            +"<th id=td1> Job </th>"
                            +"<th id=td2> Vendor </th>"
                            +"<th id=td3> Item NO </th>"
                            +"<th id=td4> Item Name </th>"
                            +"<th id=td5> Qty </th>"
                            +"<th id=td6> Unit Price </th>"
                            +"<th id=td7> Line Total </th>"
                            +"<th id=td8> Approve </th>"
                            +"<th id=td9> Update </th>"
                            +"<th id=td10> Delete </th>"
                            //+"<th id=td11> Delete </th>"
                            +"</tr>";
                               icount++;

                             tbl+=
                                 "<tr id=tr"+icount+" "+"class=tr"+" "+"Primary="+">"
                          	+"<td id=td1 class=td><span>"+"</span></td>"
                           	+"<td id=td2 class=td><span>"+"</span></td>"
                            	+"<td id=td3 class=td><span>"+"new order"+"</span></td>"
                             	+"<td id=td4 class=td><span>"+"</span></td>"
                              	+"<td id=td5 class=td><span>"+"</span></td>"
                              	+"<td id=td6 class=td><span>"+"</span></td>"
                              	+"<td id=td7 class=td><span>"+"</span></td>"
                              	+"<td align='center'><input type='checkbox' name='approve' value='approved' ></td>"
                                +"<td align='center'><button type='button' class='subchange' id='subchange"+icount+"' value='button text' style='width:100;height:25'></td>"
                                
                                if (sesssion ="boss"){
                                 tbl+=
                                "<td align='center'><input type='checkbox' name='delete' disabled='disabled'></td>"
                               	+"</tr>" ;

                               	}

                        $.each(obj,function(index,value){
                                 icount++;
                        	//var newRow =
                         	 tbl+=
                                 "<tr id=tr"+icount+" "+"class=tr"+" "+"Primary="+value.Primary+">"
                          	+"<td id=td1 class=td><span>"+value.Job+"</span></td>"
                           	+"<td id=td2 class=td><span>"+value.Vendor+"</span></td>"
                            	+"<td id=td3 class=td><span>"+value.ItemNo+"</span></td>"
                             	+"<td id=td4 class=td><span>"+value.ItemName+"</span></td>"
                              	+"<td id=td5 class=td><span>"+value.Qty+"</span></td>"
                              	+"<td id=td6 class=td><span>"+value.UnitPrice+"</span></td>"
                              	+"<td id=td7 class=td><span>"+value.LineTotal+"</span></td>"
                              	+"<td align='center'><input type='checkbox' name='approve' value='approved' ></td>"
                                +"<td align='center'><button type='button' class='subchange' id='subchange"+icount+"' value='button text' style='width:100;height:25'></td>"
                                 if (sesssion ="boss"){
                                 tbl+=
                                "<td align='center'><input type='checkbox' name='delete' disabled='disabled'></td>"
                               	+"</tr>" ;
                                }
                                	//$(newRow).appendTo("#Pending");
                         });
                         tbl+="</table>";
                         $(tbl).appendTo("#Pending");
                              //	$("#Pending").append(	$("#Pending").html(info));
                });





    //submit new order.
   $(".Shazaam1").click( function(){

    if (!isNaN(parseFloat($('input.Qty').val())) && $('input.Qty').val().length!=0) {
       if(!isNaN(parseFloat($('input.UnitPrice').val())) && $('input.UnitPrice').val().length!=0) {

     var sum =  parseFloat($('input.UnitPrice').val()) * parseFloat($('input.Qty').val());
                                                   alert(sum);
                                                   $("#sumup").html("$"+sum);
       }
     }
     var data =$("#neworder1 :input").serializeArray();

     $.post("save.php", data,function(info){


                $.post("pending.php",function(info){
                        var tbl= "<table>";

                        var obj= $.parseJSON(info);


                               
                        $.each(obj,function(index,value){

                        	//var newRow =
                         	 tbl+=
                                 "<tr>"
                          	+"<td>"+value.Job+"</td>"
                           	+"<td>"+value.Vendor+"</td>"
                            	+"<td>"+value.ItemNo+"</td>"
                             	+"<td>"+value.ItemName+"</td>"
                              	+"<td>"+value.Qty+"</td>"
                              	+"<td>"+value.UnitPrice+"</td>"
                              	+"<td>"+value.LineTotal+"</td>"
                              	+"<td align='center'><input type='checkbox' name='approve' value='approved' ></td>"
                                +"<td align='center'><input type='checkbox' name='onhold' ></td>"
                                +"<td align='center'><input type='checkbox' name='delete' ></td>"
                               	+"</tr>" ;
                                	//$(newRow).appendTo("#Pending");
                         });
                         tbl+="</table>";
                         $(tbl).appendTo("#Pending");
                              //	$("#Pending").append(	$("#Pending").html(info));
                });

    });

     $("#neworder1").submit( function(){
          return false;

                   $("#neworder1").each(function(){
                        $(this).val()="";

                    });
           });
    });     
    





});


</script>
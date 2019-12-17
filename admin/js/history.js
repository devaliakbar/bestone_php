$(document).ready(function () { 
   loadBookings("");
    $("#username").keyup(function () {
        $("#phone").val("");
        if($("#username").val() != ""){
            searchItems();
        }
        
    });

    $("#phone").keyup(function () {
        $("#username").val("");
        if($("#phone").val() != ""){
            searchItems();
        }
    });

    $("#dat1").keyup(function () {
     if($("$dat1").val() != "" && $("$dat2").val() != ""){
        // searchItems();
     }
    });

      $("#dat2").keyup(function () {
     if($("$dat1").val() != "" && $("$dat2").val() != ""){
         //searchItems();
     }
    });
}); 


function searchItems(){
    var uname = $("#username").val();
    var phone = $("#phone").val();
    var d1 = $("#dat1").val();
    var d2 = $("#dat2").val();

var sendData = {
    name :uname,
    phone : phone
};
loadBookings(sendData);
}

function loadBookings(sendData){
	   var loadStockHTTP = new XMLHttpRequest();
    loadStockHTTP.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var resobj = JSON.parse(this.responseText);
            if (resobj.success) {
                var cursor = resobj.cursor;
                jQuery("#grid-data").empty();
                for (var i = 0; i < cursor.length; i++) {
                    var appendRaw = "<tr class='" + cursor[i].id + " grid-items'>";

                    appendRaw += "<td class='grid-slno'>" + (i + 1) + "</td>";
                    appendRaw += "<td class='grid-order-id'>" + cursor[i].id + "</td>";
                    appendRaw += "<td class='grid-username'>" + cursor[i].username + "</td>";
                    appendRaw += "<td class='grid-date'>" + cursor[i].date + "</td>";
                    appendRaw += "<td class='grid-items'>" + cursor[i].items + "</td>";
                    appendRaw += "<td class='grid-total'>" + cursor[i].total + "</td>";
                    appendRaw += "<td class='grid-msg'>" + cursor[i].msg + "</td>";

                    if(cursor[i].status == "DONE"){
                    	appendRaw += "<td class='grid-status'><span style='background:green;color:white;'>Delevered</span></td>";
                    }else{
                    	appendRaw += "<td class='grid-status'><span style='background:red;color:white;'>Canceled</span></td>";
                    }
                    

                    appendRaw += "</tr>";
                    jQuery("#grid-data").append(appendRaw);
                }
                $('table tr').click(function () {
                    var itemIndex = $('table tr').index(this);
                    if (itemIndex > 0) {
                        var itemId = $('table tr:eq(' + itemIndex + ')').attr('class').split(' ')[0];
                    
                         var url = "past-manage-orders.php?q=" + itemId;
                         window.open(url, '_blank');
                    }
                });
            
            } else {
                jQuery("#grid-data").empty();
            }
        }
    };
    if(sendData == ""){
loadStockHTTP.open("POST", prefixLink + "pastOrders.php", true);
    }else{
        var myJSON = JSON.stringify(sendData);
    loadStockHTTP.open("POST", prefixLink + "pastOrders.php?q=" + myJSON, true);
    }
    
    loadStockHTTP.send();
}
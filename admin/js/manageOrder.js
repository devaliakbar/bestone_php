$(document).ready(function(){
	loadCustomerDetail();

	$("#del").click(function(){
		actionToOrder("delete");
	});
	$("#can").click(function(){
		actionToOrder("cancel");
	});
	$("#don").click(function(){
		actionToOrder("delevery");
	});
});

function loadCustomerDetail(){
	      var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var resobj = JSON.parse(this.responseText);
                if (resobj.success) {
                   $("#username").val(resobj.username);
                   $("#name").val(resobj.name);
                   $("#phone").val(resobj.phone);
                   $("#email").val(resobj.email);
                   $("#status").val(resobj.status);


                    $("#house").val(resobj.house);
                   $("#land").val(resobj.landmark);
                   $("#extra").val(resobj.extra);

                       $("#tot").val(resobj.no);
                   $("#amnt").val(resobj.tot);

                   loadItemList();
                } else {
                    alert("Failed To Load Customer Details");
                }
            }
        };
        var myJSON = $("#order_id").val();
        xmlhttp.open("POST", prefixLink + "loadCustomer.php?q=" + myJSON, true);
        xmlhttp.send();
}

function loadItemList(){
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
                    appendRaw += "<td class='grid-id'>" + cursor[i].id + "</td>";
                    appendRaw += "<td class='grid-name'>" + cursor[i].name + "</td>";
                    appendRaw += "<td class='grid-cat'>" + cursor[i].catagory + "</td>";
                    appendRaw += "<td class='grid-man'>" + cursor[i].brand + "</td>";
                    appendRaw += "<td class='grid-price'>" + cursor[i].price + "</td>";
                    appendRaw += "<td class='grid-qty'>" + cursor[i].qty + "</td>";
                    appendRaw += "<td class='grid-total'>" + cursor[i].total + "</td>";

                    appendRaw += "</tr>";
                    jQuery("#grid-data").append(appendRaw);
                }
            } else {
            	alert("Something Went Wrong,Data is empty")
                jQuery("#grid-data").empty();
            }
        }
    };
        loadStockHTTP.open("POST", prefixLink + "loadItemBooking.php?q=" + $("#order_id").val() , true);   
        loadStockHTTP.send();
}

function actionToOrder(action){
	var sendData = {
		action : action,
		id : $("#order_id").val()
	};

	 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var resobj = JSON.parse(this.responseText);
                if (resobj.success) {
                	if(action == "delete"){
                		 alert("Successfully Deleted");
                	}

                	if(action == "cancel"){
                		 alert("Successfully Canceled");
                	}

                	if(action == "delevery"){
                		 alert("Successfully Changed Status to Delevered");
                	}
                   window.top.close();
                } else {
                    alert("Failed To Perform Action");
                }
            }
        };
        var myJSON = JSON.stringify(sendData);
        xmlhttp.open("POST", prefixLink + "actionOnOrder.php?q=" + myJSON, true);
        xmlhttp.send();
}
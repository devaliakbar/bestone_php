$(document).ready(function(){
	loadItem();
	$("#del").click(function(){
deleteItem();
	});
	$("#upd").click(function(){
	var name =	$("#name").val();
    var brand = $("#brand").val();
     var cat =  $("#categ").val();
      var price =  $("#price").val();
      var urlss =  $("#rurl").val();
if(name == "" || brand == "" || cat == "" || price == ""){
	alert("Please Enter Every Field");
}else{
	var status ;
	if($("#avail").prop('checked') == true){
	status = 1;
}else{
	status = 0;
}

var sendData = {
	id : $("#id").val(),
	name : name,
	brand : brand,
	cat : cat,
	price : price,
	status : status,
	url : urlss
};

updateItem(sendData);
}
	});
});

function deleteItem(){
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var resobj = JSON.parse(this.responseText);
                if (resobj.success) {
                   alert("Successfully deleted");
                   window.top.close();
                } else {
					 if (resobj.status == "USED") {
						 alert("You Can't Delete This Item.");
					 }else{
                    alert("Failed To delete");
					 }
                }
            }
        };
        var myJSON = $("#id").val();
        xmlhttp.open("POST", prefixLink + "delete.php?q=" + myJSON, true);
        xmlhttp.send();
}

function updateItem(sendData){
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var resobj = JSON.parse(this.responseText);
                if (resobj.success) {
                   alert("Successfully Updated");
                   window.top.close();
                } else {
                    alert("Failed To delete");
                }
            }
        };
        var myJSON = JSON.stringify(sendData);
        xmlhttp.open("POST", prefixLink + "update.php?q=" + myJSON, true);
        xmlhttp.send();
}

function loadItem(){
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var resobj = JSON.parse(this.responseText);
                if (resobj.success) {
                    $("#name").val(resobj.name);
                    $("#brand").val(resobj.brand);
                    $("#categ").val(resobj.catagory);
                    $("#price").val(resobj.price);
                    $("#rurl").val(resobj.url);
                    var img_prefix = $("#id").val();
                    $('#img_cur').attr('src', "http://bestonesupermarket.com/img/" + img_prefix + ".jpg");

                    	if(resobj.status == 1){
                    		   $("#avail").prop('checked',true);
                    	}else{
                    		$("#avail").prop('checked',false);
                    	}
                 
                } else {
                    alert("Failed To Load");
                }
            }
        };
        var myJSON = $("#id").val();
        xmlhttp.open("POST", prefixLink + "loadItem.php?q=" + myJSON, true);
        xmlhttp.send();
}
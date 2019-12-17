$(document).ready(function () {
	loadProfileOnDatagrid("");

$("#name").keyup(function () {
        $("#phone").val("");
        $("#username").val("");
        $("#email").val("");
        if($("#name").val() != ""){
          var filter = {
        		a : "name",
        		b : $("#name").val()
        	};
         searchItems(filter);       	
        }
});
        $("#phone").keyup(function () {
        $("#name").val("");
        $("#username").val("");
        $("#email").val("");
        if($("#phone").val() != ""){
          var filter = {
        		a : "phone",
        		b : $("#phone").val()
        	};
         searchItems(filter);      	
        }
});
        $("#username").keyup(function () {
        $("#name").val("");
        $("#phone").val("");
        $("#email").val("");
        if($("#username").val() != ""){
         var filter = {
        		a : "username",
        		b : $("#username").val()
        	};
         searchItems(filter);      	
        }
});

$("#email").keyup(function () {
        $("#name").val("");
        $("#phone").val("");
        $("#username").val("");
        if($("#email").val() != ""){
        	var filter = {
        		a : "email",
        		b : $("#email").val()
        	};
         searchItems(filter);       	
        }
});


});


function searchItems(filter){
	loadProfileOnDatagrid(filter);
}


function loadProfileOnDatagrid(sendData){
	    var loadStockHTTP = new XMLHttpRequest();
    loadStockHTTP.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var resobj = JSON.parse(this.responseText);
            if (resobj.success) {
                var cursor = resobj.cursor;
                jQuery("#grid-data").empty();
                for (var i = 0; i < cursor.length; i++) {
                    var appendRaw = "<tr class='" + cursor[i].id + " grid-items'>";
            
                    appendRaw += "<td class='grid-id'>" + cursor[i].id + "</td>";
                    appendRaw += "<td class='grid-name'>" + cursor[i].name + "</td>";
                    appendRaw += "<td class='grid-user'>" + cursor[i].username + "</td>";
                    appendRaw += "<td class='grid-phone'>" + cursor[i].phone + "</td>";
                    appendRaw += "<td class='grid-email'>" + cursor[i].email + "</td>";
                   
                    appendRaw += "</tr>";
                    jQuery("#grid-data").append(appendRaw);
                }
                $('table tr').click(function () {
                    var itemIndex = $('table tr').index(this);
                    if (itemIndex > 0) {
                        var itemId = $('table tr:eq(' + itemIndex + ')').attr('class').split(' ')[0];
                        var proceed = confirm("Do You Want To Delete");
                        if(proceed){
                        	deleteUser(itemId);
                        }
                  
                    }
                });
            
            } else {
                jQuery("#grid-data").empty();
                if(sendData != ""){
                  
                }else{
                    alert("Data Is Empty");
                }
            }
        }
    };
    if (sendData == "") {
        loadStockHTTP.open("POST", prefixLink + "loadProfile.php", true);
    } else {
        var myJSON = JSON.stringify(sendData);
        loadStockHTTP.open("POST", prefixLink + "loadProfile.php?q=" + myJSON, true);
    }
    loadStockHTTP.send();
}

function deleteUser(itemId){
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var resobj = JSON.parse(this.responseText);
                if (resobj.success) {
                 alert("Successfully Delete this user");
                 location.reload();
                } else {
                    alert("Failed To Delete this user");
                }
            }

        };
        
        xmlhttp.open("POST", prefixLink + "deleteUser.php?q=" + itemId, true);
        xmlhttp.send();
}
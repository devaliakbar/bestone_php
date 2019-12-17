$(document).ready(function () {
    loadStockOnDatagrid("");
    $("#refresh").click(function(){
        loadStockOnDatagrid("");
    });

    $("#big_search").keyup(function () {
        $("#name").val("");
        $("#brand").val("");
        $("#cat").val("");
        $("#status").val("");
        $("#id").val("");
        var data =  $("#big_search").val();
        if(data != ""){
           var sendData = {
                all : data
            };
            loadStockOnDatagrid(sendData);
        }else{
            loadStockOnDatagrid("");
        }
    });


    $("#id").keyup(function () {
        $("#name").val("");
        $("#brand").val("");
        $("#cat").val("");
        $("#status").val("");
        searchItems();
    });

    $("#name").keyup(function () {
        $("#id").val("");
        searchItems();
    });

    $("#brand").keyup(function () {
        $("#id").val("");
        searchItems();
    });

    $("#cat").keyup(function () {
        $("#id").val("");
        searchItems();
    });

    $("#status").keyup(function () {
        $("#id").val("");
        searchItems();
    });
});

function searchItems(){
    var id = $("#id").val();
    var name =$("#name").val();
    var brand =$("#brand").val();
    var cat =$("#cat").val();
    var status =$("#status").val();

    if(name == "" && brand == "" && cat == "" && status == "" && id == ""){
        loadStockOnDatagrid("");
    }else{
        sendData = {
            id : id,
            name : name,
            brand : brand,
            cat : cat,
            status : status
        };
        loadStockOnDatagrid(sendData);
    }
}

function loadStockOnDatagrid(sendData) {
    var loadStockHTTP = new XMLHttpRequest();
    loadStockHTTP.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

                     var resobj = JSON.parse(this.responseText);
            if (resobj.success) {
                var cursor = resobj.cursor;
                jQuery("#grid-data").empty();
                for (var i = 0; i < cursor.length; i++) {
                    var appendRaw = "<tr class='" + cursor[i].itemid + " grid-items'>";
                    appendRaw += "<td class='grid-slno'>" + (i + 1) + "</td>";
                    appendRaw += "<td class='grid-id'>" + cursor[i].itemid + "</td>";
                    appendRaw += "<td class='grid-name'>" + cursor[i].itemname + "</td>";
                     appendRaw += "<td class='grid-cat'>" + cursor[i].itemcatagory + "</td>";
                    appendRaw += "<td class='grid-man'>" + cursor[i].itemmanufactor + "</td>";
                   
                    appendRaw += "<td class='grid-price'>" + cursor[i].price + "</td>";
                    if(cursor[i].status == "1"){
                        appendRaw += "<td class='grid-status'>Available</td>";
                    }else{
                        appendRaw += "<td class='grid-status'>Not Available</td>";
                    }
                    appendRaw += "</tr>";
                    jQuery("#grid-data").append(appendRaw);
                }
                $('table tr').click(function () {
                    var itemIndex = $('table tr').index(this);
                    if (itemIndex > 0) {
                        var itemId = $('table tr:eq(' + itemIndex + ')').attr('class').split(' ')[0];
                    
                         var url = "product-stock-detail.php?q=" + itemId;
                         window.open(url, '_blank');
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
        loadStockHTTP.open("POST", prefixLink + "loadStock.php", true);
    } else {
        var myJSON = JSON.stringify(sendData);
        loadStockHTTP.open("POST", prefixLink + "loadStock.php?q=" + myJSON, true);
    }
    loadStockHTTP.send();
}
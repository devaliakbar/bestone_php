$(document).ready(function () {
    $('#add').click(function () {
        adddItem();
    });
    loadCatagory();
    $('#adde').click(function () {
        if($('#ade').val() != ""){
         jQuery("#e1").append("<option >" +  $('#ade').val() + "</option>");
          $('#ade').val("");
        }
    });
});
 
function adddItem() {
    var name = $('#name').val().trim();
    var brand = $('#brand').val().trim();
    var cata = $('#e1').find(":selected").text();
    var price = $('#price').val().trim();

    if (name == "" || cata == "" || price == "") {
        alert("Some Important Fields Are Empty")
    } else {
        if(brand == ""){
            brand = "NA";
        }
        var sendData = {
            name: name,
            brand: brand,
            cat: cata,
            price: price
        };
        sendItems(sendData);
    }
}
 function sendItems(valuesForSending) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var resobj = JSON.parse(this.responseText);
                if (resobj.success) {
                    alert("Successfully Saved");
                } else {
                    alert("Failed To Save");
                }
            }
        };
        var myJSON = JSON.stringify(valuesForSending);
        xmlhttp.open("POST", prefixLink + "addProduct.php?q=" + myJSON, true);
        xmlhttp.send();
    }

    function loadCatagory() {
    var loadStockHTTP = new XMLHttpRequest();
    loadStockHTTP.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
                     var resobj = JSON.parse(this.responseText);
            if (resobj.success) {
                var cursor = resobj.cursor;
                jQuery("#e1").empty();
                for (var i = 0; i < cursor.length; i++) {
                  var appendRaw = "<option >" + cursor[i].cat + "</option>";
                    jQuery("#e1").append(appendRaw);
                }
            } 
        }
    };
        loadStockHTTP.open("POST", prefixLink + "loadCatForSuggetion.php", true);
    loadStockHTTP.send();
}
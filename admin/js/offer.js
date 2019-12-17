$(document).ready(function () {
    $('#add').click(function () {
        adddItem();
    });
});

function adddItem() {
    var first = $('#first').val().trim();
    var second = $('#second').val().trim();
    var third = $('#third').val().trim();

    if (first == "" || second == "" || third == "") {
        alert("Some Important Fields Are Empty")
    } else {
        var sendData = {
            one: first,
            two: second,
            three: third
        };
        sendItems(sendData);
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
        xmlhttp.open("POST", prefixLink + "addMessage.php?q=" + myJSON, true);
        xmlhttp.send();
    }
}
$("#buttonMinus").on("click", function () {
    console.log("minus");
    var value = parseInt($("#inputQuantity").val());
    if (value >= 1) {
        $("#inputQuantity").val(value - 1);
    }
});

$("#buttonPlus").on("click", function () {
    console.log("plus");
    var value = parseInt($("#inputQuantity").val());
    $("#inputQuantity").val(value + 1);
});
$("#buttonMinus").on("click", function () {
    var value = parseInt($("#inputQuantity").val());
    if (value >= 1) {
        $("#inputQuantity").val(value - 1);
    }
});

$("#buttonPlus").on("click", function () {
    var value = parseInt($("#inputQuantity").val());
    $("#inputQuantity").val(value + 1);
});

$("#buttonAddToCart").on("click", function () {
    var quantity = parseInt($("#inputQuantity").val());
    var id = parseInt($("#inputId").val());
});




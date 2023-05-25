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

$("#buttonCart_disconnected").on("click", function () {
    console.log("cart");
    alert("Vous devez vous connecter pour ajouter un article à votre panier.");
});
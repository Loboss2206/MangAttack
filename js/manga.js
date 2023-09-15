$("#buttonMinus").on("click", function () {
    var value = parseInt($("#inputQuantity").val());
    if (value >= 2) {
        $("#inputQuantity").val(value - 1);
    }
});

$("#buttonPlus").on("click", function () {
    var value = parseInt($("#inputQuantity").val());
    var maxValue = inputQuantity.max;
    if (value + 1 <= maxValue) {
        $("#inputQuantity").val(value + 1);
    }
});

$(".buttonCart_disconnected").on("click", function () {
    alert("Vous devez vous connecter pour ajouter un article à votre panier.");
});

$(document).ready(function () {
    $(".menu-item").click(function () {
        const target = $(this).data("target");
        $(".menu-item").removeClass("active");
        $(this).addClass("active");
        $(".box").hide();
        $("#" + target).show();
    });
});

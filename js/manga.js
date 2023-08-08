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

$(".buttonCart_disconnected").on("click", function () {
    alert("Vous devez vous connecter pour ajouter un article à votre panier.");
});

$(document).ready(function() {
    // Gérer le clic sur les boutons du menu
    $(".menu-item").click(function() {
        const target = $(this).data("target");
        $(".menu-item").removeClass("active");
        $(this).addClass("active");
        $(".box").hide();
        $("#" + target).show();
    });
});

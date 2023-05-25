var value = $("#imgURL").val();

console.log($("#submitVolume").val());

$("#imgURL").on("input", function () {
    var value = $("#imgURL").val();
    var img = $("#imgPreviewAdd");
    img.attr("src", value);

    img.addEventListener("load", function () {
        if (img.naturalWidth !== 0 && img.naturalHeight !== 0) {
            $("title-picture").style.display = "block";
        } else {
            console.log("L'image n'est pas affichée.");
        }
    });
});
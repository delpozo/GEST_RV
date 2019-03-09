
/**
 * Recherche Admin 
 */
function recherche() {
    $(document).on('click', '#rech', function() {
    var motcle = $("#recherche").val();
    $("#tab_vende").hide();
    $("#loading").show();
    $.ajax({
        type: "GET",
        data: {
            motcle: motcle
        },
        url: "recherche",
        cache: false,
        success: function(data) {
            $("#loading").hide();
            $("#tab_vende").show();
            $('#tab_vende').html(data);
            return false;
        }
    });
    return false;
});
}
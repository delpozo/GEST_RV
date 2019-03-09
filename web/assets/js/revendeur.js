
/**
 * Revendeur
 */
function recherche_select_type_abn_revendeur() {
    var type = $('#categorie').val();
    //console.log(type);
    
    $("#tab_vende").hide();
    $("#loading").show();
    $.ajax({
        type: 'GET',
        data: {
            type: type
        },
        url: 'recherchtype',
        success: function(data) {
            $("#loading").hide();
            $("#tab_vende").show();
            $('#tab_vende').html(data);
            $("#exampleModal").modal('show');
        }
    });
};

function fnachat () {
    var prod=s;
        //var type = $('#categorie').find(':selected')[0].value;
        $("#tab_vende").hide();
        $("#loading").show();
        $.ajax({
            type: 'GET',
            data: {
                prod: prod,
                
            },
            url: 'achat',
            success: function(data) {
                $("#loading").hide();
                $("#tab_vende").show();
                $('#tab_vende').html(data);
                //$("#exampleModalCenter").modal('show');
            }
        });

};

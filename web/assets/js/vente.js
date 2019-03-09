

/**
 * Vente
 */
function rechcredit() {
    $(document).on('click', '#rechcredit', function() {
    $("#tab_vende").hide();
    $("#loading").show();
    $.ajax({
        type: "GET",
        data: {
            motcle: "1"
        },
        url: "rechcredit",
        cache: false,
        success: function(data) {
            $("#loading").hide();
            $("#tab_vende").show();
            $('#tab_vende').html(data);

        }
    });
    return false;
});
}
/**
 * Vente
 */
function rechvendEx() {
    $(document).on('click', '#rechvendEx', function() {
    $("#tab_vende").hide();
    $("#loading").show();
    $.ajax({
        type: "GET",
        data: {
            motcle: "1"
        },
        url: "rechvendEx",
        cache: false,
        success: function(data) {
            $("#loading").hide();
            $("#tab_vende").show();
            $('#tab_vende').html(data);

        }
    });
    return false;
});
}
/**
 * Vente
 */
function rechtypeproduit() {
  $('#typeProduit').change ( function() {
    var motcle = $("#typeProduit").val();
    $("#fournisseurs option[value='2']").attr("selected ", true );
    $("#tab_vende").hide();
    $("#loading").show();
    $.ajax({
        type: "GET",
        data: {
            motcle: motcle
        },
        url: "rechtypeproduit",
        cache: false,
        success: function(data) {
            $("#loading").hide();
            $("#tab_vende").show();
            $('#tab_vende').html(data);
        }
    });
    return false;
});
}

/* function fnachat () {
 
    var revend = $('#appbundle_vende_User').val();
    var revend = $('#appbundle_id_prod').val();
    console.log(revend);
    
        //var type = $('#categorie').find(':selected')[0].value;
        $("#tab_vende").hide();
        $("#loading").show();
        $.ajax({
            type: 'GET',
            data: {
                revend: revend,
            },
            url: '../../vende/new',
            success: function(data) {
                $("#loading").hide();
                $("#tab_vende").show();
                $('#tab_vende').html(data);
                //$("#exampleModalCenter").modal('show');
            }
        });

}; */
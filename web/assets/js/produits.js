
/**
 * Produits
 */
function rechvend() {
    $(document).on('click', '#rechvend', function() {
    $("#tab_vende").hide();
    $("#loading").show();
    $.ajax({
        type: "GET",
        data: {
            motcle: "1"
        },
        url: "rechvend",
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
 * Produits
 */
function rechnonvend() {
    $(document).on('click', '#rechnonvend', function() {
    $("#tab_vende").hide();
    $("#loading").show();
    $.ajax({
        type: "GET",
        data: {
            motcle: 0
        },
        url: "rechvend",
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

var rev;

  function modal_vente_rev(re) {
      rev=re;
      $("#modal_link").attr("onclick", 'fnachat('+re+')');
    $('#Modal_revend').modal('show');
    return false;
}
function produit() {
      $("#tab_vende").hide();
      $("#loading").show();
      $.ajax({
          type: "GET",
          data: {
          },
          url: "../",
          cache: false,
          success: function(data) {
              $("#loading").hide();
              $("#tab_vende").show();
              //$('#tab_vende').html(data);
          }
      });
      return false;
  }
  
  function fnachat (re) {
 
    var revend = $('#appbundle_vende_User').val();
    //var revend = $('#appbundle_id_prod').val();
    //console.log(revend);
    
        //var type = $('#categorie').find(':selected')[0].value;
        $("#tab_vende").hide();
        $("#loading").show();
        location.href = re+'/addvend?revend='+revend;
        

};
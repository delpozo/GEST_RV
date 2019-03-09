/**
 * Ajouter Apareil avec les Checkbox Problem et piece changer
 */
function addappareil() {
    $(document).on('click', '#submit', function() {
     var problem = "";
     var piece = "";
     var accessoir = "";
     var client = $('#appbundle_appareil_client').val();
     var nom = $('#appbundle_appareil_nom').val();
     var etat = $('#appbundle_appareil_etat').val();
     var prix = $('#appbundle_appareil_prix').val();
     var deponse = $('#appbundle_appareil_deponse').val();
     var autre_accessoir = $('#autre_accessoir').val();
     var autre_problem = $('#autre_problem').val();
     var autre_piece = $('#autre_piece').val();

     $(":input:checkbox[name=accessoir]:checked").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            accessoir += $(this).val() + " , ";
        }
    });
        accessoir += autre_accessoir;
     $(":input:checkbox[name=problem]:checked").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            problem += $(this).val() + " , ";
        }
    });
        problem += autre_problem;
    $(":input:checkbox[name=piece]:checked").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            piece += $(this).val() + " , ";
        }
    });
        piece += autre_piece;
    $.ajax({
        type: "GET",
        data: {
            problem: problem,
            nom : nom,
            client : client,
            etat : etat,
            prix : prix,
            piece : piece,
            accessoir : accessoir,
            deponse : deponse
        },
        url: "newappareil",
        cache: false,
        success: function(data) {
            //window.location=''
            location.href = 'admin/appareil/'
            return false;
        }
    });
    return false;
});
}

/**
 * Modifier Apareil avec les Checkbox Problem et piece changer
 */
function editappareil() {
    $(document).on('click', '#update', function() {
     var problem = "";
     var piece = "";
     var accessoir = "";
     var client = $('#appbundle_appareil_client').val();
     var nom = $('#appbundle_appareil_nom').val();
     var etat = $('#appbundle_appareil_etat').val();
     var prix = $('#appbundle_appareil_prix').val();
     var deponse = $('#appbundle_appareil_deponse').val();
     var autre_accessoir = $('#autre_accessoir').val();
     var autre_problem = $('#autre_problem').val();
     var autre_piece = $('#autre_piece').val();

     $(":input:checkbox[name=accessoir]:checked").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            accessoir += $(this).val() + " , ";
        }
    });
        accessoir += autre_accessoir;
     $(":input:checkbox[name=problem]:checked").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            problem += $(this).val() + " , ";
        }
    });
        problem += autre_problem;
    $(":input:checkbox[name=piece]:checked").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            piece += $(this).val() + " , ";
        }
    });
        piece += autre_piece;
    $.ajax({
        type: "GET",
        data: {
            problem: problem,
            nom : nom,
            client : client,
            etat : etat,
            prix : prix,
            piece : piece,
            accessoir : accessoir,
            deponse : deponse
        },
        url: "updateappareil",
        cache: false,
        success: function(data) {
            //window.location=''
            location.href = '/admin/appareil/'
            return false;
        }
    });
    return false;
});
}
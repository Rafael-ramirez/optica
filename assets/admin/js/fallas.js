/**
 * Created by PC2 on 21/06/2017.
 */
//----------------------------------------------------------------------------------------------------------------------
//                              AGREGAR USUARIO
//----------------------------------------------------------------------------------------------------------------------
var table = $('#example1').DataTable();
var base_url = $("#base_url").val();
$("#RegistroUsuarios").submit(function(e){
    e.preventDefault();
    var formData = new FormData($("#RegistroUsuarios")[0]);

    $.ajax({
        type: 'post',
        url: './Cl_Fallas/fallasAdd',
        data: formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,   // tell jQuery not to set contentType
        success: function (data) {
            var result = JSON.parse(data);
            $(".token").val(result.hash);
                /**Se crea el renglon nuevo con los datos que se regresaron al guardar**/
                table.row.add( [
                    result.falla_id,
                    result.fecha,
                    result.nombre,
                    '<button type="button" id="user_'+result.falla_id+'" class="btn btn-danger btn-flat" onclick="showModalDelete('+result.falla_id+', '+"'"+result.nombre+"'"+');" style="margin-right: 3px;"><i class="fa fa-close"></i></button>'
                    +'<button type="button" id="userEdit_'+result.falla_id+'" class="btn btn-primary btn-flat" onclick="showModalUpdate('+result.falla_id+');" data-toggle="modal" data-target="#Editar"><i class="fa fa-edit"></i></button>'
                ] ).draw( false );

                $("#Agregar").modal("hide");
                $("#RegistroUsuarios")[0].reset();
        },
        error: function () {
            alert("Lo sentimos, algo salió mal al intentar guardar los datos, favor de volver a intentarlo");
        }
    });
});



/**
 * Agregamos el id del boton para ponerselo al modal de borrar
 * Y abrimos el modal.
 */
//----------------------------------------------------------------------------------------------------------------------
//                             ABRIR MODAL DE BORRAR
//----------------------------------------------------------------------------------------------------------------------
function showModalDelete(id,user){
    $("#id_borrar").val(id);
    $("#Nombre_usuario").html(user);
    $("#Borrar").modal("show");
}

/**
 * Tomamos el valor del id del usuario del modal que abrimos y lo ponemos en la variable tr
 */
//----------------------------------------------------------------------------------------------------------------------
//                              BORRAR USUARIO
//----------------------------------------------------------------------------------------------------------------------
function userDelete() {
    var tr = $("#id_borrar").val()
    var token = $(".token").val();

    $.ajax({
        type: 'post',
        url: './Cl_Fallas/userDelete',
        data: {falla_id: tr, csrf_ars: token},
        success:function (data) {
            var result = JSON.parse(data);
            $(".token").val(result.hash);
            /**
             Borramos el renglon, basandonos en el id que tiene el boton Eliminar
             * */
            table
                .row( $("#user_"+tr).parent().parent() )
                .remove()
                .draw();
            $("#Borrar").modal("hide");
        },
        error:function () {
            alert("Lo sentimos, algo salió mal al intentar borrar los datos, favor de volver a intentarlo");
        }
     });
}
//----------------------------------------------------------------------------------------------------------------------
//                              ABRIR MODAL DE EDITAR
//----------------------------------------------------------------------------------------------------------------------
function showModalUpdate(id){
    $.ajax({
        type: 'get',
        url: './Cl_Fallas/fallaGet',
        data: {falla_id: id},
        success: function (data) {
            var result = JSON.parse(data);
            $("#EditarUsuarios").find("#id_editar").val(id);
            $("#EditarUsuarios").find("input[name='nombre']").val(result.fallas.nombre);
            $("#Editar").modal("show");
        }
    });
}
//----------------------------------------------------------------------------------------------------------------------
//                              EDITAR USUARIO
//----------------------------------------------------------------------------------------------------------------------
$("#EditarUsuarios").submit(function (e) {
    e.preventDefault();
    var formData = new FormData($("#EditarUsuarios")[0]);
    var id = $("#id_editar").val();
    
    $.ajax({
        type: 'post',
        url: './Cl_Fallas/fallaUpdate',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            var result = JSON.parse(data);
            $(".token").val(result.hash);
            /**
             *SE ELIMINA RENGLON DE TABLA
             * */
            table
                .row( $("#user_"+id).parent().parent() )
                .remove()
                .draw();
            /**
             * SE CREA NUEVAMENTE EL RENGLON ACTUALIZAQDO
             * */
            table.row.add( [
                result.falla_id,
                result.fecha,
                result.nombre,
                '<button type="button" id="user_'+result.falla_id+'" class="btn btn-danger btn-flat" onclick="showModalDelete('+result.falla_id+', '+"'"+result.nombre+"'"+');" style="margin-right: 3px;"><i class="fa fa-close"></i></button>'
                +'<button type="button" id="userEdit_'+result.falla_id+'" class="btn btn-primary btn-flat" onclick="showModalUpdate('+result.falla_id+');"><i class="fa fa-edit"></i></button>'
            ] ).draw( false );

            $("#Editar").modal("hide");
        },
        error: function () {
            alert("Lo sentimos, algo salió mal al intentar guardar los datos, favor de volver a intentarlo");;
        }
        
    });
});

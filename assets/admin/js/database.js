/**
 * Created by PC2 on 21/06/2017.
 */
//----------------------------------------------------------------------------------------------------------------------
//                              AGREGAR USUARIO
//----------------------------------------------------------------------------------------------------------------------
var table = $('#example1').DataTable();
var base_url = $("#base_url").val();
$("#busquedaForm").submit(function(e){
    e.preventDefault();
    var fechaDesde = $("#fechaDesde").val();
    var fechaHasta = $("#fechaHasta").val();
    var token = $("#token").val();


    $.ajax({
        type: 'post',
        url: './Cl_Database/serviciosGet',
        data: { fecha_desde: fechaDesde, fecha_hasta: fechaHasta, csrf_ars: token },
        success: function (data) {
            var result = JSON.parse(data);
             $("#token").val(result.hash);
                /**Se crea el renglon nuevo con los datos que se regresaron al guardar**/
            table.clear();
            $.each(result.servicios , function (key, val) {
                console.log(val.servicio);
                table.row.add([
                    val.id_servicio,
                    val.fecha,
                    val.servicio,
                    val.planta,
                    val.proveedor,
                    val.condicion,
                    val.parte
                ]).draw( false );
            });

           // $("#busquedaForm")[0].reset();
        },
        error: function () {
            alert("Lo sentimos, algo salió mal al intentar guardar los datos, favor de volver a intentarlo");
        }
    });
});

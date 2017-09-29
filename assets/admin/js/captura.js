/**
 * Created by PC2 on 21/06/2017.
 */
//----------------------------------------------------------------------------------------------------------------------
//                              AGREGAR SERVICIO
//----------------------------------------------------------------------------------------------------------------------
var table = $('#example1').DataTable();
var base_url = $("#base_url").val();
$("#RegistroServicio").submit(function(e){
    e.preventDefault();
    var formData = new FormData($("#RegistroServicio")[0]);
    $.ajax({
        type: 'post',
        url: './Cl_captura/servicio_add',
        data: formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,   // tell jQuery not to set contentType
        success: function (data) {
            var result = JSON.parse(data);
            $(".token").val(result.hash);
                /**Se crea el renglon nuevo con los datos que se regresaron al guardar**/
                table.row.add( [
                    result.id,
                    result.fecha,
                    result.servicio,
                    result.sucursal,
                    '<a href="#" class="btn btn-primary btn-flat" style="margin-right: 3px;">Captura</a>'+
                    '<button type="button" id="servicio_id'+result.id+'" class="btn btn-primary btn-flat" onclick="showModalUpdate('+result.id+');" data-toggle="modal" data-target="#Editar"><i class="fa fa-edit"></i></button>'
                ] ).draw( false );

                $("#Agregar").modal("hide");
                $("#RegistroServicio")[0].reset();
        },
        error: function () {
            alert("Lo sentimos, algo salió mal al intentar guardar los datos, favor de volver a intentarlo");
        }
    });
});

//----------------------------------------------------------------------------------------------------------------------
//                              ABRIR MODAL DE EDITAR
//----------------------------------------------------------------------------------------------------------------------
function showModalUpdate(id){
    $.ajax({
        type: 'get',
        url: './Cl_captura/servicio_get',
        data: {id_servicio: id},
        success: function (data) {
            var result = JSON.parse(data);
            $("#EditarServicio").find("#id_editar").val(id);
            $("#EditarServicio").find("input[name='servicio']").val(result.servicio.servicio);
            $("#EditarServicio").find("select[name='sucursal']").val(result.servicio.sucursal).change();
            $("#EditarServicio").find("select[name='tipo_servicio']").val(result.servicio.tipo_servicio).change();
            $("#EditarServicio").find("input[name='cant_servicio']").val(result.servicio.cantidad_servicio);
            $("#EditarServicio").find("input[name='cant_autorizada']").val(result.servicio.cantidad_autorizada);

            if(result.servicio.cantidad_tipo == 1) {
                $("#EditarServicio").find("input[name='cant_type']")[0].checked = true;
            }else{
                $("#EditarServicio").find("input[name='cant_type']")[1].checked = true;
            }
            $("#EditarServicio").find("select[name='planta']").val(result.servicio.planta).change();
            $("#EditarServicio").find("select[name='proveedor']").val(result.servicio.proveedor).change();
            $("#EditarServicio").find("select[name='condicion']").val(result.servicio.condicion).change();
            $("#EditarServicio").find("select[name='parte']").val(result.servicio.parte).change();
            $("#Editar").modal("show");
        }
    });
}
//----------------------------------------------------------------------------------------------------------------------
//                              EDITAR SERVICIO
//----------------------------------------------------------------------------------------------------------------------
$("#EditarServicio").submit(function (e) {
    e.preventDefault();
    var formData = new FormData($("#EditarServicio")[0]);
    var id = $("#id_editar").val();

    $.ajax({
        type: 'post',
        url: './Cl_captura/serviceUpdate',
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
                .row( $("#servicio_id"+id).parent().parent() )
                .remove()
                .draw();
            /**
             * SE CREA NUEVAMENTE EL RENGLON ACTUALIZAQDO
             * */
            table.row.add( [
                result.id,
                result.fecha,
                result.servicio,
                result.sucursal,
                '<a href="./Cl_captura/capturasGet/'+result.id+'/'+result.servicio+'" class="btn btn-primary btn-flat" style="margin-right: 3px;">Captura</a>'+
              '<button type="button" id="servicio_id'+result.id+'" class="btn btn-primary btn-flat" onclick="showModalUpdate('+result.id+');"><i class="fa fa-edit"></i></button>'
            ] ).draw( false );

            $("#Editar").modal("hide");
        },
        error: function () {
            alert("Lo sentimos, algo salió mal al intentar guardar los datos, favor de volver a intentarlo");;
        }

    });
});

//----------------------------------------------------------------------------------------------------------------------
//                              CAPTURA
//----------------------------------------------------------------------------------------------------------------------
$("#frm-captura").submit(function (e) {
    e.preventDefault();
    //variables de la captura
    var id_servicio = $("#id_servicio").val();
    var pallets = $("input[name='pallets']").val();
    var lp = $("input[name='lp']").val();
    var inspector = $("select[name='inspector']").val();
    var fecha = $("input[name='fecha']").val();
    var turno = $("select[name='turno']").val();
    var tmuerto = $("input[name='tmuerto']").val();
    var hinicio = $("input[name='hinicio']").val();
    var htermino = $("input[name='htermino']").val();
    var htotal = $("input[name='htotal']").val();
    var token = $("#token").val();
    var bandera = false;
    var bandera2 = false;
    var expr = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;

    //valida campos vacios
    $(".valida").each(function(){
      if($(this).val() == ""){
        $(this).css("border", "2px solid red");
        bandera = true;
      }
    });
    if(bandera == true){
      return false;
    }
    if(!expr.test(hinicio.trim())){
        $("#hinicio").css("border", "2px solid red");
        alert("Formato de hora incorrecto");
        return false;
    }
    if(!expr.test(htermino.trim())){
        $("#htermino").css("border", "1px solid #ccc");
        alert("Formato de hora incorrecto");
        return false;
    }
    //variables de tabla arrays
    var parteArr = new Array();
    var serieArr = new Array();
    var fechaArr = new Array();
    var loteArr = new Array();
    var inspeccionadasArr = new Array();
    var rechazadasArr = new Array();
    var retrabajadasArr = new Array();
    var okArr = new Array();
    var descripcionArr = new Array();

    // recorre los renglones
    $(".tr-form").each(function () {
        var parte = $(this).find("#parte").val();
        var serie = $(this).find("#serie").val();
        var fecha = $(this).find("#fecha").val();
        var lote = $(this).find("#lote").val();
        var inspeccionadas = $(this).find("#inspeccionadas").val();
        var rechazadas = $(this).find("#rechazadas").val();
        var retrabajadas = $(this).find("#retrabajadas").val();
        var ok = $(this).find("#ok").val();
        var descripcion = $(this).find("#descripcion").val();

      //valida todos los campos llenos
      if(parte != "" && serie != "" && fecha != "" && lote != "" && inspeccionadas != "" && rechazadas != ""
          && ok != "")
      {
        //ingresa datos en los arreglos
        parteArr.push(parte);
        serieArr.push(serie);
        fechaArr.push(fecha);
        loteArr.push(lote);
        inspeccionadasArr.push(inspeccionadas);
        rechazadasArr.push(rechazadas);
        retrabajadasArr.push(retrabajadas);
        okArr.push(ok);
          if(descripcion == ""){
              descripcionArr.push(0);
          }
          else {
              descripcionArr.push(descripcion);
          }
      }
      //verifica si alguno no esta vacio
      else if(parte != "" || serie != "" || fecha != "" || lote != "" || inspeccionadas != "" || rechazadas != ""
          || ok != "" || descripcion != "")
          {
            //recorre todos los campos del renglon
            $(this).find(".validate").each(function(){
                var mensaje = $(this).val();
              //alert(mensaje);
              //si uno esta vacio cambia de color
                if(mensaje == ""){
                  $(this).css("border", "2px solid red");
                  //return false;
                    bandera2 = true;
                }
            });
            //se cancela el proceso si encuentra uno que no esta vacio
              //alert(bandera2);
            return false;
          }
    });
    //Fin validacion, ejecutar ajax para guardar
    if(bandera2 != true) {
        var datos = {
            id_servicio: id_servicio,
            pallets: pallets,
            lp: lp,
            inspector: inspector,
            fecha: fecha,
            turno: turno,
            tmuerto: tmuerto,
            hinicio: hinicio,
            htermino: htermino,
            htotal: htotal,
            parteArr: parteArr,
            serieArr: serieArr,
            fechaArr: fechaArr,
            loteArr: loteArr,
            inspeccionadasArr: inspeccionadasArr,
            rechazadasArr: rechazadasArr,
            retrabajadasArr: retrabajadasArr,
            okArr: okArr,
            descripcionArr: descripcionArr,
            csrf_ars: token
        };
        $.ajax({
            type: 'post',
            url: base_url + 'Cl_captura/captura_add',
            data: datos,
            success: function (data) {
                var result = JSON.parse(data);
                $("#token").val(result.hash);
                $(".form-control").css("border", "1px solid #ccc");
                alert("Registro Guardado");
                $("#frm-captura")[0].reset();
            }
        });
    }
});
//----------SUMA PARA TODOS LOS PUTOS TOTALES ALV-------
$(document).ready(function () {
    totales('inspeccionadas');
    totales('rechazadas');
    totales('retrabajadas');
    totales('ok');
});
function totales(campo){
    var total = 0;
    var cantidad;
    $("." + campo).each(function () {
        if($(this).val() == ""){
            cantidad = 0;
            //alert("valida");
        }else {
            cantidad = $(this).val();
        }
        total += parseInt(cantidad);
    });
    $("#td-"+campo).html(total);
}

function resta_ok(tr){
    $("."+tr+"-form").each(function () {
       var inspecionadas = parseInt($(this).find("#inspeccionadas").val());
       var rechazadas = parseInt($(this).find("#rechazadas").val());
       var total = inspecionadas - rechazadas;
       if(isNaN(total)){
           $(this).find("#ok").val('');
       }
       else {
           $(this).find("#ok").val(total);
           totales("ok");
       }
    });
}

function horas(campo){
   var inicio  = $("#hinicio").val();
   var termino = $("#htermino").val();
   var arr_inicio = inicio.split(":");
   var arr_termino = termino.split(":");
   var expr = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
   var hora_valida = $("#"+campo).val();

   if(!expr.test(hora_valida.trim())){
       //alert("hora inicio invalida");
       $("#"+campo).css("border", "2px solid red");
   }else{
       $("#"+campo).css("border", "1px solid #ccc");
   }
    var horas = arr_termino[0] - arr_inicio[0];
    var minutos = arr_termino[1] - arr_inicio[1];

        if(horas == ""){
            horas = 0;
        }
        if(isNaN(minutos)){
            minutos = 0;
            //alert("vac");
        }
        $("#htotal").val(horas + '.' + minutos);

}


/**
 * Agregamos el id del boton para ponerselo al modal de borrar
 * Y abrimos el modal.
 */
//----------------------------------------------------------------------------------------------------------------------
//                             ABRIR MODAL DE BORRAR
//----------------------------------------------------------------------------------------------------------------------
function showModalDelete(id){
    $("#id_borrar").val(id);
    $("#reporte_num").html(id);
    $("#Borrar").modal("show");
}
/**
 * Tomamos el valor del id del usuario del modal que abrimos y lo ponemos en la variable tr
 */
//----------------------------------------------------------------------------------------------------------------------
//                              BORRAR USUARIO
//----------------------------------------------------------------------------------------------------------------------
function reporteDelete() {
    var tr = $("#id_borrar").val()
    var token = $(".token").val();

    $.ajax({
        type: 'post',
        url: base_url + 'Cl_captura/reporteDelete',
        data: {reporte_id: tr, csrf_ars: token},
        success:function (data) {
            var result = JSON.parse(data);
            $(".token").val(result.hash);
            /**
             Borramos el renglon, basandonos en el id que tiene el boton Eliminar
             * */
            table
                .row( $("#reporte_"+tr).parent().parent() )
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
//                              CAPTURA
//----------------------------------------------------------------------------------------------------------------------
$("#frm-captura-edit").submit(function (e) {
    e.preventDefault();
    //variables de la captura
    var id_reporte = $("#id_reporte").val();
    var pallets = $("input[name='pallets']").val();
    var lp = $("input[name='lp']").val();
    var inspector = $("select[name='inspector']").val();
    var fecha = $("input[name='fecha']").val();
    var turno = $("select[name='turno']").val();
    var tmuerto = $("input[name='tmuerto']").val();
    var hinicio = $("input[name='hinicio']").val();
    var htermino = $("input[name='htermino']").val();
    var htotal = $("input[name='htotal']").val();
    var token = $("#token").val();
    var bandera = false;
    var bandera2 = false;
    var bandera3 = false;
    var expr = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;

    //valida campos vacios
    $(".valida").each(function(){
        if($(this).val() == ""){
            $(this).css("border", "2px solid red");
            bandera = true;
        }
    });
    if(bandera == true){
        return false;
    }
    if(!expr.test(hinicio.trim())){
        $("#hinicio").css("border", "2px solid red");
        alert("Formato de hora incorrecto");
        return false;
    }
    if(!expr.test(htermino.trim())){
        $("#htermino").css("border", "1px solid #ccc");
        alert("Formato de hora incorrecto");
        return false;
    }
    //variables de tabla arrays
    var parteArr = new Array();
    var serieArr = new Array();
    var fechaArr = new Array();
    var loteArr = new Array();
    var inspeccionadasArr = new Array();
    var rechazadasArr = new Array();
    var retrabajadasArr = new Array();
    var okArr = new Array();
    var descripcionArr = new Array();

    // recorre los renglones
    $(".tr-form").each(function () {
        var parte = $(this).find("#parte").val();
        var serie = $(this).find("#serie").val();
        var fecha = $(this).find("#fecha").val();
        var lote = $(this).find("#lote").val();
        var inspeccionadas = $(this).find("#inspeccionadas").val();
        var rechazadas = $(this).find("#rechazadas").val();
        var retrabajadas = $(this).find("#retrabajadas").val();
        var ok = $(this).find("#ok").val();
        var descripcion = $(this).find("#descripcion").val();

        //valida todos los campos llenos
        if(parte != "" && serie != "" && fecha != "" && lote != "" && inspeccionadas != "" && rechazadas != ""
            && ok != "")
        {
            //ingresa datos en los arreglos
            parteArr.push(parte);
            serieArr.push(serie);
            fechaArr.push(fecha);
            loteArr.push(lote);
            inspeccionadasArr.push(inspeccionadas);
            rechazadasArr.push(rechazadas);
            retrabajadasArr.push(retrabajadas);
            okArr.push(ok);
            if(descripcion == ""){
                descripcionArr.push(0);
            }
            else {
                descripcionArr.push(descripcion);
            }
        }
        //verifica si alguno no esta vacio
        else if(parte != "" || serie != "" || fecha != "" || lote != "" || inspeccionadas != "" || rechazadas != ""
            || ok != "" || descripcion != "")
        {
            //recorre todos los campos del renglon
            $(this).find(".validate").each(function(){
                var mensaje = $(this).val();
                //alert(mensaje);
                //si uno esta vacio cambia de color
                if(mensaje == ""){
                    $(this).css("border", "2px solid red");
                    //return false;
                    bandera2 = true;
                }
            });
            //se cancela el proceso si encuentra uno que no esta vacio
            //alert(bandera2);
            return false;
        }
    });

    //variables de tabla2 arrays
    var id_serieArr = new Array();
    var parteArr2 = new Array();
    var serieArr2 = new Array();
    var fechaArr2 = new Array();
    var loteArr2 = new Array();
    var inspeccionadasArr2 = new Array();
    var rechazadasArr2 = new Array();
    var retrabajadasArr2 = new Array();
    var okArr2 = new Array();
    var descripcionArr2 = new Array();

    // recorre los renglones
    $(".tr2-form").each(function () {
        var id_serie = $(this).find("#id_serie").val();
        var parte = $(this).find("#parte").val();
        var serie = $(this).find("#serie").val();
        var fecha = $(this).find("#fecha").val();
        var lote = $(this).find("#lote").val();
        var inspeccionadas = $(this).find("#inspeccionadas").val();
        var rechazadas = $(this).find("#rechazadas").val();
        var retrabajadas = $(this).find("#retrabajadas").val();
        var ok = $(this).find("#ok").val();
        var descripcion = $(this).find("#descripcion").val();

        //valida todos los campos llenos
        if(parte != "" && serie != "" && fecha != "" && lote != "" && inspeccionadas != "" && rechazadas != ""
            && ok != "")
        {
            //ingresa datos en los arreglos
            id_serieArr.push(id_serie);
            parteArr2.push(parte);
            serieArr2.push(serie);
            fechaArr2.push(fecha);
            loteArr2.push(lote);
            inspeccionadasArr2.push(inspeccionadas);
            rechazadasArr2.push(rechazadas);
            retrabajadasArr2.push(retrabajadas);
            okArr2.push(ok);
            if(descripcion == ""){
                descripcionArr2.push(0);
            }
            else {
                descripcionArr2.push(descripcion);
            }
        }
        //verifica si alguno no esta vacio
        else if(parte != "" || serie != "" || fecha != "" || lote != "" || inspeccionadas != "" || rechazadas != ""
            || ok != "" || descripcion != "")
        {
            //recorre todos los campos del renglon
            $(this).find(".validate").each(function(){
                var mensaje = $(this).val();
                //alert(mensaje);
                //si uno esta vacio cambia de color
                if(mensaje == ""){
                    $(this).css("border", "2px solid red");
                    //return false;
                    bandera3 = true;
                }
            });
            //se cancela el proceso si encuentra uno que no esta vacio
            //alert(bandera2);
            return false;
        }
    });

    //Fin validacion, ejecutar ajax para guardar
    if(bandera2 != true && bandera3 != true) {
        var datos = {
            id_reporte: id_reporte,
            pallets: pallets,
            lp: lp,
            inspector: inspector,
            fecha: fecha,
            turno: turno,
            tmuerto: tmuerto,
            hinicio: hinicio,
            htermino: htermino,
            htotal: htotal,
            //variables para agregar
            parteArr: parteArr,
            serieArr: serieArr,
            fechaArr: fechaArr,
            loteArr: loteArr,
            inspeccionadasArr: inspeccionadasArr,
            rechazadasArr: rechazadasArr,
            retrabajadasArr: retrabajadasArr,
            okArr: okArr,
            descripcionArr: descripcionArr,

            //variables para editar
            id_serieArr: id_serieArr,
            parteArr2: parteArr2,
            serieArr2: serieArr2,
            fechaArr2: fechaArr2,
            loteArr2: loteArr2,
            inspeccionadasArr2: inspeccionadasArr2,
            rechazadasArr2: rechazadasArr2,
            retrabajadasArr2: retrabajadasArr2,
            okArr2: okArr2,
            descripcionArr2: descripcionArr2,

            csrf_ars: token
        };
        $.ajax({
            type: 'post',
            url: base_url + 'Cl_captura/editarCapturaPost',
            data: datos,
            success: function (data) {
                var result = JSON.parse(data);
                $("#token").val(result.hash);
                $(".form-control").css("border", "1px solid #ccc");
                alert("Registro actualizado");
                location.reload();
                // $("#frm-captura-edit")[0].reset();
            }
        });
    }
});
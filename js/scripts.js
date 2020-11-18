const URL_CLIENTE = 'includes/modelos/modelo-cliente.php';



$(document).ready(function(){
    $(document).on('click.Buscar', '.js-caja-busqueda',buscarCliente);   
     //agregar una tarea
    $(document).on('click.nuevo-cliente','.js-caja-cliente',agregarCliente);
    // botones para las acciones de las tareas
    $(document).on('click.accion','.js-caja-actualizar',actualizarCliente);
    
});

function buscarCliente(event){
    event.preventDefault();

    let cedula = $('#busqueda').val();
    console.log(cedula);
    //datos a enviar 
    var datos = {
        'busqueda':cedula,
        'accion':'buscar'
    };

    // preparando el ajax
    let ajaxJQUERY = $.ajax({
        'type':'POST',
        'url' : URL_CLIENTE,
        'data': datos
    });

    ajaxJQUERY.done(function(data, textStatus, jqXHR){
        if ( jqXHR.status==200) {
            // obtener datos respuesta

            let respuesta = JSON.parse(ajaxJQUERY.responseText);
            console.log(respuesta);
            $('#cedula').val(respuesta.cedula);
            $('#nombre').val(respuesta.nombre);
            $('#apellidos').val(respuesta.apellidos);
            $('#celular').val(respuesta.celular);
            $('#correo').val(respuesta.correo);
            $('#marca').val(respuesta.marca);
            $('#numero').val(respuesta.numero);
            $('#fecha').val(respuesta.fecha);
            $('#codigo').val(respuesta.codigo);

            let proyecto = respuesta.nombre_proyecto,
                id_proyecto = respuesta.id_insertado,
                tipo = respuesta.tipo,
                resutado= respuesta.respuesta;

            // comprobar la insercion
            if(resutado === 'correcto'){
                // fue exitoso
                if(tipo === 'crear'){
                    let nuevoPoyecto = document.createElement('li');
                        nuevoPoyecto.innerHTML =`
                                <a href='index.php?id_proyecto=${id_proyecto}' id="Proyecto:${id_proyecto}">
                                        ${proyecto}
                                </a>
                        `;
                        listaProyectos.append(nuevoPoyecto);
                        swal("Proyecto Creado", "El proyecto: "+proyecto+" se creó correctamente", 
                        "success").then(resultado => {
                            //redireccionando
                            if(resultado.value){
                                window.location.href = 'index.php?id_proyecto='+ id_proyecto;
                            }
                        })

                        
                        
                }else{
                     
                }

                
                
            }else{
                swal('Error', 'La cedula ingresada no se encuentra en el sistema', "error");
            }
        }
    });  
}

 function agregarCliente(event){
    event.preventDefault();
    //validar que el campo tenga algo escrito
    let cedula    = $('#cedula').val();
    let nombre    = $('#nombre').val();
    let apellidos = $('#apellidos').val();
    let celular   = $('#celular').val();
    let correo    = $('#correo').val();
    let marca     = $('#marca').val();
    let numero    = $('#numero').val();
    let fecha     = $('#fecha').val();
    let codigo    = $('#codigo').val();


        if(cedula === '' || nombre === '' || apellidos === '' || celular === '' || correo === '' || marca ==='' ||numero === '' || fecha === '' || codigo === ''){
            swal('Campos vacio', 'Por favor revise ', "warning");
        }else{
            //insertar la cliente
            let datos = {
                "cedula":cedula,
                "nombre":nombre,
                "apellidos":apellidos,
                "celular":celular,
                "correo":correo,
                "marca":marca,
                "numero":numero,
                "fecha":fecha,
                "codigo":codigo,
                "accion":"crear"
            } 
            
            let ajaxJquery= $.ajax({
                type: 'POST',
                url: URL_CLIENTE,
                data: datos
            });

            ajaxJquery.done(function(data, textStatus, jqXHR){
                if ( jqXHR.status===200) {
                    let respuesta = JSON.parse(ajaxJquery.responseText);
                    
                        if(respuesta.respuesta === 'correcto'){
                            console.log(respuesta);
                            // se agrego la tarea correctamente
                            if(respuesta.tipo === 'crear'){
                                //lanzar alerta
                                $('input[type="text"]').val('');
                                $('input[type="email"]').val('');
                                $('input[type="tel"]').val('');
                                $('input[type="search"]').val('');
                                $('input[type="date"]').val('');

                                swal("Cliente creado", "El cliente "+respuesta.cliente+" ha sido creada correctamente", "success");
                            }
                        }else if(respuesta.respuesta === 'repetido'){
                            swal("Cliente repetido", "El cliente ya se encuentra registrado", "warning");
                        }else{
                            //hubo un error
                            swal("Error", "verifique el campo", "error")
                        }
                }
            });
        }
    
 }

 function actualizarCliente(event){
     event.preventDefault();
    //validar que el campo tenga algo escrito
    let cedula    = $('#cedula').val();
    let nombre    = $('#nombre').val();
    let apellidos = $('#apellidos').val();
    let celular   = $('#celular').val();
    let correo    = $('#correo').val();
    let marca     = $('#marca').val();
    let numero    = $('#numero').val();
    let fecha     = $('#fecha').val();
    let codigo    = $('#codigo').val();


        if(cedula === '' || nombre === '' || apellidos === '' || celular === '' || correo === '' || marca ==='' ||numero === '' || fecha === '' || codigo === ''){
            swal('Campos vacio', 'Por favor revise ', "warning");
        }else{
            //insertar la cliente
            let datos = {
                "cedula":cedula,
                "nombre":nombre,
                "apellidos":apellidos,
                "celular":celular,
                "correo":correo,
                "marca":marca,
                "numero":numero,
                "fecha":fecha,
                "codigo":codigo,
                "accion":"actualizar"
            } 
            
            let ajaxJquery= $.ajax({
                type: 'POST',
                url: URL_CLIENTE,
                data: datos
            });

            ajaxJquery.done(function(data, textStatus, jqXHR){
                if ( jqXHR.status===200) {
                    let respuesta = JSON.parse(ajaxJquery.responseText);
                    
                        if(respuesta.respuesta === 'correcto'){
                            console.log(respuesta);
                            // se agrego la tarea correctamente
                            if(respuesta.tipo === 'actualizar'){
                                //lanzar alerta
                                $('input[type="text"]').val('');
                                $('input[type="email"]').val('');
                                $('input[type="tel"]').val('');
                                $('input[type="search"]').val('');
                                $('input[type="date"]').val('');

                                swal("Cliente actualizado", "El cliente "+respuesta.cliente+" ha sido actualizado correctamente", "success");
                            }
                        }else if(respuesta.respuesta === 'noExiste'){
                            swal("Cliente no existe", "El cliente no existe por lo tanto no puede ser actualizado", "warning");
                        }else{
                            //hubo un error
                            swal("Error", "verifique el campo", "error")
                        }
                }
            });
        }

 }
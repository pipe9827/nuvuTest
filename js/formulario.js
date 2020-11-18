const URL_VALIDATE_LOGIN = 'includes/modelos/modelo-admin.php';
$(document).ready(function(){
    $(document).on('submit.form-login', '.js-caja-login', validarRegistroJQUERY);
});

function validarRegistroJQUERY(event){
    event.preventDefault();
    let formLogin = $(event.target);
    console.log(formLogin);
    console.log(formLogin.serialize());

    if ( formLogin.find('#usuario').val()==='' || formLogin.find('#password').val()==='' ) {
        swal("Error", "Ambos campos son obligatorios", "error");
        return;
    }

    if ( formLogin.find('#tipo').val()==='' ) {
        throw new Exception('Error en el tipo de envio');
        return;
    }

    let ajaxJQUERY = $.ajax({
        'type' : 'POST',
        'url'  : URL_VALIDATE_LOGIN,
        'data' : formLogin.serialize(), 
    });

    ajaxJQUERY.done(function(data, textStatus, jqXHR){
        if ( jqXHR.status==200) {
            let respuesta = JSON.parse(data);

            // verificar si la respuesta es correcta
            if(respuesta.respuesta === 'correcto'){
                // si es un nuevo usuario 
                console.log(respuesta);
                if(respuesta.tipo === 'crear'){
                    swal("Usuario creado", "El usuario ha sido creado correctamente", "success");
                }else if(respuesta.tipo === 'login'){
                    // si es un acceso por login 
                    swal("Credenciales validas", "Presiona OK y aplicación procedera a desplegarse ", "success")
                    .then(resultado => {
                        if(resultado.value){
                            window.location.href = 'index.php';
                        }
                    })
                }
            }
            else{
                
            }
        }
    });

    ajaxJQUERY.fail(function(jqXHR, textStatus, errorThrown){
        let resultado = JSON.parse(jqXHR.responseText);

        swal(resultado.error, '', "error");
    });

    
}   
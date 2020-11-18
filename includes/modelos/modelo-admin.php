<?php
//importar la conexion
include '../funciones/conexion.php';
$accion = $_POST['tipo'];
$password = $_POST['password'];
$usuario = $_POST['usuario'];

    if($accion === 'crear'){
        // codigo para crear administradores
        //hashear passwords
        $opciones = array(
            'cost' => 12
        );

        $hashPassword = password_hash($password, PASSWORD_BCRYPT, $opciones);
        $respuesta = array(
            'pass' => $hashPassword
        );
        

        try{
            //realizar consulta
            $stmt = $conn->prepare("INSERT INTO usuarios (usuario,password) VALUES (?,?)");
            $stmt->bind_param('ss', $usuario, $hashPassword);
            $stmt->execute();

            if($stmt->affected_rows>0){
                $respuesta= array(
                    'respuesta'=> 'correcto',
                    'id_insertado'=> $stmt->insert_id,
                    'tipo'=> $accion
                );

            }else{
                $respuesta= array(
                    'respuesta'=> 'error'
                );
            }

            $stmt->close();
            $conn->close();
            
        }catch(Exception $e){
            // en caso de un error tomar la excepcion 
            
            $respuesta = array(
                'pass' => $e->getMessage()
            );
        }

        echo json_encode($respuesta);
        
    }

    if($accion === 'login'){
        // codigo para ingresar a la app
    
        try{
            //seleccionar admin de la BD
            $stmt= $conn->prepare("SELECT * FROM usuarios WHERE usuario= ?");
            $stmt->bind_param("s",$usuario) ;
            $stmt->execute();
            //loguear usuario
            $stmt->bind_result($id_usuario, $nombre_usuario, $password_usuario);
            $stmt->fetch();
            if($nombre_usuario){
                //nombre de usuario existe, verificar password
                if(password_verify($password,$password_usuario)){
                    // Iniciar la sesion 

                    session_start();
                    $_SESSION['nombre']= $usuario;
                    $_SESSION['id']= $id_usuario;
                    $_SESSION['login']= true;
                    

                    //login correcto
                    $respuesta = array(
                        'respuesta' => 'correcto',
                        'nombre' => $nombre_usuario,
                        'tipo' => $accion,
                        'token' => sha1(uniqid(rand(),true))
                    );
                    //se guarda el token tanto en el cliente como en el servidor y la sesion durara 30 min
                    setcookie("token",$respuesta['token'],time()+(60*30),'/');
                    $_SESSION['token']=$respuesta['token'];

                }else{
                    setcookie("token","",time()-1,'/');
                    header('HTTP/1.1 401 Unauthorized');
                    $respuesta = array(
                        'error'=>'Contraseña incorrecta'
                    );
                    die(json_encode($respuesta));
                }
            }else{
                setcookie("token","",time()-1,'/');
                header('HTTP/1.1 401 Unauthorized');
                $respuesta = array(
                    'error'=> 'Usuario no existe'
                );
                die(json_encode($respuesta));
            }

            $stmt->close();
            $conn->close();
        }catch(Exception $e){
            // en caso de un error tomar la excepcion 
            header('HTTP/1.1 500 '+$e->getMessage());
            die;
        }

        header('HTTP/1.1 200 OK');
        exit(json_encode($respuesta));

    }
?>
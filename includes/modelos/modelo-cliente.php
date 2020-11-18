<?php

    if ( isset($_POST['cedula']) ) $cedula =$_POST['cedula'];
    if ( isset($_POST['nombre']) ) $nombre =$_POST['nombre'];
    if ( isset($_POST['apellidos']) ) $apellidos =$_POST['apellidos'];
    if ( isset($_POST['celular']) ) $celular =$_POST['celular'];
    if ( isset($_POST['correo']) ) $correo =$_POST['correo'];
    if ( isset($_POST['marca']) ) $marca =$_POST['marca'];
    if ( isset($_POST['numero']) ) $numero =$_POST['numero'];
    if ( isset($_POST['fecha']) ) $fecha =$_POST['fecha'];
    if ( isset($_POST['codigo']) ) $codigo =$_POST['codigo'];
    if ( isset($_POST['accion']) ) $accion =$_POST['accion'];
    if ( isset($_POST['busqueda']) ) $busqueda =$_POST['busqueda'];
    

    switch ($accion) {
        case 'crear':
            include '../funciones/conexion.php';
            try{
                $comprobar_id = $conn->prepare("SELECT nombre FROM clientes Where cedula = ?");
                $comprobar_id->bind_param('s',$cedula);
                $comprobar_id->execute();

                while(mysqli_stmt_fetch($comprobar_id)){

                }
                if($comprobar_id->num_rows > 0){
                    $respuesta= array(
                        'respuesta'=> 'repetido'
                    );
                }else{
                    try{
                        $stmt = $conn->prepare("INSERT INTO clientes (cedula,nombre,apellidos,celular,correo,marca,numero,fecha_expiracion,cvv) VALUES (?,?,?,?,?,?,?,?,?)");
                                if($stmt === false){
                                    $respuesta= array(
                                        'respuesta'=> 'error'
                                );
                            }else{
                                $stmt->bind_param('sssssssss', $cedula,$nombre,$apellidos,$celular,$correo,$marca,$numero,$fecha,$codigo);
                                $stmt->execute();
                                if($stmt->affected_rows > 0){
                                    $respuesta = array(
                                        'respuesta'=>'correcto',
                                        'id_insertado'=>$stmt->insert_id,
                                        'tipo'=>$accion,
                                        'cliente'=> $nombre
                                    );
                                }else{
                                    $respuesta= array(
                                        'respuesta'=> 'error'
                                    );
                                }
                                $stmt->close();
                                $conn->close();
                            }

                    }catch(Exception $e){
                        $respuesta = array(
                            'error'=> $e->getMessage()
                        );
                    }
                }
            }catch(Exception $e){
                $respuesta = array(
                    'error'=> $e->getMessage()
                );

            }
            echo json_encode($respuesta);
        break;

        case 'buscar':
            include '../funciones/conexion.php';
        try{
            $sql = "SELECT * FROM clientes WHERE cedula = ?";
            $resultado = mysqli_prepare($conn,$sql);
            $ok = mysqli_stmt_bind_param($resultado,"s",$busqueda);
            $ok = mysqli_stmt_execute($resultado);
            
            $respuesta= array(
                'respuesta'=> 'error'
            );
            
            if($ok) {
                $ok= mysqli_stmt_bind_result($resultado,$id,$cedula,$nombre,$apellidos,$celular,$correo,$marca,$numero,$fecha,$codigo);

                while ( mysqli_stmt_fetch($resultado) ){
                    
                    $respuesta = array(
                        'respuesta'=>'correcto',
                        'cedula'=>$cedula,
                        'nombre'=>$nombre,
                        'apellidos'=>$apellidos,
                        'celular'=>$celular,
                        'correo'=>$correo,
                        'marca'=>$marca,
                        'numero'=>$numero,
                        'fecha'=>$fecha,
                        'codigo'=>$codigo,
                        'tipo'=>$accion
                    );    
                };

            
                $conn->close();
            }

        }catch(Exception $e){
            $respuesta = array(
                'error'=> $e->getMessage()
            );

        }
        echo json_encode($respuesta);

        break;

        case 'actualizar':
            include '../funciones/conexion.php';


        try{
            $comprobar_id = $conn->prepare("SELECT * FROM clientes WHERE cedula = ?");
            $comprobar_id->bind_param('s',$cedula);
            $comprobar_id->execute();
            
            while(mysqli_stmt_fetch($comprobar_id)){
                
            }
            if($comprobar_id->num_rows === 0){
                $respuesta= array(
                    'respuesta'=> 'noExiste'
                  );
            }else{
                try{
                    $stmt = $conn->prepare("UPDATE clientes SET cedula = ?,nombre = ?, apellidos = ?,celular = ?,correo = ?,marca = ?,numero = ?,fecha_expiracion = ?,cvv = ? where cedula=$cedula");
                            if($stmt === false){
                                $respuesta= array(
                                    'respuesta'=> 'error en la consulta'
                            );
                        }else{
                            $stmt->bind_param('sssssssss', $cedula,$nombre,$apellidos,$celular,$correo,$marca,$numero,$fecha,$codigo);
                            $stmt->execute();
                            if($stmt->affected_rows > 0){
                                $respuesta = array(
                                    'respuesta'=>'correcto',
                                    'tipo'=>$accion,
                                    'cliente'=> $nombre
                                );
                            }else{
                                $respuesta= array(
                                    'respuesta'=> 'error'
                                );
                            }
                            $stmt->close();
                            $conn->close();
                        }

                }catch(Exception $e){
                    $respuesta = array(
                        'error'=> $e->getMessage()
                    );
                }
            }
        }catch(Exception $e){
            $respuesta = array(
                'error'=> $e->getMessage()
            );

        }
        echo json_encode($respuesta);


        break;

        default:
        
        break;
    }
?>
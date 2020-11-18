<?php
 require_once(__DIR__."/conexion.php");

// obtiene la pagina actual
    function obtenerPaginaActual() {
      $archivo= basename($_SERVER['PHP_SELF']);
      $pagina = str_replace(".php","",$archivo);
      return $pagina;
    }

//--Consultas--


// obtener todos los proyectos 


    function obtenerProyectos(){
         global $conn;
          
          try{
              return $conn->query('SELECT * FROM proyectos');
          }catch(Exception $e){
            echo "error ! :".$e->getMessage();
            return false;
          }

          
          
    }

 // obtener nombre del proyecto 

      function obtenerNombreProyecto($id = null)
      {
        global $conn;
        try{
          return $conn->query("SELECT nombre FROM proyectos WHERE id={$id}");
        }catch(Exception $e){
          echo "error ! :".$e->getMessage();
          return false;
        }          
      }


// obtener las clases del proyecto 

    function obtenerTareasProyecto($id = null){
      include 'conexion.php';
             try{
             return $conn->query("SELECT id,nombre,estado FROM tareas WHERE id_proyecto = {$id}");
                }catch(Exception $e){
                    echo "error ! : ".$e->getMessage();
                    return false;
                }
    }
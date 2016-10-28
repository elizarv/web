<?php

    class Router {

        public $user;
        public $diagnosticoIdea;
        public $diagnosticoEmpresa;

        public function __construct() {
            $this->user = new User();
            $this->diagnosticoIdea =new DiagnosticoIdea();
            $this->diagnosticoEmpresa =new DiagnosticoEmpresa();

        }

        public function router() {
            
            if(isset($_GET["mode"])) {
              switch ($_GET["mode"]) {
                    case "iniciarSesion":
                       $this->user->inicioSesion();
                        break;
                    case "cerrarSesion":
                        session_destroy();
                        header("Location:index.php");
                        break;
                 case "agregar-diagnostico-idea":
                        if(!isset($_SESSION["user_id"])){
                            $this->user->inicioSesion();
                        }else{
                            $this->diagnosticoIdea->agregarDiagnosticoIdea();        
                        } 
                      break;

                 case "editar-diagnostico-idea":
                        if(!isset($_SESSION["user_id"])){
                            $this->user->inicioSesion();
                        }else{
                           $this->diagnosticoIdea->ventanaEditarDiag(); 
                        }
                        break;

                    case "consultar-diagnostico-idea":
                        if(!isset($_SESSION["user_id"])){
                            $this->user->inicioSesion();
                        }else{
                            $this->diagnosticoIdea->ventanaConsultarDiag();
                        }
                        break;

                          case "agregar-diagnostico-empresa":
                        if(!isset($_SESSION["user_id"])){
                            $this->user->inicioSesion();
                        }else{
                            $this->diagnosticoEmpresa->agregarDiagnosticoEmpresa();        
                        } 
                      break;
                        
                                      
                default:
                      header("Location:index.php");
                      break;
        }
            } else if(isset($_POST["mode"])) {
                  switch ($_POST["mode"]) {
                    case "login":
                       $this->user->login($_POST["username"], $_POST["password"]);
                        break;
                    case "procesar-add-diag-idea":
                     $this->diagnosticoIdea->agregarFormDiagnosticoIdea($_POST);
                        break;

                    case "procesar-edit-diag-idea":
                    $this->diagnosticoIdea->editarFormDiagnosticoIdea($_POST);
                        break;
                    case "seleccionar-editar-diagnostico-idea":
                    $this->diagnosticoIdea->editarForm($_POST["Num_consecutivo"]);
                        break;
                    case "seleccionar-consultar-diagnostico-idea":
                    $this->diagnosticoIdea->consultarForm($_POST["Num_consecutivo"]);
                   
                        break;
                           
                default:
                          
                      header("Location:index.php");
                      break;
                      }  
            } else {
              $this->user->index();  
            }
        }

      
    }

?>
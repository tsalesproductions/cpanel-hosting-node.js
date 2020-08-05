<?php
    namespace App\Models;

    use App\Connection;
    use App\serverController as serverController;
    use App\Controller;

    class serverManagerModel extends Connection{
        
        public function serverManager(){
            if(isset($_POST['manager'])){
                $server = new serverController($_POST['server_root'], $_POST['server_port']);

                switch($_POST['manager']){
                    case "start":
                        $server->startServer();
                    break;

                    case "restart":
                        //$server->startServer();
                    break;

                    case "stop":
                        $server->stopServer();
                    break;
                }

                Controller::redirect("./app/{$_POST['server_id']}", 1);
                exit();
            }
        }
        
    }
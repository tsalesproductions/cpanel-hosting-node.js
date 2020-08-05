<?php
    namespace App\Models;

    use App\Connection;
    use App\serverController as serverController;
    use App\Controller;

    class dashboardModel extends Connection{
        public function getApps(){
            $servers = $this->select("SELECT * FROM apps WHERE app_client = :app_client ORDER BY id DESC", [
                ':app_client' => $_SESSION['cpanel_username']
            ]);

            $list_servers = [];
            $serverController;

            foreach($servers as $key){
                $serverController = new serverController($key['app_root'], $key['app_port']);
                $status;

                if($serverController->serverStatus()){
                    $server = 1;
                }else{
                    $server = 0;
                }

                $server = [
                    'app_id' => $key['id'],
                    'app_client' => $key['app_client'],
                    'app_name' => $key['app_name'],
                    'app_ip' => $key['app_ip'],
                    'app_port' => $key['app_port'],
                    'app_root' => $key['app_root'],
                    'app_initialize' => $key['app_initialize'],
                    'app_status' => $server,
                ];

                array_push($list_servers, $server);
            }

            return $list_servers;
        }

        public function getNotes(){
            $servers = $this->select("SELECT * FROM notes", null);

            return $servers;
        }

        public function createNote(){
            if(isset($_POST['sendNote'])){
                $stmt = $this->insert("INSERT INTO notes (note) VALUES (:note)", [':note' => filter_var($_POST['note'], FILTER_SANITIZE_STRING)]);
                Controller::redirect("dashboard", 1);
            }
        }
    }
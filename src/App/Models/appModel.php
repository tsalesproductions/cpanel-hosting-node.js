<?php
    namespace App\Models;

    use App\Connection;
    use App\serverController as serverController;

    class appModel extends Connection{
        public function getApp($id){
            $server = $this->select("SELECT * FROM apps WHERE id = :id", [
                ':id' => $id
            ]);

            $serverController = new serverController($server[0]['app_root'], $server[0]['app_port']);
                
            $status;

            if($serverController->serverStatus()){
                $srv = 1;
            }else{
                $srv = 0;
            }

            $root = explode("\\", $server[0]['app_root']);
            $root = "\ {$root[2]} \ {$root[4]} ";

            $server = [
                'app_id' => $server[0]['id'],
                'app_client' => $server[0]['app_client'],
                'app_name' => $server[0]['app_name'],
                'app_ip' => $server[0]['app_ip'],
                'app_port' => $server[0]['app_port'],
                'app_root' => str_replace(" ", "", $root),
                'app_rootfull' => $server[0]['app_root'],
                'app_initialize' => $server[0]['app_initialize'],
                'app_status' => $srv,
            ];

            return $server;
        }
    }
<?php
    namespace App\Models;

    use App\Connection;
    use App\Controller;

    class createAppModel extends Connection{
        public function createApp(){
            if(isset($_POST['createApp'])){
                $data = [
                    'host_ip' => $_POST['host_ip'],
                    'app_name' => $_POST['app_name'],
                    'app_port' => $_POST['app_port'],
                    'app_index' => $_POST['app_index'],
                    'app_config' => $_POST['app_config'],
                    'app_package' => $_POST['app_package'],
                    'app_lock' => $_POST['app_lock'],
                ];

                $app_root = host_root.str_replace([" ", "_", "-"], "", $data['app_name'])."\\".str_replace([" ", "_", "-"], "", $data['app_name'])."\\";
                $app_root = str_replace("\\", "\\\\", $app_root);
                
                $this->createDir(host_root.str_replace([" ", "_", "-"], "", $data['app_name']), $data);

                $stmt = $this->insert("INSERT INTO apps (app_client, app_name, app_ip, app_port, app_root) VALUES (:app_client, :app_name, :app_ip, :app_port, :app_root)",[
                    'app_client' => $_SESSION['cpanel_username'], 
                    'app_name' => $data['app_name'], 
                    'app_ip' => host_ip, 
                    'app_port' => $data['app_port'], 
                    'app_root' => $app_root
                ]);
                

                if($stmt > 0){
                    Controller::alert("success", "Application successfully created", false);
                    Controller::redirect("./dashboard", 2);
                }
            }
        }

        public function createDir($dir, $data){
            if(!file_exists($dir."index.js")){
                mkdir($dir, 0700);
                $this->createFile($dir, "index.js", $data['app_index']);
                $this->createFile($dir, "config.json", $data['app_config']);
                $this->createFile($dir, "package.json", $data['app_package']);
                $this->createFile($dir, "package-lock.json", $data['app_lock']);
                return true;
            }else{
                Controller::alert("error", "The directory already exists", false);
                Controller::redirect("./createApp", 2);
                exit();
            }
        }

        public function createFile($dir, $file, $content){
            $fp = fopen("{$dir}\\".$file,"wb");
            fwrite($fp,$content);
            fclose($fp);
        }
    }
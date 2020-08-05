<?php
    namespace App\Models;

    use App\Connection;
    use App\Controller;

    class deleteAppModel extends Connection{

        public function deleteApp($id){
            $count = $this->rowCount("SELECT * FROM apps WHERE id = :id", [':id' => $id]);

            if($count > 0){
                $data = $this->select("SELECT * FROM apps WHERE id = :id", [':id' => $id]);

                if($data[0]['app_client'] !== $_SESSION['cpanel_username']){
                    Controller::redirect("./managerApps", 0);
                    exit();
                }

                $app_root = explode("\\", $data[0]['app_root']);
                $app_root = str_replace("\\","\\\\", host_root.$app_root[4]);

                $this->delete("apps", "id", $id);
                $this->rrmdir($app_root);
                Controller::redirect("./managerApps", 0);

            }
        }

        public function rrmdir($dir) {
            if (is_dir($dir)) {
              $objects = scandir($dir);
              foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                  if (filetype($dir."/".$object) == "dir") 
                     rrmdir($dir."/".$object); 
                  else unlink   ($dir."/".$object);
                }
              }
              reset($objects);
              rmdir($dir);
            }
        }
    }
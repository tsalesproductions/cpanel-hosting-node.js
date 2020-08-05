<?php
    namespace App;
    use COM;

    class serverController {
        public $serverDir = null;
        public $serverPort = null;

        public function __construct($serverDir, $serverPort){
            $this->serverDir = $serverDir;
            $this->serverPort = $serverPort;
        }

        public function serverStatus(){
            exec('netstat -ano | find "LISTENING" | find "'.$this->serverPort.'"', $output, $return_var);
            if(count($output) > 0){
                return true; //Servidor ligado
            }else{
                return false; //Servidor desligado
            }
        }

        public function stopServer(){
            exec('netstat -ano | find "LISTENING" | find "'.$this->serverPort.'"', $output, $return_var);

            if(count($output) > 0){
                $processId = explode(" ", $output[0]);
                $processId = $processId[count($processId) - 1];

                exec("taskkill /f /pid ".$processId, $saida, $return_var);

                $status = explode(" ", $saida[0]);
                $status = $status[count($status) - 1];
            
                if($status == "finalizado."){
                    return true; //Servidor parado
                }else{
                    return false; //servidor iniciado
                }
            }
        }

        public function startServer(){
            //exec("cd ". dirname($this->serverDir). " && node index.js 2>&1", $out, $err);
            // if(count($out) > 1){
            //     return $out[4];
            // }else{
            //     return $out[0];
            // }

            $sCommand = "cd ". dirname($this->serverDir). " && node index.js 2>&1";
            $sCommand = 'cmd /C '.$sCommand;
            $oShell = new COM("Wscript.Shell");
            $oShell->Run($sCommand, 0, false);
        }
    }

    // $server = new serverController("d:\\nodeServers\\nodeCrud\\nodeCrud\\", 8080);
    // echo $server->serverStatus();

?>

<?php
    namespace App\Controllers;

    use app\Controller;
    use App\Models\createAppModel;

    class createAppController extends createAppModel{
        public function index(){
            // $this->createFiles("d:\\nodeServers\\nodeCrud");
            $this->createApp();

            Controller::view('createApp/index.html', [
                'host_ip' => host_ip
            ]);
        }
    }
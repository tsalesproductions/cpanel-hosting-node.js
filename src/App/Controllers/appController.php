<?php
    namespace App\Controllers;

    use App\Controller;
    use App\Models\appModel;

    class appController extends appModel{
        public function index(){
            $url = Controller::getUrl();
            Controller::view('app/index.html', [
                'app' => $this->getApp($url[1]),
                'host_ip' => host_ip
            ]);
        }
    }
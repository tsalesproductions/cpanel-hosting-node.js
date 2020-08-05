<?php
    namespace App\Controllers;

    use app\Controller;
    use App\Models\deleteAppModel;

    class deleteAppController extends deleteAppModel{
        public function index(){
            $url = Controller::getUrl();
            $this->deleteApp($url[1]);
            Controller::view('deleteApp/index.html', []);
        }
    }
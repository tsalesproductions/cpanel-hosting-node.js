<?php
    namespace App\Controllers;

    use app\Controller;
    use App\Models\serverManagerModel;

    class serverManagerController extends serverManagerModel{
        public function index(){
            $this->serverManager();
            Controller::view('serverManager/index.html', []);
        }
    }
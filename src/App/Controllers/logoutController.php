<?php
    namespace App\Controllers;

    use app\Controller;
    use App\Models\logoutModel;

    class logoutController extends logoutModel{
        public function index(){
            $this->logout();
            Controller::view('logout/index.html', []);
        }
    }
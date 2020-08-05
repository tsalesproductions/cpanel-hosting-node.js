<?php
    namespace App\Controllers;

    use app\Controller;
    use App\Models\loginModel;

    class loginController extends loginModel{
        
        public function index(){
            Controller::view('login/index.html', []);
            $this->logIn();
        }
    }
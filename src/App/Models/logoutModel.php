<?php
    namespace App\Models;

    use App\Connection;
    use App\Controller;

    class logoutModel extends Connection{
        public function logout(){
            session_destroy();
            Controller::redirect("login", 0);
        }
    }
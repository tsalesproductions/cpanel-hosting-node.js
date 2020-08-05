<?php
    namespace App\Models;

    use App\Connection;
    use App\Controller;

    class loginModel extends Connection{
        public function logIn(){
            if(isset($_POST['login'])){
                $filter = [
                    "username" => filter_var($_POST['username'], FILTER_SANITIZE_STRING),
                    "password" => filter_var($_POST['password'], FILTER_SANITIZE_STRING)
                ];

                $logCheck = $this->rowCount("SELECT * FROM users WHERE username = :username", [
                    ':username' => $filter['username']
                ]);

                if($logCheck < 1){
                    Controller::alert("error", "Usuário ou senha inválidos", null);
                }else{
                    $dados = $this->select("SELECT * FROM users WHERE username = :username", [
                        ':username' => $filter['username']
                    ]);

                    if(password_verify($filter['password'], $dados[0]['password'])){
                        $_SESSION['cpanel_name'] = $dados[0]['name'];
                        $_SESSION['cpanel_username'] = $dados[0]['username'];

                        Controller::alert("success", "Successfully logged in", null);
                        Controller::redirect("dashboard", 3);
                    }
                }    
            }
        }
    }
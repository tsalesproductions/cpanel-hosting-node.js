<?php
    namespace App\Controllers;

    use App\Controller;
    use App\Models\removeNoteModel;

    class removeNoteController extends removeNoteModel{
        public function index(){
            $url = Controller::getUrl();
            $this->removeNote($url[1], $url[2]);
            //Controller::view('removeNote/index.html', []);
        }
    }
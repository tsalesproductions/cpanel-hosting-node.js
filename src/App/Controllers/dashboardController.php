<?php
    namespace App\Controllers;

    use app\Controller;
    use App\Models\dashboardModel;

    class dashboardController extends dashboardModel{
        public function index(){
            
            Controller::view('dashboard/index.html', [
                'apps' => $this->getApps(),
                'notes' => $this->getNotes()
            ]);

            $this->createNote();
        }
    }
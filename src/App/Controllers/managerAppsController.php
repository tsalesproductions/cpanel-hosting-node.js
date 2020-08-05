<?php
    namespace App\Controllers;

    use app\Controller;
    use App\Models\managerAppsModel;

    class managerAppsController extends managerAppsModel{
        public function index(){
            Controller::view('managerApps/index.html', [
                'apps' => $this->getApps()
            ]);
        }
    }
<?php
namespace app\controllers;

class DashboardController extends BaseController {
    public function dashboardAction(){
        return $this->renderHTML('dashboard.twig');
    }
}
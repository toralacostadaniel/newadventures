<?php
namespace app\controllers;

use app\models\{ SensorOne, SensorTwo, SensorThree };

class DashboardController extends BaseController {
    public function dashboardAction(){ 
        $limit = 5;

        $measurementsSensorOne = SensorOne::latest()->take($limit)->get();
        $measurementsSensorTwo = SensorTwo::latest()->take($limit)->get();
        $measurementsSensorThree = SensorThree::latest()->take($limit)->get();

        return $this->renderHTML('dashboard.twig', [
            'measurementsSensorOne' => $measurementsSensorOne,
            'measurementsSensorTwo' => $measurementsSensorTwo,
            'measurementsSensorThree' => $measurementsSensorThree
        ]);
    }
}
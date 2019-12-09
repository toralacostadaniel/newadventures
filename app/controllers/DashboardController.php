<?php
namespace app\controllers;

use app\models\{ SensorOne, SensorTwo, SensorThree };

class DashboardController extends BaseController {
    public function dashboardAction(){ 
        $limit = 5;

        $measurementsSensorOne = SensorOne::latest()->take($limit)->get();
        $measurementsSensorTwo = SensorTwo::latest()->take($limit)->get();
        $measurementsSensorThree = SensorThree::latest()->take($limit)->get();

        $lastMeasurementSensorOne = SensorOne::latest('id')->first();
        $lastMeasurementSensorTwo = SensorTwo::latest('id')->first();
        $lastMeasurementSensorThree = SensorThree::latest('id')->first();

        return $this->renderHTML('dashboard.twig', [
            'measurementsSensorOne' => $measurementsSensorOne,
            'measurementsSensorTwo' => $measurementsSensorTwo,
            'measurementsSensorThree' => $measurementsSensorThree,
            'lastMeasurementSensorOne' => $lastMeasurementSensorOne,
            'lastMeasurementSensorTwo' => $lastMeasurementSensorTwo,
            'lastMeasurementSensorThree' => $lastMeasurementSensorThree
        ]);
    }
}
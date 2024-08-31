<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\Activity;

class TrackerActivityController {
    public function activity() {
        $activityModel = new Activity();
        $activities = $activityModel->getAllActivities();

        $chartData = $activityModel->getStats();

        View::render('/manager/activity', [
            'scripts'=> ['active-link.js'],
            'activities' => $activities,
            'chartData' => json_encode($chartData)
        ]);
    }
}
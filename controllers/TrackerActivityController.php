<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\TrackerActivity;

class TrackerActivityController {
    public function activity() {
        $activities = TrackerActivity::getAllActivities();
        View::render('/manager/activity', [
            'title' => 'Le Journal de bord',
            'activities' => $activities,
            'scripts' => ['active-link.js']
        ]);
    }
}

<?php
namespace App\Controllers;

use App\Providers\View;

class TrackerController {
    public function tracker() {
        View::render('/manager/tracker', ['scripts'=> [
            'active-link.js'
        ]]);
    }
}
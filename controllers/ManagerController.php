<?php
namespace App\Controllers;

use App\Providers\View;

class ManagerController {
    public function cars() {
        View::render('/manager/cars', ['scripts'=> [
            'active-link.js'
        ]]);
    }

    public function clients() {
        View::render('/manager/clients', ['scripts'=> [
            'active-link.js'
        ]]);
    }
}

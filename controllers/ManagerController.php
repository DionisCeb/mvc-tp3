<?php
namespace App\Controllers;

use App\Providers\View;

/**
 * contrôleur pour le développement ultérieur du projet
 * POUR réaliser des fonctionnalités d'administration de site pour CMS
 */
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

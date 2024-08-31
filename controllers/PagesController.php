<?php
namespace App\Controllers;

use App\Providers\View;
/**
 * Responsable du traitement pour rendre disponible certaines pages de ce site
 */
class PagesController {
    public function about() {
        View::render('page/about', ['scripts'=> [
            'active-link.js'
        ]]);
    }

    public function blog() {
        View::render('page/blog', ['scripts'=> [
            'active-link.js'
        ]]);
    }

    public function catalog() {
        View::render('page/catalog', ['scripts'=> [
            'active-link.js'
        ]]);
    }

    public function team() {
        View::render('page/team', ['scripts'=> [
            'active-link.js'
        ]]);
    }
}

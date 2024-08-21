<?php
namespace App\Controllers;

use App\Providers\View;

class HomeController{
    public function index(){
        
        View::render('home', ['scripts'=> [
            'scrolling.js',
            'select-options.js'
        ]]);
    }

}
?>
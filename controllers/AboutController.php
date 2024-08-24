<?php
namespace App\Controllers;

use App\Providers\View;

class AboutController{
    public function index(){
        
        View::render('page/about', ['scripts'=> [
            'active-link.js'
        ]]);
    }

}
?>
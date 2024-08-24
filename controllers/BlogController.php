<?php
namespace App\Controllers;

use App\Providers\View;

class BlogController{
    public function index(){
        
        View::render('page/blog', ['scripts'=> [
            'active-link.js'
        ]]);
    }

}
?>
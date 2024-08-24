<?php
namespace App\Controllers;

use App\Providers\View;

class TeamController{
    public function index(){
        
        View::render('page/team', ['scripts'=> [
            'active-link.js'
        ]]);
    }

}
?>
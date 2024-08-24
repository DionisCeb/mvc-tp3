<?php
namespace App\Controllers;

use App\Providers\View;

class CatalogController{
    public function index(){
        
        View::render('page/catalog', ['scripts'=> [
            'active-link.js'
        ]]);
    }

}
?>
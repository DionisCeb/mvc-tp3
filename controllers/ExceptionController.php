<?php
namespace App\Controllers;

use App\Providers\View;

class ExceptionController{
    public function show404(){
        View::render('error/404', ['isError'=>true]);

    }
}

?>
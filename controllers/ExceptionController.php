<?php
namespace App\Controllers;

use App\Providers\View;

class ExceptionController{
    public function show404(){
        //echo 'Home Controller';
        /* $model = new ExampleModel;
        $data = $model->getData();
        */
        /* include('views/home.php'); */
        View::render('error/404', ['isError'=>true]);

    }
}

?>
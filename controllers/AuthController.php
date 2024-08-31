<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;

class AuthController{
    public function index(){
        View::render('auth/index');
    }

    public function store($data){

        $validator = new Validator;
        $validator->field('username', $data['username'])->email()->required()->max(50)->isExist('User', 'username');
        $validator->field('password', $data['password'])->min(5)->max(20);
        var_dump("store");

        if($validator->isSuccess()){
            $user = new User;
            $checkuser = $user->checkuser($data['username'],$data['password']);
            /* var_dump("checkUser");
            var_dump($checkuser);
            var_dump($_SESSION); */
            if($checkuser){
                // Retrieve the user's privilege
                $privilegeId = $_SESSION['privilege_id'];
                // Redirect based on the privilege
                if (in_array($privilegeId, [1, 2, 3])) {
                    return View::redirect('bookings');
                } else {
                    return View::redirect('booking/create');
                }
            }else{
                $errors['message'] = "Please check your credentials";
                return View::render('auth/index', ['errors'=>$errors, 'user'=>$data]);
            }
        
        }else{
            $errors = $validator->getErrors();
            //print_r($data);
            //print_r($errors);
            return View::render('auth/index', ['errors'=>$errors, 'user'=>$data]);
        }
    }

    public function delete(){
        session_destroy();
        return View::redirect('login');
    }

    
}
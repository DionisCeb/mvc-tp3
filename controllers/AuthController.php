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
            
            if($checkuser){
                // Récupérer le privilège de l'utilisateur
                $privilegeId = $_SESSION['privilege_id'];
               // Redirection basée sur le privilège
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
            return View::render('auth/index', ['errors'=>$errors, 'user'=>$data]);
        }
    }

    /**
     * fonction permettant de déconnecter l'utilisateur de la session actuelle
     */
    public function delete(){
        session_destroy();
        return View::redirect('login');
    }

    
}
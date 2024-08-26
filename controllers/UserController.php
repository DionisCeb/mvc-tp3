<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class UserController{

    public function __construct(){
        Auth::session();
    }

    public function create() {
        // Check if the user is a guest or has the required privilege
        if ($this->isGuest() || $this->hasRequiredPrivilege()) {
            // Retrieve privilege data if needed
            $privilege = new Privilege();
            $privileges = $privilege->select('privilege');

            // Render the user creation view
            View::render('user/create', ['privileges' => $privileges]);
        } else {
            // Redirect to login if not a guest and does not have the required privilege
            return View::redirect('login');
        }
    }

    private function isGuest() {
        // Check if the user is a guest
        return !isset($_SESSION['fingerPrint']) || $_SESSION['fingerPrint'] !== md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
    }

    private function hasRequiredPrivilege() {
        // Check if the user has the required privilege
        return isset($_SESSION['privilege_id']) && ($_SESSION['privilege_id'] == 1 || $_SESSION['privilege_id'] == 2 || $_SESSION['privilege_id'] == 3);
    }

    public function store($data){
        Auth::session();
        $validator = new Validator;
        $validator->field('name', $data['name'])->min(2)->max(50);
        $validator->field('username', $data['username'])->email()->required()->max(50)->isUnique('User');
        $validator->field('password', $data['password'])->min(5)->max(20);
        $validator->field('email', $data['email'])->email()->required()->max(50)->isUnique('User');
        $validator->field('privilege_id', $data['privilege_id'], 'privilege')->required()->isExist('Privilege');

        if($validator->isSuccess()){
            $user = new User;
            $data['password'] = $user->hashPassword($data['password']);
            $insert = $user->insert($data);
            if($insert){
                return View::redirect('login');
            }else{
                return View::render('error');
            }

           
        }else{
            $errors = $validator->getErrors();
            //print_r($data);
            //print_r($errors);
            $privilege = new Privilege;
            $privileges = $privilege->select('privilege');
            return View::render('user/create', ['errors'=>$errors, 'user'=>$data, 'privileges'=>$privileges]);
        }
    }
}
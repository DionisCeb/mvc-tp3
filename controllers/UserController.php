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
        // Vérifiez si l'utilisateur est un visiteur ou dispose du privilège requis
        if ($this->isGuest() || $this->hasRequiredPrivilege()) {
            // Récupérer les données de privilège si nécessaire
            $privilege = new Privilege();
            $privileges = $privilege->select('privilege');

            // Rendre la vue de création d'utilisateur
            View::render('user/create', ['privileges' => $privileges]);
        } else {
            // Redirection vers la connexion si vous n'êtes pas un invité et ne disposez pas du privilège requis
            return View::redirect('login');
        }
    }

    private function isGuest() {
        // Vérifiez si l'utilisateur est un invité
        return !isset($_SESSION['fingerPrint']) || $_SESSION['fingerPrint'] !== md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
    }

    private function hasRequiredPrivilege() {
        // Vérifiez si l'utilisateur dispose du privilège requis
        return isset($_SESSION['privilege_id']) && ($_SESSION['privilege_id'] == 1 || $_SESSION['privilege_id'] == 2 || $_SESSION['privilege_id'] == 3);
    }

    /**
     * Fonction pour créer de nouveaux utilisateurs
     * et enregistrer les données dans la base de données
     */
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
            $privilege = new Privilege;
            $privileges = $privilege->select('privilege');
            return View::render('user/create', ['errors'=>$errors, 'user'=>$data, 'privileges'=>$privileges]);
        }
    }
}
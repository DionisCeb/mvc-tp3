<?php
namespace App\Models;
use App\Models\DB\CRUD;

class User extends CRUD{
    protected $table = "user";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'username', 'password', 'email', 'privilege_id'];
    private $salt = "H4@1&";

    public function hashPassword($password, $cost = 10) {
        $options = [
            'cost' => $cost
       ];

       return password_hash($password.$this->salt, PASSWORD_BCRYPT, $options);
    }

    /**
     * Fonction pour vérifier si un utilisateur existe :
     */
    public function checkuser($username, $password){
        $user = $this->unique('username', $username);
        $clientIp = $this->getClientIp();
        $_SESSION['ip'] = $clientIp;
        if($user){
            if(password_verify($password.$this->salt, $user['password'])){
                session_regenerate_id();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['privilege_id'] = $user['privilege_id'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
                
                 return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
        

    }

    /**
     * Fonction pour détecter et renvoyer l'ip-
     */
    private function getClientIp() {
        // Vérifiez si l'adresse IP est transmise via un proxy
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // L'en-tête HTTP_X_FORWARDED_FOR contient une liste d'adresses IP
            $ipAddresses = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            // Renvoie la première adresse IP de la liste
            $ip = trim($ipAddresses[0]);
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            // HTTP_CLIENT_IP est défini lors de l'utilisation d'une connexion Internet partagée
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            // Retour à REMOTE_ADDR si aucun en-tête IP de proxy ou de client n'est défini
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        if ($ip === '::1') {
            $ip = '127.0.0.1';
        }
        return $ip;
    }
}
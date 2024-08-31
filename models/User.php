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
     * Function to check if a user exists:
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

    private function getClientIp() {
        // Check if the IP address is passed via a proxy
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // The HTTP_X_FORWARDED_FOR header contains a list of IP addresses
            $ipAddresses = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ip = trim($ipAddresses[0]); // Return the first IP address in the list
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            // HTTP_CLIENT_IP is set when using a shared internet connection
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            // Fallback to REMOTE_ADDR if no proxy or client IP headers are set
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        if ($ip === '::1') {
            $ip = '127.0.0.1'; // Optionally, convert ::1 to 127.0.0.1
        }
        return $ip;
    }
}
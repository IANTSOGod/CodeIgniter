<?php

namespace App\Models;

use CodeIgniter\Model; 

class UserModel extends Model
{
    protected $table = 'utilisateurs'; 

    protected $primaryKey = 'username'; 

    protected $allowedFields = ['username', 'mdp', 'email', 'tel', 'adresse']; 

    public function checkLogin($username, $password)
    {
        $user = $this->where('username', $username)->first();
        if ($user && strcmp($user['mdp'],$password)==0) {
            return $user;
        } else {
            return false;
        }
    }

    public function createUser($username, $password, $email, $tel, $adresse)
    {
        $data = [
            'username' => $username,
            'mdp' => $password, 
            'email' => $email,
            'tel' => $tel,
            'adresse' => $adresse
        ];
        $this->insert($data);
    }

    public function changeUser($preusername,$username,$password, $email, $tel, $adresse)
    {
        $data = [
            'username' => $username,
            'mdp' => $password, 
            'email' => $email,
            'tel' => $tel,
            'adresse' => $adresse
        ];
        $this->update($preusername,$data);   
    }
}

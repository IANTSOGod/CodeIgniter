<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Pager\Pager;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('home');
    }
    public function create_account(): string
    {
        return view('create_account');
    }
    public function login(): string
    {
        $userModel = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $user = $userModel->checkLogin($username, $password);
        if ($user) {
            return view('login');
        } else {
            return view('create_account');
        }
    }
    public function signup(): string
    {
        $userModel=new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $email=  $this->request->getVar('email');
        $tel= $this->request->getVar('tel');
        $adresse= $this->request->getVar('adresse');
        $user = $userModel->createUser($username, $password,$email,$tel,$adresse);
        return view('signup');
    }

    public function user(): string 
    {
        $pager = \Config\Services::pager();
    
        $page = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        
        $userModel = new UserModel();
    
        $data['users'] = $userModel->paginate(2);
    
        $data['pager'] = $userModel->pager;
        
        return view('userlist', $data);
    }
    public function tri(): string 
    {
        $searchTerm=$this->request->getVar('rech');
        $userModel = new UserModel();
        $data['users'] = $userModel->like('username', $searchTerm)
                                   ->orLike('mdp', $searchTerm)
                                   ->orLike('email', $searchTerm)
                                   ->orLike('tel', $searchTerm)
                                   ->orLike('adresse', $searchTerm)
                                   ->findAll();
        return view('tri', $data);

        }
    public function modif(): string
    {

        $pager = \Config\Services::pager();
    
        $page = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        
        $m_suppr=$this->request->getVar('m_suppr');
        $m_mod=$this->request->getVar('m_mod');
        $userModel = new UserModel();
        if(strcmp($m_suppr,"")==0){
            $data['mod']=$userModel->where('username',$m_mod)->first();
        }
        else{
            $userModel->delete($m_suppr);
        }
        $data['users'] = $userModel->paginate(2);
        $data['pager'] = $userModel->pager;
        return view('modify',$data);
    }
    public function after(): string
    {
        $pager = \Config\Services::pager();
        $page = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;

        $userModel=new UserModel();
        $preusername = $this->request->getVar('preusername');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $email=  $this->request->getVar('email');
        $tel= $this->request->getVar('tel');
        $adresse= $this->request->getVar('adresse');
        if(strcmp($preusername,"")!=0){
            $user = $userModel->changeUser($preusername,$username,$password,$email,$tel,$adresse);
        }
        $data['users'] = $userModel->paginate(2);
        $data['pager'] = $userModel->pager;

        return view('userlist', $data);        
    }
}

<?php

namespace App\Controllers;
use App\Models\UserModel;

class Home extends BaseController
{
    public function __construct()
    {
        helper(['url','form']);
        $this->user = new UserModel();

    }
    public function index()
    {
        echo view('inc/header.php');
        $data['users'] = $this->user->orderBy('id','DESC')->paginate(3,'group1');
        $data['pager'] = $this->user->pager;
        echo view('home.php',$data);
        echo view('inc/footer.php');
    }

    public function saveUser(){


        $username = $this->request->getVar("username");
        $email    = $this->request->getVar("email");

        $this->user->save(["username" => $username,"password" => $email]);

        session()->setFlashdata('success','success! registration completed');
        return redirect()->to(base_url());
    }

    public function updateUser(){
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $id = $this->request->getVar('updateId');
        $data['username'] = $username;
        $data['password'] = $password;
        $this->user->update($id,$data);
        return redirect()->to(site_url("/"));
    }

    public function getSingleUser($id){
        $data = $this->user->where('id',$id)->first();

        echo json_encode($data);
    }

    public function deleteUser($id){
        $this->user->delete($id);
        echo "deleted";
    }

    public function deleteMultiUser(){
        $ids = $this->request->getVar('ids');
        for($count = 0;$count < count($ids);$count++){
            $this->user->delete($ids[$count]);
        }
        echo "multi deleted";
    }
}

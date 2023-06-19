<?php

namespace App\Controllers;

use App\Models\UserModel;

class Main extends BaseController
{
    // Session
    protected $session;
    // Data
    protected $data;
    // Model
    protected $crud_model;

    // Initialize Objects
    public function __construct(){
        $this->crud_model = new UserModel();
        $this->session= \Config\Services::session();
        $this->data['session'] = $this->session;
    }

    // Home Page
    public function index(){
        $this->data['page_title'] = "Home Page";
        echo view('templates/header', $this->data);
        echo view('crud/home', $this->data);
        echo view('templates/footer');
    }

    // Create Form Page
    public function create(){
        $this->data['page_title'] = "Add New";
        $this->data['request'] = $this->request;
        echo view('templates/header', $this->data);
        echo view('crud/create', $this->data);
        echo view('templates/footer');
    }

    // Insert And Update Function
    public function save(){
        $this->data['request'] = $this->request;
        $post = [
            'firstname' => $this->request->getPost('firstname'),
            'middlename' => $this->request->getPost('middlename'),
            'lastname' => $this->request->getPost('lastname'),
            'password' => $this->request->getPost('password'),
            'gender' => $this->request->getPost('gender'),
            'contact' => $this->request->getPost('contact'),
            'email' => $this->request->getPost('email'),
            'address' => $this->request->getPost('address')
        ];
        
        if(!empty($this->request->getPost('id')))
            $save = $this->crud_model->where(['id'=>$this->request->getPost('id')])->set($post)->update();
        else
        {
            $this->crud_model->transStart(); // Start transaction

            try {
                $save = $this->crud_model->insert($post);
                $this->crud_model->transCommit(); // Commit transaction
            } catch (\Exception $e) {
                $this->crud_model->transRollback(); // Rollback transaction
            }
        }


        if($save){
            if(!empty($this->request->getPost('id')))
            $this->session->setFlashdata('success_message','Data has been updated successfully') ;
            else
            $this->session->setFlashdata('success_message','Data has been added successfully') ;
            $id =!empty($this->request->getPost('id')) ? $this->request->getPost('id') : $save;
            return redirect()->to('/main/view_details/'.$id);
        }else{
            echo view('templates/header', $this->data);
            echo view('crud/create', $this->data);
            echo view('templates/footer');
        }
    }

    // List Page
    public function list(){
        $this->data['page_title'] = "List of Users";
        $this->data['list'] = $this->crud_model->orderBy('date(date_created) ASC')->select('*')->get()->getResult();
        echo view('templates/header', $this->data);
        echo view('crud/list', $this->data);
        echo view('templates/footer');
    }

    // Get Users
    public function getUsers(){
        
       $request = service('request');
       $postData = $request->getPost();
       $dtpostData = $postData['data'];
       $response = array();

       ## Read value
       $draw = $dtpostData['draw'];
       $start = $dtpostData['start'];
       $rowperpage = $dtpostData['length']; // Rows display per page
       $columnIndex = $dtpostData['order'][0]['column']; // Column index
       $columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
       $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
       $searchValue = $dtpostData['search']['value']; // Search value

       ## Total number of records without filtering
       $users = new UserModel();
       $totalRecords = $users->select('id')
                     ->countAllResults();

       ## Total number of records with filtering
       $totalRecordwithFilter = $users->select('id')
            ->orLike('firstname', $searchValue)
            ->orLike('lastname', $searchValue)
            ->orLike('middlename', $searchValue)
            ->countAllResults();

       ## Fetch records
       $records = $users->select('*')
            ->orLike('firstname', $searchValue)
            ->orLike('lastname', $searchValue)
            ->orLike('middlename', $searchValue)
            ->orderBy($columnName,$columnSortOrder)
            ->findAll($rowperpage, $start);

       $data = array();

       foreach($records as $record ){

          $data[] = array( 
             "id"=>$record['id'],
             "firstname"=>$record['firstname'],
             "lastname"=>$record['lastname'],
             "middlename"=>$record['middlename'],
             "contact"=>$record['contact'],
             "email"=>$record['email']

          ); 
       }

       ## Response
       $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data,
        "token" => csrf_hash() // New token hash
       );

       return $this->response->setJSON($response);


    }

    // Edit Form Page
    public function edit($id=''){
        if(empty($id)){
            $this->session->setFlashdata('error_message','Unknown Data ID.') ;
            return redirect()->to('/main/list');
        }
        $this->data['page_title'] = "Edit Contact Details";
        $qry= $this->crud_model->select('*')->where(['id'=>$id]);
        $this->data['data'] = $qry->first();
        echo view('templates/header', $this->data);
        echo view('crud/edit', $this->data);
        echo view('templates/footer');
    }

    // Delete Data
    public function delete($id=''){
        if(empty($id)){
            $this->session->setFlashdata('error_message','Unknown Data ID.') ;
            return redirect()->to('/main/list');
        }
        $delete = $this->crud_model->delete($id);
        if($delete){
            $this->session->setFlashdata('success_message','User has been deleted successfully.') ;
            return redirect()->to('/main/list');
        }
    }

    // View Data
    public function view_details($id=''){
        if(empty($id)){
            $this->session->setFlashdata('error_message','Unknown Data ID.') ;
            return redirect()->to('/main/list');
        }
        $this->data['page_title'] = "View User Details";
        $qry= $this->crud_model->select("*, CONCAT(lastname,', ',firstname,COALESCE(concat(' ', middlename), '')) as `name`")->where(['id'=>$id]);
        $this->data['data'] = $qry->first();
        echo view('templates/header', $this->data);
        echo view('crud/view', $this->data);
        echo view('templates/footer');
    }
    
}

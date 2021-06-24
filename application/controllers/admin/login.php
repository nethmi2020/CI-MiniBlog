<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

    if (isset($_SESSION['user_id'])){
        redirect("admin/dashboard");
    }

        $data=[];
        if(isset($_SESSION['error']))
        {
            // die($_SESSION['error']);
            $data['error']=$_SESSION['error'];
        }
        else{
            $data['error']="NO_ERROR";
        }
		$this->load->view('adminpanel/loginview',$data);
	}

    function login_post(){
        // echo 'ji';
        // admin 123
     
      if(isset($_POST)){

        
          $email=$_POST['username'];
          $password=$_POST['password'];
          

          $sql="SELECT * FROM  `backenduser` WHERE `username` = '$email'  AND `password` = '$password' ";
         $query= $this->db->query($sql);
         
          if($query->num_rows()){
            //valid credentials

            $result= $query->result_array();
          
            

            // print_r($result);
            // die();
            $this->session->set_userdata('user_id', $result[0]['uid']);
            
            redirect('admin/dashboard');

          }
          else{
            $this->session->set_flashdata('error', 'Invalid Credentials');
            redirect("admin/login");
          }
      }
      else{
          echo ('Invalid Input');
      }
    }

    function logout(){
        session_destroy();
        redirect('admin/login');

    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

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
		$this->load->view('adminpanel/viewBlog');
	}

    function addBlog(){
        $this->load->view('adminpanel/addBlog');
    }


    function addBlog_post(){
        // print_r($_POST);
        // print_r($_FILES);

        // die();
        if($_FILES){

            $config['upload_path']          = './upload/blogimage/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('file'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    die("Error");

                    // $this->load->view('upload_form', $error);
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    // echo "<pre>";
                    // print_r($data);
                //    echo ($data['upload_data']['file_name']);
                   $fileUrl="./upload/blogimage/" .$data['upload_data']['file_name'];
                   $blog_title=$_POST['blog_title'];
                   $desc=$_POST['desc'];

                   
                   $sql="INSERT INTO `articles`( `blog_title`, `blog_description`, `blog_image`) VALUES (' $blog_title','$desc','$fileUrl') ";
                  $query= $this->db->query($sql);
                  


                    if($query){
                        $this->session->set_flashdata('inserted','yes');
                        redirect('admin/blog/addBlog');
                    }
            }

        }else{

        }

    }
}

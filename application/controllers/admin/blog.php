<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function index()
	{
        $sql="SELECT * FROM `articles` ORDER BY blogid DESC ";
        $query= $this->db->query($sql);
        $data['result']= $query->result_array();
		$this->load->view('adminpanel/viewBlog',$data);
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

    

    function editBlog($blog_id){
        


       $query= $this->db->query("SELECT * FROM `articles` WHERE `blogid`= $blog_id");
       $data['result']= $query->result_array();
       $data['blog_id']=$blog_id;
        $this->load->view('adminpanel/editblog', $data);
     

    }


    function editBlog_post(){
       
// print_r($_POST);
// die();

        if($_FILES['file']['name']){
          

            $config['upload_path']          = './upload/blogimage/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
           
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('file'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    die("error");

                    // $this->load->view('upload_form', $error);
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());

                //    echo "<pre>";
                //    print_r($data);
                //    print_r($data['upload_data']['file_name']);

                   $filename_location="upload/blogimg/" .$data['upload_data']['file_name'];
                   $blog_title=$_POST['blog_title'];
                   $desc=$_POST['desc'];
                   $blog_id=$_POST['blog_id'];
                //    $publish_unpublish=$_POST['publish_unpublish'];

                   $query=$this->db->query("UPDATE `articles` SET `blog_title`='$blog_title',`blog_description`='$desc',
                   `blog_image`='$filename_location'  WHERE `blogid`=' $blog_id'");

                   if($query){
                       $this->session->set_flashdata('Updated','yes');
                       redirect("admin/blog");
                   }
                   else{
                        $this->session->set_flashdata('Updated','no');
                        redirect("admin/blog");
                   }

            }



        }
        else
        
        {
            $blog_title=$_POST['blog_title'];
            $desc=$_POST['desc'];
            $blog_id=$_POST['blog_id'];
            $publish_unpublish=$_POST['publish_unpublish'];

            $query=$this->db->query("UPDATE `articles` SET `blog_title`='$blog_title',`blog_description`='$desc',`status`='$publish_unpublish' 
             WHERE `blogid`=' $blog_id'");

            if($query){
                $this->session->set_flashdata('Updated','yes');
                redirect("admin/blog");
            }
            else{
                 $this->session->set_flashdata('Updated','no');
                 redirect("admin/blog");
            }
        }

    }


    function deleteBlog(){
        
        // print_r($_POST);
        $delete_id=$_POST['delete_id'];

       $qu= $this->db->query("DELETE FROM `articles` WHERE `blogid` ='$delete_id'");

        if($qu){
            echo "deleted";
        }
        else{
            echo "not deleted";
        }

    }
}

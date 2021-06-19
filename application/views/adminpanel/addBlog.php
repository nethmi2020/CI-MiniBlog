<?php  $this->load->view("adminpanel/header.php")  ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    

      <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

      <div class="form align-center border shadow-sm bg-dark text-light mt-5 p-5">
      
            <h6 class="p-2 text-center display-4 mb-5">Add Blog</h6>

                <form action="<?php echo base_url('/admin/blog/addBlog_post')?>" method="POST" enctype="multipart/form-data">

                     <div class="form-group mb-3">
                    <input type="text" class="form-control bg-dark text-light" name="blog_title" placeholder="Title">
                    </div>

                    <div class="form-group mb-3">
                    <!-- <input type="text" class="form-control" name="blog_title" placeholder="title"> -->
                    <textarea name="desc" class="form-control bg-dark text-light"  placeholder="Blog desc"></textarea>
                    <!-- <textarea name="" id="" cols="30" rows="10"></textarea> -->
                    </div>

                    <div class="form-group mb-3">
                    <input type="file" class="form-control p-3 bg-dark text-light" name="file" placeholder="Image">
                    </div>

                    <button type="submit" class="btn btn-primary align-center">Add Blog</button>

                </form>
        
        </div>
     
    </main>
  </div>
</div>

<?php  $this->load->view("adminpanel/footer.php")  ?>

<script>

<?php

if(isset($_SESSION['inserted'])){
    echo "alert('Data Succesffully Inserted');";
}

?>

</script>





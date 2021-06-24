<?php  $this->load->view("adminpanel/header.php")  ?>
<style>

table tbody tr td{
  padding: 20px;
}
</style>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    

      <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

     <div class="container align-center border shadow-sm bg-light  mt-5 p-5" >
                <h6 class="p-2 text-center display-4 mb-5">View Blog</h6>

                <!-- <?php

                  echo "<pre>";
                  print_r($result);
                ?> -->

            <div class="table-responsive">
              <table class="table table-striped table-sm p-3">
                <thead>
                  <tr class="p-3">
                    <th>#</th>
                    <th>Title</th>
                    <th>Desc</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    if($result)
                    {
                
                      $counter=1;

                        foreach($result as $key => $value)
                      
                        {
                            ?> 
                            <tr>
                                <td   class="p-3"><?php echo $value['blogid'];  ?></td>
                                <td  class="p-3"><?php echo $value['blog_title'];  ?></td>
                                <td  class="p-5"><?php echo $value['blog_description']; ?></td>
                                <td  class="p-3"> <img src="<?php echo base_url($value['blog_image']);?>" class="img-fluid shadow rounded "  alt="">
                                </td>
                             
                                <td class="p-3"> <a  class="btn btn-danger delete"  href="#"  data-id="<?php echo $value['blogid'] ; ?>">Delete</a></td>
                                <!-- <?php echo base_url('admin/blog/deleteBlog/'.$value['blogid']) ; ?> -->
                                <td class="p-3"> <a class="btn btn-primary" id="edit" href="<?php echo base_url('admin/blog/editBlog/'.$value['blogid']) ; ?>" >Edit</a></td>
                                <!-- <td> <a href="#" id="<?php echo $row->id ; ?>" class="delete_post" id="<?php echo $value['blogid'] ; ?>" >Delete</a></td> -->
                            </tr>
                            
                            <?php
                        }
                        $counter++;

                  
                    }
                    else
                    {
                     ?>
                     <tr>
                     <td colspan="6">No Data Found</td>
                     </tr>
                     <?php


                    }
                ?>
                    
                </tbody>
              </table>
            </div>

 </div>
     
    </main>
  </div>
</div>

<?php  $this->load->view("adminpanel/footer.php")  ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script>

$(".delete").click(function(e){
  e.preventDefault();
  var delete_id=$(this).attr('data-id');
  
  var bool= confirm('Are you sure want to delete blog????');
  
  if(bool){
  
    $.ajax({
      url:'<?php echo base_url('admin/blog/deleteBlog/')?>' + delete_id,
      type:'POST',
      data:{'delete_id':delete_id},
      success:function(response){

          console.log(response);
          if(response =="deleted"){
            location.reload();
          }
          else if(response == "not deleted"){
            alert("Something went wrong");
          }
      }

    });
  }
  else{
    alert("Your blog is safe");
  }
})
</script>







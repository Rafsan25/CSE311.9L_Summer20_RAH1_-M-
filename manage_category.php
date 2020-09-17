<?php
include('top.php');
$msg="";
// Sql query for adding data to category table
if(isset($_POST['submit'])){
    $category= get_safe_value($_POST['category']);
    $order_number= get_safe_value($_POST['order_number']);
    $added_on= date('Y-m-d h:i:s');
// Check is the data already exist
    if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM category WHERE category='$category'"))>0){
        $msg= "Category already added";
    }else {
        mysqli_query($con, "INSERT INTO category(category, order_number, status, added_on) VALUES ('$category', '$order_number', 1, '$added_on')");
        redirect('category.php');
    }
}
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Manage Category</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Category</label>
                      <input type="text" class="form-control" placeholder="Category" name="category" required>
                        <div class="error mt8"> <?php echo $msg ?> </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Order Number</label>
                      <input type="text" class="form-control"  placeholder="Order Number" name="order_number">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>

                  </form>
                </div>
              </div>
            </div>

		 </div>
<?php
include('footer.php');
?>
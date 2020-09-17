<?php
include('top.php');
if(isset($_POST['submit'])){
    $category= get_safe_value($_POST['category']);
    $order_number= get_safe_value($_POST['order_number']);
    $added_on= date('Y-m-d h:i:s');
    mysqli_query($con,"INSERT INTO category(category, order_number, status, added_on) VALUES ('$category', '$order_number', 1, '$added_on')");
    redirect('category.php');
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
                      <input type="text" class="form-control" placeholder="Category" name="category">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Order Number</label>
                      <input type="text" class="form-control"  placeholder="Order Number" name="order_number">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

		 </div>
<?php
include('footer.php');
?>
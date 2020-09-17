<?php
include('top.php');
if(isset($_POST['submit'])){
    $category= get_safe_value($_POST['category']);
    $order_number= get_safe_value($_POST['order_number']);
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

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

		 </div>
<?php
include('footer.php');
?>
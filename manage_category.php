<?php
include('top.php');
// Initialize blank values of variable
$msg="";
$category="";
$order_number="";
$id="";
// Edit Action from category and ADD category
// Getting category and order number via id
if(isset($_GET['id']) && $_GET['id']>0){
    $id=get_safe_value($_GET['id']);
    $row=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM category WHERE id='$id'"));
    $category=$row['category'];
    $order_number=$row['order_number'];

}

// Sql query for adding data to category table
//After pressing submit button
if(isset($_POST['submit'])){
    $category= get_safe_value($_POST['category']);
    $order_number= get_safe_value($_POST['order_number']);
    $added_on= date('Y-m-d h:i:s');

    if($id==''){
        //Query will select row from category table where id is empty
        $sql="SELECT * FROM category WHERE category='$category'";
    }else{
        //Query will select row from category table where id is not empty
        $sql="SELECT * FROM category WHERE category='$category' && id!='$id'";
    }

// Check is the data already exist
    if(mysqli_num_rows(mysqli_query($con,$sql))>0){
        $msg= "Category already added";
    }else {
        if($id==''){
            //Inserting data where id is blank
            mysqli_query($con, "INSERT INTO category(category, order_number, status, added_on) VALUES ('$category', '$order_number', 1, '$added_on')");
        }else{
            // Updating data in a specific id row from category table
            mysqli_query($con, "UPDATE category SET category='$category', order_number='$order_number' WHERE ID='$id'");
        }

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
                      <input type="text" class="form-control" placeholder="Category" name="category" required value="<?php echo $category ?>">
                        <div class="error mt8"> <?php echo $msg ?> </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Order Number</label>
                      <input type="text" class="form-control"  placeholder="Order Number" name="order_number" value="<?php echo $order_number ?>">
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
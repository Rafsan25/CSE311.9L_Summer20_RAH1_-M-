<?php 
include('top.php');
$msg="";
$category_id="";
$dish="";
$dish_detail="";
$image="";
$id="";

if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from dish where id='$id'"));
	$category_id=$row['category_id'];
	$dish=$row['dish'];
	$dish_detail=$row['dish_detail'];
	$image=$row['image'];
}

if(isset($_POST['submit'])){
	$category_id=get_safe_value($_POST['category_id']);
	$dish=get_safe_value($_POST['dish']);
	$dish_detail=get_safe_value($_POST['dish_detail']);
	$added_on=date('Y-m-d h:i:s');
	
	if($id==''){
		$sql="select * from dish where dish='$dish'";
	}else{
		$sql="select * from dish where dish='$dish' and id!='$id'";
	}	
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="Dish already added";
	}else{
		if($id==''){
			
			mysqli_query($con,"insert into dish(category_id,dish,dish_detail,status,added_on) values('$category_id','$dish','$dish_detail',1,'$added_on')");
		}else{
			mysqli_query($con,"update dish set name='$category_id', dish='$dish' , dish_detail='$dish_detail' where id='$id'");
		}
		
		redirect('dish.php');
	}
}
$res_category=mysql_query($con,"select * from category where status='1' order by id asc ")
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Dish</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Category</label>
                      <select>
                      	<option>
                      		Se;ect Category
                      	</option>
                      </select>
                    </div>
					<div class="form-group">
                      <label for="exampleInputName1">Mobile</label>
                      <input type="text" class="form-control" placeholder="mobile" name="mobile" required value="<?php echo $mobile?>">
					  <div class="error mt8"><?php echo $msg?></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>Password</label>
                      <input type="textbox" class="form-control" placeholder="Password" name="password"  value="<?php echo $password?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            
		 </div>
        
<?php include('footer.php');?>
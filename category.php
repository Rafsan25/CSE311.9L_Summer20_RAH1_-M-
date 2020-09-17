<?php
<<<<<<< HEAD
include('top.php');

//Query for Action = Delete, Status(Active/Deactive).
// When we press Action from category page it will return two variable {type and id}.
// Query will check if the type==(delete || active || deactive).
// If the type is 'delete', 'active', deactive it will pass the id to the sql query in category table.
// The delete query will delete the data of that specific id.
// the status query will update the status

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
    $type=$_GET['type'];
    $id=$_GET['id'];
    // Query for delete
    if($type=='delete'){
        mysqli_query($con,"delete from category where id='$id'");
        redirect('category.php');
    }
    //Query for status update
    if($type=='active' || $type=='deactive'){
        $status=1;
        if($type=='deactive'){
            $status=0;
        }
        mysqli_query($con,"update category set status='$status' where id='$id'");
        redirect('category.php');
    }
}

//Getting data from database
$sql="select * from category order by order_number";
$res=mysqli_query($con,$sql);

=======
include ('top.php');
$sql="SELECT * FROM category ORDER BY order_number";
$res=mysqli_query($link,$sql);
>>>>>>> 237f4c997cdfd736133fc9abe6027aae175b7b1d

?>
<div class="card">
    <div class="card-body">
        <h2 class="grid_title">Category</h2>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Category</th>
                            <th>Order Number</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(mysqli_num_rows($res)>0) {
                            $i=1;
                            while($row=mysqli_fetch_assoc($res)){

                                ?>
<<<<<<< HEAD
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['category']?></td>
                                <td><?php echo $row['order_number']?></td>
                                <td>
                                    <a href=""><label class="badge badge-success">Edit</label> </a>
                                    &nbsp;
                                    <?php
                                    if($row['status']==1){
                                        ?>
                                        <a href="?id=<?php echo $row['id']?> & type=deactive"><label class="badge badge-danger">Active</label> </a>
                                        <?php
                                    }else {
                                        ?>
                                        <a href="?id=<?php echo $row['id']?> & type=active"><label class="badge badge-info">Deactive</label> </a>
                                        <?php
                                    }

                                    ?>
                                    &nbsp;
                                    <a href="?id=<?php echo $row['id']?> & type=delete"><label class="badge badge-danger delete_red">Delete</label> </a>
                                </td>
                            </tr>
                            <?php
                                $i++;
                                } } else { ?>
=======
>>>>>>> 237f4c997cdfd736133fc9abe6027aae175b7b1d
                                <tr>
                                    <td><?php echo  $i?></td>
                                    <td><? echo $row['category']?></td>
                                    <td><? echo $row['order_number']?></td>
                                    <td></td>

                                </tr>
                                <?php
                                $i++;
                            } } else { ?>
                            <tr>
                                <td colspan="5">No Data Found</td>
                            </tr>
                            <?php
                        } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ('footer.php');?>

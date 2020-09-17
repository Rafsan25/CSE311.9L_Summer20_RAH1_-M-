<?php
include('top.php');
//Query for Action = Delete, Status(Active/Deactive).
// When we press Action from category page it will return two variable {type and id}.
// Query will check if the type==(delete || active || deactive).
// If the type is 'delete', 'active', deactive it will pass the id to the sql query in category table.
// The delete query will delete the data of that specific id.
// the status query will update the status

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
    $type=($_GET['type']);
    $id=($_GET['id']);
    if($type=='delete'){
        mysqli_query($con,"delete from category where id='$id'");
        redirect('category.php');
    }
    if($type=='active' || $type=='deactive'){
        $status=1;
        if($type=='deactive'){
            $status=0;
        }
        mysqli_query($con,"update category set status='$status' where id='$id'");
        redirect('category.php');
    }

}

$sql="select * from category order by order_number";
$res=mysqli_query($con,$sql);

?>
    <div class="card">
        <div class="card-body">
            <h1 class="grid_title">Category Manage</h1>
            <a href="manage_category.php" class="add_link">Add Category</a>
            <div class="row grid_box">

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                            <tr>
                                <th width="10%">S.No #</th>
                                <th width="50%">Category</th>
                                <th width="15%">Order Number</th>
                                <th width="25%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(mysqli_num_rows($res)>0){
                                $i=1;
                                while($row=mysqli_fetch_assoc($res)){
                                    ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $row['category']?></td>
                                        <td><?php echo $row['order_number']?></td>
                                        <td>
                                            <a href="manage_category.php?id=<?php echo $row['id']?>"><label class="badge badge-success">Edit</label></a>&nbsp;
                                            <?php
                                            if($row['status']==1){
                                                ?>
                                                <a href="?id=<?php echo $row['id']?>&type=deactive"><label class="badge badge-danger">Active</label></a>
                                                <?php
                                            }else{
                                                ?>
                                                <a href="?id=<?php echo $row['id']?>&type=active"><label class="badge badge-info">Deactive</label></a>
                                                <?php
                                            }

                                            ?>
                                            &nbsp;
                                            <a href="?id=<?php echo $row['id']?>&type=delete"><label class="badge badge-danger delete_red">Delete</label></a>
                                        </td>

                                    </tr>
                                    <?php
                                    $i++;
                                } } else { ?>
                                <tr>
                                    <td colspan="5">No data found</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('footer.php');?>
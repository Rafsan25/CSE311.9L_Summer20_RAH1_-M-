<?php
include('top.php');

//Query for Action Delete.
// When we press Delete from category page it will return two variable {type and id}.
// Query will check if the type==delete.
// If the type is 'delete' it will pass the id to the sql query in category table.
// The delete query will delete the data of that specific id.

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
    $type=$_GET['type'];
    $id=$_GET['id'];
    if($type=='delete'){
        mysqli_query($con,"delete from category where id='$id'");
        redirect('category.php');
    }
}

//Getting data from database
$sql="select * from category order by order_number";
$res=mysqli_query($con,$sql);


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
                                <th width="10%">S. No</th>
                                <th width="50%">Category</th>
                                <th width="15%">Order Number</th>
                                <th width="25%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(mysqli_num_rows($res)>0) {
                                $i=1;
                                while($row=mysqli_fetch_assoc($res)){
                                ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['category']?></td>
                                <td><?php echo $row['order_number']?></td>
                                <td>
                                    <a href=""><label class="badge badge-success">Edit</label> </a>
                                    &nbsp;
                                    <a href=""><label class="badge badge-danger">Pending</label> </a>
                                    &nbsp;
                                    <a href="?id=<?php echo $row['id']?> & type=delete"><label class="badge badge-danger delete_red">Delete</label> </a>
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

<?php include('footer.php'); ?>
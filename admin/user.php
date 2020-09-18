<?php
include('top.php');

require_once "../config.php";

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['user_id']) && $_GET['user_id']>0){
    $type=get_safe_value($_GET['type']);
    $user_id=get_safe_value($_GET['user_id']);
    if($type=='active' || $type=='deactive'){
        $status=1;
        if($type=='deactive'){
            $status=0;
        }
        mysqli_query($con,"update user set status='$status' where user_id='$user_id'");
        redirect('user.php');
    }
}

$sql="select * from user order by user_id desc";
$res=mysqli_query($con,$sql);
?>
    <div class="card">
        <div class="card-body">
            <h1 class="grid_title">User Master</h1>
            <div class="row grid_box">

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                            <tr>
                                <th width="10%">S.No #</th>
                                <th width="20%">Name</th>
                                <th width="20%">User Name</th>
                                <th width="20%">Email</th>
                                <th width="20%">Phone</th>
                                <th width="20%">Address</th>
                                <th width="15%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(mysqli_num_rows($res)>0){
                                $i=1;
                                while($row=mysqli_fetch_assoc($res)){
                                    ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $row['name']?></td>
                                        <td><?php echo $row['user_name']?></td>
                                        <td><?php echo $row['email']?></td>
                                        <td><?php echo $row['phone']?></td>
                                        <td><?php echo $row['address']?></td>
                                        <td>
                                            <?php
                                            if($row['status']==1){
                                                ?>
                                                <a href="?id=<?php echo $row['user_id']?>&type=deactive"><label class="badge badge-danger hand_cursor">Active</label></a>
                                                <?php
                                            }else{
                                                ?>
                                                <a href="?id=<?php echo $row['user_id']?>&type=active"><label class="badge badge-info hand_cursor">Deactive</label></a>
                                                <?php
                                            }

                                            ?>
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
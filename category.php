<?php
include('top.php');
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
                                <th width="45%">Category</th>
                                <th width="15%">Order Number</th>
                                <th width="30%">Actions</th>
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
                                <td></td>
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
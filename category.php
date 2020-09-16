<?php
include ('top.php');
$sql="SELECT * FROM category ORDER BY order_number";
$res=mysqli_query($link,$sql);

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
                        <tr>
                            <td><?php echo  $i?></td>
                            <td><? echo $row['category']?></td>
                            <td><? echo $row['order_number']?></td>
                            <td></td>

                        </tr>
                        <?php
                            $i++;
                            } } else { ?>
                            <td colspan="5">No Data Found</td>


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

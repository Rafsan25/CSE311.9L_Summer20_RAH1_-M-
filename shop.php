<?php
include ("header.php");
?>

    <div class="breadcrumb-area gray-bg">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="shop.php">Shop</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="shop-page-area pt-100 pb-100">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <?php
                    $cat_id=0;
                    $product_sql="select * from dish where status=1";
                    if(isset($_GET['cat_id']) && $_GET['cat_id']>0){
                        $cat_id=get_safe_value($_GET['cat_id']);
                        $product_sql.=" and category_id='$cat_id' ";
                    }
                    $product_sql.=" order by dish desc";
                    $product_res=mysqli_query($con,$product_sql);
                    $product_count=mysqli_num_rows($product_res);
                    ?>
                    <div class="grid-list-product-wrapper">
                        <div class="product-grid product-view pb-20">
                            <?php if($product_count>0){?>
                                <div class="row">
                                    <?php while($product_row=mysqli_fetch_assoc($product_res)){?>
                                        <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                            <div class="product-wrapper">
                                                <div class="product-img">
                                                    <a href="javascript:void(0)">
                                                        <img src="<?php echo SITE_DISH_IMAGE.$product_row['image']?>" alt="">
                                                    </a>
                                                </div>
                                                <div class="product-content">
                                                    <h4>
                                                        <a href="javascript:void(0)"><?php echo $product_row['dish']?> </a>
                                                    </h4>
                                                    <div class="product-price-wrapper">
                                                        <span>100</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } else{
                                echo "No dish found";
                            }?>
                        </div>

                    </div>
                </div>
                <?php
                $cat_res=mysqli_query($con,"select * from category where status=1 order by order_number desc")
                ?>
                <div class="col-lg-3">
                    <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                        <div class="shop-widget">
                            <h4 class="shop-sidebar-title">Shop By Categories</h4>
                            <div class="shop-catigory">
                                <ul id="faq" class="category_list">
                                    <?php
                                    while($cat_row=mysqli_fetch_assoc($cat_res)){
                                        $class="selected";
                                        if($cat_id==$cat_row['id']){
                                            $class="active";
                                        }
                                        echo "<li> <a class='$class' href='shop.php?cat_id=".$cat_row['id']."'>".$cat_row['category']."</a></li>";

                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include("footer.php");
?>
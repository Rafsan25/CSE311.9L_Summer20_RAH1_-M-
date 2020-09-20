<?php
include ("header.php");
$cat_dish='';
$cat_dish_arr=array();
if(isset($_GET['cat_dish'])){
    $cat_dish=get_safe_value($_GET['cat_dish']);
    $cat_dish_arr=array_filter(explode(':',$cat_dish));
}
?>
<div class="breadcrumb-area gray-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Shop Grid Style </li>
            </ul>
        </div>
    </div>
</div>
<div class="shop-page-area pt-100 pb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="banner-area pb-30">
                    <a href="product-details.html"><img alt="" src="assets/img/banner/banner-49.jpg"></a>
                </div>

                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">
                            <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                <div class="product-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-1.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h4>
                                            <a href="product-details.html">PRODUCTS NAME HERE </a>
                                        </h4>
                                        <div class="product-price-wrapper">
                                            <span>$100.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                <div class="product-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h4>
                                            <a href="product-details.html">PRODUCTS NAME HERE </a>
                                        </h4>
                                        <div class="product-price-wrapper">
                                            <span>$100.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                <div class="product-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-3.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h4>
                                            <a href="product-details.html">PRODUCTS NAME HERE </a>
                                        </h4>
                                        <div class="product-price-wrapper">
                                            <span>$100.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                <div class="product-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-4.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h4>
                                            <a href="product-details.html">PRODUCTS NAME HERE </a>
                                        </h4>
                                        <div class="product-price-wrapper">
                                            <span>$100.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                <div class="product-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-5.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h4>
                                            <a href="product-details.html">PRODUCTS NAME HERE </a>
                                        </h4>
                                        <div class="product-price-wrapper">
                                            <span>$100.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                <div class="product-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-6.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h4>
                                            <a href="product-details.html">PRODUCTS NAME HERE </a>
                                        </h4>
                                        <div class="product-price-wrapper">
                                            <span>$100.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                <div class="product-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-7.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h4>
                                            <a href="product-details.html">PRODUCTS NAME HERE </a>
                                        </h4>
                                        <div class="product-price-wrapper">
                                            <span>$100.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                <div class="product-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-8.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h4>
                                            <a href="product-details.html">PRODUCTS NAME HERE </a>
                                        </h4>
                                        <div class="product-price-wrapper">
                                            <span>$100.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                <div class="product-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-9.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h4>
                                            <a href="product-details.html">PRODUCTS NAME HERE </a>
                                        </h4>
                                        <div class="product-price-wrapper">
                                            <span>$100.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php
            $cat_id=0;
            $cat_res=mysqli_query($con,"select * from category where status=1 order by order_number desc")
            ?>
            <div class="col-lg-3">
                <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                    <div class="shop-widget">
                        <h4 class="shop-sidebar-title">Shop By Categories</h4>
                        <div class="shop-catigory">
                            <ul id="faq">
                                <li> <a href="#">Vegetables</a> </li>
                                <li> <a href="#">Fruits</a></li>
                                <li> <a href="#">Red Meat</a></li>
                                 <?php 
                                        while($cat_row=mysqli_fetch_assoc($cat_res)){
                                            $class="selected";
                                            if($cat_id==$cat_row['id']){
                                                $class="active";
                                            }
                                            $is_checked='';
                                            if(in_array($cat_row['id'],$cat_dish_arr)){
                                                $is_checked="checked='checked'";
                                            }
                                            
                                            echo "<li> <input $is_checked onclick=set_checkbox('".$cat_row['id']."') type='checkbox' class='cat_checkbox' name='cat_arr[]' value='".$cat_row['id']."'/>".$cat_row['category']."</li>";  

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
include ("footer.php");
?>
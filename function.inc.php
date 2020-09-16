<?php
function pr($arr){
    echo '<pre>';
    print_r($arr);
}
function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
}
function redirect($link){
    ?>
    <script>
        window.location.href='<?php echo $link?>';
        </script>
    <?php
}
?>
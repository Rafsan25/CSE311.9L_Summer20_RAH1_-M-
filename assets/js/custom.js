jQuery('#frmRegister').on('submit',function(e){
    jQuery('.error_field').html('');
    jQuery('#register_submit').attr('disabled',true);
    jQuery('#form_msg').html('Please wait...');
    jQuery.ajax({
        url:'login_register_submit.php',
        type:'post',
        data:jQuery('#frmRegister').serialize(),
        success:function(result){
            jQuery('#form_msg').html('');
            jQuery('#register_submit').attr('disabled',false);
            var data=jQuery.parseJSON(result);
            if(data.status=='error'){
                jQuery('#'+data.field).html(data.msg);
            }
            if(data.status=='success'){
                jQuery('#'+data.field).html(data.msg);
                jQuery('#frmRegister')[0].reset();
            }
        }

    });
    e.preventDefault();
});

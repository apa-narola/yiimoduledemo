<?php
    $this->layout = '//layouts/base';
?>
<div class="login-header text-center">
    
</div>
<div class="login-wrapper">
    <div class="alert alert-warning alert-bold-border fade in alert-dismissable">
     Check your email "<?php echo $model->email; ?>" how to recover your password.
    </div>
</div>
<script type="text/javascript">
$(function(){$('body').addClass('login')});
</script>
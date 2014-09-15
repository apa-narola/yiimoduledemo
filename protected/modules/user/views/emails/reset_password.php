<?php
    $this->Subject = 'Your password has been reset';
?>

<p>Hi <?php echo $name; ?></p><br><br>
<p>Your password has been reset.</p>
<p>Your new password is: <?php echo $password; ?></p>
<br>
<p>Login with new password here: <?php echo CHtml::link($loginLink, $loginLink);?></p>

<br><br>

Regards,<br><br>

<?php echo Yii::app()->name; ?> Team.
<?php
    $this->Subject = 'Your password will be reset';
?>

<p>Hi <?php echo $name; ?></p><br><br>
<p>Follow this link to reset your password:</p>
<p><?php echo CHtml::link($resetLink, $resetLink);?></p>

<br><br>

Regards,<br><br>

<?php echo Yii::app()->name; ?> Team.
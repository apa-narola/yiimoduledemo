<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'meta_title', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->meta_title; ?></p>
</div>
<br>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'meta_keywords', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->meta_keywords; ?></p>
</div>
<br>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'meta_description', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->meta_description; ?></p>
</div>
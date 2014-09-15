<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'tax', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->tax; ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'taux', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->taux; ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'currency', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->currency; ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'symbole', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->symbole; ?></p>
</div>
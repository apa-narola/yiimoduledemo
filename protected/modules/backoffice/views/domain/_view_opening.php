<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'decalage', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->decalage; ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'phonecallcenter', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->phonecallcenter; ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'sav_portable', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->sav_portable; ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'display_phone', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo PropertyValue::enumValue('FlagEnumerable', $model->display_phone); ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'app_type', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->applicationType ? $model->applicationType->name : 'None'; ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'openingdays', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->openingdays; ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'openinghours', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->openinghours; ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'closinghours', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->closinghours; ?></p>
</div>
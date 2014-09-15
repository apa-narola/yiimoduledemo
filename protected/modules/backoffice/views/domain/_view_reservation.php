<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'show_journey', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo PropertyValue::enumValue('FlagEnumerable', $model->show_journey); ?></p>
</div>

<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'escales', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->escalesLabel ; ?></p>
</div>

<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'issuetickets', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo PropertyValue::enumValue('FlagEnumerable', $model->issuetickets); ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'sendmailtickets', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo PropertyValue::enumValue('FlagEnumerable', $model->sendmailtickets); ?></p>
</div>

<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'smsreservation', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->smsreservation; ?></p>
</div>

<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'smsactivitation', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo PropertyValue::enumValue('FlagEnumerable', $model->smsactivitation); ?></p>
</div>

<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'session_resa', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->session_resa; ?></p>
</div>
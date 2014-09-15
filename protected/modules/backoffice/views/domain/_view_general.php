<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'name', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->name; ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'identifier', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->identifier; ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'down', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo PropertyValue::enumValue('FlagEnumerable', $model->down); ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'env', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo PropertyValue::enumValue('DomainEnvEnumerable', $model->env); ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'fashion', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo PropertyValue::enumValue('DomainModeEnumerable', $model->fashion); ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'email', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->email; ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'langue_id', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->langue ? $model->langue->nom : ''    ; ?></p>
</div>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'show_langs', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo PropertyValue::enumValue('FlagEnumerable', $model->show_langs); ?></p>
</div>

<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'account_id', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo $model->account ? CHtml::link($model->account->name, array("/backoffice/entities/account/view", "id" => $model->account->primaryKey)) : ''    ; ?></p>
</div>

<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'theme', array(
        'class' => 'col-sm-3 control-label',
    )) ;?>
    <p class="form-control-static col-sm-9"><?php echo ucfirst($model->theme); ?></p>
</div>
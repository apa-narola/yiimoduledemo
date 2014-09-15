<div class="form-group">
    <?php echo $form->label($model, 'decalage') ;?>
    <?php echo $form->textField($model, 'decalage', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'decalage'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'phonecallcenter') ;?>
    <?php echo $form->textField($model, 'phonecallcenter', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'phonecallcenter'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'sav_portable') ;?>
    <?php echo $form->textField($model, 'sav_portable', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'sav_portable'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'display_phone') ;?>
    <div class="input-group">
    <?php echo $form->radioButtonList($model, 'display_phone', PropertyValue::enumListData('FlagEnumerable', false), array(
        'template' => '<label class="radio-inline">{input} {label}</label>',
        'separator' => false,
    )); ?>
    </div>
    <?php echo $form->error($model, 'display_phone'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'application_type_id') ;?>
    <div class="input-group">
    <?php echo $form->dropDownList($model, 'application_type_id', PropertyValue::enumListData('ApplicationType', true, 'id', 'name'), array(
        'class' => 'form-control',
        'empty' => 'None',
        'data-placeholder' => "Choose an Application Type...",
    )); ?>
    </div>
    <?php echo $form->error($model, 'application_type_id'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'openingdays') ;?>
    <?php echo $form->textField($model, 'openingdays', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'openingdays'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'openinghours') ;?>
    <?php echo $form->textField($model, 'openinghours', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'openinghours'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'closinghours') ;?>
    <?php echo $form->textField($model, 'closinghours', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'closinghours'); ?>
</div>
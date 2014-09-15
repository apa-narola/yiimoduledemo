<div class="form-group">
    <?php echo $form->label($model, 'show_journey') ;?>
    <div class="input-group">
    <?php echo $form->radioButtonList($model, 'show_journey', PropertyValue::enumListData('FlagEnumerable', false), array(
        'template' => '<label class="radio-inline">{input} {label}</label>',
        'separator' => false,
    )); ?>
    </div>
    <?php echo $form->error($model, 'show_journey'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'escales') ;?>
    <div class="input-group">
    <?php echo $form->radioButtonList($model, 'escales', array_merge(PropertyValue::enumListData('FlagEnumerable', false), array('Yes, If no direct flights')), array(
        'template' => '<label class="radio-inline">{input} {label}</label>',
        'separator' => false,
    )); ?>
    </div>
    <?php echo $form->error($model, 'escales'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'issuetickets') ;?>
    <div class="input-group">
    <?php echo $form->radioButtonList($model, 'issuetickets', PropertyValue::enumListData('FlagEnumerable', false), array(
        'template' => '<label class="radio-inline">{input} {label}</label>',
        'separator' => false,
    )); ?>
    </div>
    <?php echo $form->error($model, 'issuetickets'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'sendmailtickets') ;?>
    <div class="input-group">
    <?php echo $form->radioButtonList($model, 'sendmailtickets', PropertyValue::enumListData('FlagEnumerable', false), array(
        'template' => '<label class="radio-inline">{input} {label}</label>',
        'separator' => false,
    )); ?>
    </div>
    <?php echo $form->error($model, 'sendmailtickets'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'smsreservation') ;?>
    <?php echo $form->textField($model, 'smsreservation', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'smsreservation'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'smsactivitation') ;?>
    <div class="input-group">
    <?php echo $form->radioButtonList($model, 'smsactivitation', PropertyValue::enumListData('FlagEnumerable', false), array(
        'template' => '<label class="radio-inline">{input} {label}</label>',
        'separator' => false,
    )); ?>
    </div>
    <?php echo $form->error($model, 'smsactivitation'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'session_resa') ;?>
    <?php echo $form->textField($model, 'session_resa', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'session_resa'); ?>
</div>

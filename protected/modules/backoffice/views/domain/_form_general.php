<div class="form-group">
    <?php echo $form->label($model, 'name') ;?>
    <?php echo $form->textField($model, 'name', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'name'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'identifier') ;?>
    <?php echo $form->textField($model, 'identifier', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'identifier'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'down') ;?>
    <div class="input-group">
    <?php echo $form->radioButtonList($model, 'down', PropertyValue::enumListData('FlagEnumerable', false), array(
        'template' => '<label class="radio-inline">{input} {label}</label>',
        'separator' => false,
    )); ?>
    </div>
    <?php echo $form->error($model, 'down'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'env') ;?>
    <div class="input-group">
    <?php echo $form->radioButtonList($model, 'env', PropertyValue::enumListData('DomainEnvEnumerable'), array(
        'template' => '<label class="radio-inline">{input} {label}</label>',
        'separator' => false,
    )); ?>
    </div>
    <?php echo $form->error($model, 'env'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'fashion') ;?>
    <div class="input-group">
    <?php echo $form->radioButtonList($model, 'fashion', PropertyValue::enumListData('DomainModeEnumerable', false), array(
        'template' => '<label class="radio-inline">{input} {label}</label>',
        'separator' => false,
    )); ?>
    </div>
    <?php echo $form->error($model, 'fashion'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'email') ;?>
    <?php echo $form->textField($model, 'email', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'email'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'langue_id') ;?>
    <?php echo $form->dropDownList($model, 'langue_id', PropertyValue::enumListData('Langue', true, 'id', 'name'), array(
        'class' => 'form-control chosen-select',
        'data-placeholder' => 'Choose a Language...',
        'empty' => '',
    )); ?>
    <?php echo $form->error($model, 'langue_id'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'show_langs') ;?>
    <div class="input-group">
    <?php echo $form->radioButtonList($model, 'show_langs', PropertyValue::enumListData('FlagEnumerable', false), array(
        'template' => '<label class="radio-inline">{input} {label}</label>',
        'separator' => false,
    )); ?>
    </div>
    <?php echo $form->error($model, 'show_langs'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'account_id') ;?>
    <?php echo $form->dropDownList($model, 'account_id', PropertyValue::enumListData('Account', true, 'id', 'name'), array(
        'class' => 'form-control chosen-select-deselect',
        'data-placeholder' => 'Choose a Account...',
        'empty' => '',
    )); ?>
    <?php echo $form->error($model, 'account_id'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'theme') ;?>
    <?php echo $form->dropDownList($model, 'theme', Domain::getThemesListData(), array(
        'class' => 'form-control chosen-select',
        'data-placeholder' => 'Choose a Theme...',
        'empty' => '',
    )) ;?>
    <?php echo $form->error($model, 'theme'); ?>
</div>

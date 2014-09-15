<div class="row">
    <div class="col-sm-6 form-group">
        <?php echo $form->label($model, 'username') ;?>
        <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <?php echo $form->textField($model, 'username', array(
            'class' => 'form-control',
        )) ;?>
        </div>
        <?php echo $form->error($model, 'username'); ?>
    </div>
    <div class="col-sm-6 form-group">
        <?php echo $form->label($model, 'status') ;?>
        <div class="input-group">
        <?php echo $form->radioButtonList($model, 'status', $model->statusListData, array(
            'template' => '<label class="radio-inline">{input}{label}</label>',
            'separator' => false,
        )); ?>
        </div>
        <?php echo $form->error($model, 'status'); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 form-group">
        <?php echo $form->label($model, 'email') ;?>
        <div class="input-group">
        <span class="input-group-addon">@</span>

        <?php echo $form->textField($model, 'email', array(
            'class' => 'form-control',
        )) ;?>
        </div>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class="col-sm-6 form-group">
        <?php echo $form->label($model, 'agency_id') ;?>
        <?php echo $form->dropdownList($model, 'agency_id', Agences::model()->listData, array(
            'empty' => '',
            'data-placeholder' => 'Choose an Agency...',
            'class' => 'form-control chosen-select',
        )) ;?>
        <?php echo $form->error($model, 'agency_id'); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 form-group">
        <?php echo $form->label($model, 'name') ;?>
        <?php echo $form->textField($model, 'name', array(
            'class' => 'form-control',
        )) ;?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="col-sm-6 form-group">
        <?php echo $form->label($model, 'prenom') ;?>
        <?php echo $form->textField($model, 'prenom', array(
            'class' => 'form-control',
        )) ;?>
    </div>
    <?php echo $form->error($model, 'prenom'); ?>
</div>


<div class="row">
    <div class="col-sm-6 form-group">
        <?php echo $form->label($model, 'mobile') ;?>
        <?php echo $form->textField($model, 'mobile', array(
            'class' => 'form-control',
        )) ;?>
        <?php echo $form->error($model, 'mobile'); ?>
    </div>
    <div class="col-sm-6 form-group">
        <?php echo $form->label($model, 'password') ;?>
        <?php echo $form->passwordField($model, 'password', array(
            'class' => 'form-control',
            'value' => false,
            'placeholder' => 'Enter password',
        )) ;?>
        <?php echo $form->error($model, 'password'); ?>
    </div>
</div>


<div class="form-group">
    <?php echo $form->label($model, 'zone') ;?>
    <?php echo $form->textArea($model, 'zone', array(
        'class' => 'form-control',
        'rows' => '5',
    )) ;?>
    <?php echo $form->error($model, 'zone'); ?>
</div>
<div class="form-group">
    <?php echo CHtml::submitButton('Save', array(
        'class' => 'btn btn-primary',
    )); ?>

    
    <?php if (!$model->isNewRecord): ?>
    <?php echo CHtml::link('Delete', array('delete', 'id' => $model->primaryKey), array(
        'class' => 'btn btn-danger',
        'confirm' => 'Are you sure you want to delete this item?',
    )); ?>
    <?php endif; ?>
</div>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'form-societe-edit',
    'htmlOptions' => array (
        'role' => 'form',
    ),
)); ?>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?php echo $form->label($model, 'name') ;?>
            <?php echo $form->textField($model, 'name', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'manager_firstname') ;?>
            <?php echo $form->textField($model, 'manager_firstname', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'manager_firstname'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'postal_code') ;?>
            <?php echo $form->textField($model, 'postal_code', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'postal_code'); ?>
        </div>
        
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <?php echo $form->label($model, 'country_id') ;?>
            <?php echo $form->dropDownList($model, 'country_id', PropertyValue::enumListData('Countrylist', true, 'id', 'name'), array(
                'class' => 'form-control chosen-select',
                'data-placeholder' => 'Choose a Country...',
                'empty' => '',
            )) ;?>
            <?php echo $form->error($model, 'country_id'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'manager_lastname') ;?>
            <?php echo $form->textField($model, 'manager_lastname', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'manager_lastname'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'ville') ;?>
            <?php echo $form->textField($model, 'ville', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'ville'); ?>
        </div>
        
        
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <?php echo $form->label($model, 'address') ;?>
            <?php echo $form->textArea($model, 'address', array(
                'class' => 'form-control',
                'rows' => 3,
            )) ;?>
            <?php echo $form->error($model, 'address'); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?php echo $form->label($model, 'phone_fixe') ;?>
            <?php echo $form->textField($model, 'phone_fixe', array(
                'class' => 'form-control'
            )) ;?>
            <?php echo $form->error($model, 'phone_fixe'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'fax') ;?>
            <?php echo $form->textField($model, 'fax', array(
                'class' => 'form-control'
            )) ;?>
            <?php echo $form->error($model, 'fax'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'email') ;?>
            <?php echo $form->textField($model, 'email', array(
                'class' => 'form-control'
            )) ;?>
            <?php echo $form->error($model, 'email'); ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <?php echo $form->label($model, 'phone_mobile') ;?>
            <?php echo $form->textField($model, 'phone_mobile', array(
                'class' => 'form-control'
            )) ;?>
            <?php echo $form->error($model, 'phone_mobile'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'siret') ;?>
            <?php echo $form->textField($model, 'siret', array(
                'class' => 'form-control'
            )) ;?>
            <?php echo $form->error($model, 'siret'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'n_tvai') ;?>
            <?php echo $form->textField($model, 'n_tvai', array(
                'class' => 'form-control'
            )) ;?>
            <?php echo $form->error($model, 'n_tvai'); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <?php echo CHtml::link('Cancel', array('index'), array(
                'class' => 'btn btn-default',
            )); ?>
            <?php echo CHtml::submitButton('Save', array(
                'class' => 'btn btn-primary',
            )); ?>
            <?php if (!$model->isNewRecord && Yii::app()->user->checkAccess('Backoffice.Societe.Delete')): ?>
            <?php echo CHtml::link('Delete', array('delete', 'id' => $model->primaryKey), array(
                'class' => 'btn btn-danger',
                'confirm' => 'Are you sure you want to delete this item?',
            )); ?>
            <?php endif; ?>
        </div>
    </div>
</div>



<?php $this->endWidget(); ?>

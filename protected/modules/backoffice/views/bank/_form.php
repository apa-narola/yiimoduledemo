<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'form-bank-edit',
    'action' => isset($modal) ? array('create') : null,
    'htmlOptions' => array(
        'role' => 'form',
    ),
)); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <?php echo $form->label($model, 'societe_id', array(
                'label' => 'Societe',
            )) ;?>
            <?php echo $form->dropDownList($model, 'societe_id', PropertyValue::enumListData('Societe', true, 'id', 'name'), array(
                'class' => 'form-control',
                'empty' => '',
                'data-placeholder' => "Choose a Societe...",
            )) ;?>
            <?php echo $form->error($model, 'societe_id'); ?>
        </div>
        
        <div class="form-group">
            <?php echo $form->label($model, 'beneficiaire') ;?>
            <?php echo $form->textField($model, 'beneficiaire', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'beneficiaire'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'code_iban') ;?>
            <?php echo $form->textArea($model, 'code_iban', array(
                'class' => 'form-control',
                'rows' => 3,
            )) ;?>
            <?php echo $form->error($model, 'code_iban'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'code_bic') ;?>
            <?php echo $form->textArea($model, 'code_bic', array(
                'class' => 'form-control',
                'rows' => 3,
            )) ;?>
            <?php echo $form->error($model, 'code_bic'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'status') ;?>
            <div class="input-group">
            <?php echo $form->radioButtonList($model, 'status', PropertyValue::enumListData('StatusEnumerable', false), array(
                'template' => '<label class="radio-inline">{input}{label}</label>',
                'separator' => false,
            )); ?>
            </div>
            <?php echo $form->error($model, 'status'); ?>
        </div>
    </div>
</div>


<?php if(!isset($modal)): ?>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <?php echo CHtml::link('Cancel', array('index'), array(
                'class' => 'btn btn-default',
            )); ?>
            <?php echo CHtml::submitButton('Save', array(
                'class' => 'btn btn-primary',
            )); ?>
            <?php if (!$model->isNewRecord && Yii::app()->user->checkAccess('Backoffice.Bank.Delete')): ?>
            <?php echo CHtml::link('Delete', array('delete', 'id' => $model->primaryKey), array(
                'class' => 'btn btn-danger',
                'confirm' => 'Are you sure you want to delete this item?',
            )); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php endif; ?>

<?php $this->endWidget(); ?>



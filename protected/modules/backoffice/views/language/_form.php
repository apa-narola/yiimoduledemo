<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'form-language-edit',
    'action' => isset($modal) ? array('create') : null,
    'htmlOptions' => array(
        'role' => 'form',
    ),
)); ?>

<div class="row">
    <div class="col-sm-12">

        <div class="form-group">
            <?php echo $form->label($model, 'name') ;?>
            <?php echo $form->textField($model, 'name', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'title') ;?>
            <?php echo $form->textField($model, 'title', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'status') ;?>
            <div class="input-group">
            <?php echo $form->radioButtonList($model, 'status', PropertyValue::enumListData('StatusEnumerable', false), array(
                'template' => '<label class="radio-inline">{input} {label}</label>',
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
            <?php if (!$model->isNewRecord && Yii::app()->user->checkAccess('Backoffice.Country.Delete')): ?>
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



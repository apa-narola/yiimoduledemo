<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'form-country-edit',
    'action' => isset($modal) ? array('create') : null,
    'htmlOptions' => array(
        'role' => 'form',
    ),
)); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <?php echo $form->label($model, 'ISO2') ;?>
            <?php echo $form->textField($model, 'ISO2', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'ISO2'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'ISO3') ;?>
            <?php echo $form->textField($model, 'ISO3', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'ISO3'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'name') ;?>
            <?php echo $form->textField($model, 'name', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'name_fr') ;?>
            <?php echo $form->textField($model, 'name_fr', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'name_fr'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'name_es') ;?>
            <?php echo $form->textField($model, 'name_es', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'name_es'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'nationality') ;?>
            <?php echo $form->textField($model, 'nationality', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'nationality'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'prefixe_international') ;?>
            <?php echo $form->textField($model, 'prefixe_international', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'prefixe_international'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'featured') ;?>
            <div class="input-group">
            <?php echo $form->radioButtonList($model, 'featured', PropertyValue::enumListData('FlagEnumerable', false), array(
                'template' => '<label class="radio-inline">{input} {label}</label>',
                'separator' => false,
            )); ?>
            </div>
            <?php echo $form->error($model, 'featured'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'display_order') ;?>
            <?php echo $form->textField($model, 'display_order', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'display_order'); ?>
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



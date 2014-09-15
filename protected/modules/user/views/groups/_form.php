<?php
/**
 * @var $this Controller
 */

?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'form-user-group',
    'action' => array('create'),
    'htmlOptions' => array (
        
    ),
)); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <?php echo $form->textField($model, 'name', array(
                'class' => 'form-control',
                'placeholder' => $model->getAttributeLabel('name'),
            )); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->textArea($model, 'description', array(
                'class' => 'form-control',
                'placeholder' => $model->getAttributeLabel('description'),
                'rows' => 12,
            )); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>
    </div>        
</div>
<?php $this->endWidget(); ?>
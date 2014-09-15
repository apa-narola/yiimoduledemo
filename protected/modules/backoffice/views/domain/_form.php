<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'form-domain-edit',
    'action' => isset($modal) ? array('create') : null,
    'htmlOptions' => array(
        'role' => 'form',
    ),
)); ?>

<div class="row">
    <div class="col-sm-6">
        <h4 class="small-title">GENERAL INFORMATION</h4>
        <?php $this->renderPartial('_form_general', get_defined_vars()); ?>
    </div>
    
    <div class="col-sm-6">
        <h4 class="small-title">DOMAIN CONFIGURATION</h4>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#metadata" role="tab" data-toggle="tab">METADATA</a></li>
            <li><a href="#opening" role="tab" data-toggle="tab">OPENING</a></li>
            <li><a href="#reservation" role="tab" data-toggle="tab">RESERVATION</a></li>
            <li><a href="#payments" role="tab" data-toggle="tab">PAYMENTS</a></li>
            <li><a href="#service" role="tab" data-toggle="tab">SERVICE</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content the-box no-border">
            <div class="tab-pane active" id="metadata">
                <?php $this->renderPartial('_form_metadata', get_defined_vars()); ?>
            </div>
            <div class="tab-pane" id="opening">
                <?php $this->renderPartial('_form_opening', get_defined_vars()); ?>
            </div>
            <div class="tab-pane" id="reservation">
                <?php $this->renderPartial('_form_reservation', get_defined_vars()); ?>
            </div>
            <div class="tab-pane" id="payments">
                <?php $this->renderPartial('_form_payments', get_defined_vars()); ?>
            </div>
            <div class="tab-pane" id="service">
                <?php $this->renderPartial('_form_service', get_defined_vars()); ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <hr>
        <div class="form-group">
            <?php echo CHtml::link('Cancel', array('index'), array(
                'class' => 'btn btn-default',
            )); ?>
            <?php echo CHtml::submitButton('Save', array(
                'class' => 'btn btn-primary',
            )); ?>
            <?php if (!$model->isNewRecord && Yii::app()->user->checkAccess('Backoffice.Domain.Delete')): ?>
            <?php echo CHtml::link('Delete', array('delete', 'id' => $model->primaryKey), array(
                'class' => 'btn btn-danger',
                'confirm' => 'Are you sure you want to delete this item?',
            )); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>



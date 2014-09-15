<?php
/** 
 * @var $this BankController 
 * @var $societe Banque 
 */

$this->pageTitle = $model->entityLabel;
$this->pageDescription = null;

$this->breadcrumbs = array(
    'Backoffice' => array('/backoffice/default/index'),
    $model->entityLabelPlural => array('/backoffice/domain/index'),
    $this->pageTitle
);

?>

<div class="the-box no-border">
    <div class="row" role="toolbar">
        <div class="col-sm-8 btn-toolbar top-table">
            <div class="btn-group">
                <?php if (Yii::app()->user->checkAccess('Backoffice.Domain.Create')) : ?>
                <?php echo CHtml::link('<i class="fa fa-plus"></i> Create', array('create'), array(
                    'class' => 'btn btn-primary',
                )); ?>
                <?php endif; ?>
                
                <?php if (Yii::app()->user->checkAccess('Backoffice.Domain.Update')) : ?>
                <?php echo CHtml::link('<i class="fa fa-edit"></i> Update', array('update', 'id' => $model->primaryKey), array(
                    'class' => 'btn btn-success',
                )); ?>
                <?php endif; ?>
            </div>
            
            <div class="btn-group">
                <?php if (Yii::app()->user->checkAccess('Backoffice.Domain.Delete')) : ?>
                <?php echo CHtml::link('<i class="fa  fa-trash-o"></i> Delete', array('delete', 'id' => $model->primaryKey), array(
                    'class' => 'btn btn-danger',
                    'confirm' => 'Are you sure you want to delete this item?',
                )); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-4 form-horizontal">
            <div class="the-box">
                <h4 class="small-title">GENERAL INFORMATION</h4>
                <?php $this->renderPartial('_view_general', get_defined_vars()); ?>
            </div>
        </div>
        <div class="col-sm-8 form-horizontal">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#metadata" role="tab" data-toggle="tab">METADATA</a></li>
                <li><a href="#opening" role="tab" data-toggle="tab">OPENING</a></li>
                <li><a href="#reservation" role="tab" data-toggle="tab">RESERVATION</a></li>
                <li><a href="#payments" role="tab" data-toggle="tab">PAYMENTS</a></li>
                <li><a href="#service" role="tab" data-toggle="tab">SERVICE</a></li>
            </ul>

            <div class="tab-content the-box no-border">
                <div class="tab-pane active" id="metadata">
                    <?php $this->renderPartial('_view_metadata', get_defined_vars()); ?>
                </div>
                <div class="tab-pane" id="opening">
                    <?php $this->renderPartial('_view_opening', get_defined_vars()); ?>
                </div>
                <div class="tab-pane" id="reservation">
                    <?php $this->renderPartial('_view_reservation', get_defined_vars()); ?>
                </div>
                <div class="tab-pane" id="payments">
                    <?php $this->renderPartial('_view_payments', get_defined_vars()); ?>
                </div>
                <div class="tab-pane" id="service">
                    <?php $this->renderPartial('_view_service', get_defined_vars()); ?>
                </div>
            </div>
        </div>
    </div>
</div>
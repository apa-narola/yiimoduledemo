<?php
/** 
 * @var $this ServiceController 
 * 
 */

$this->pageTitle = $model->entityLabel;
$this->pageDescription = null;

$this->breadcrumbs = array(
    'Backoffice' => array('/backoffice/default/index'),
    $this->pageTitle,
);

?>

<div class="the-box no-border">
    <div class="row">
        <div class="col-sm-8 btn-toolbar" role="toolbar">
            <?php if (Yii::app()->user->checkAccess('Backoffice.Country.Create')) : ?>
            <div class="btn-group">
                <?php echo CHtml::link('<i class="fa fa-plus"></i> Create', array('create'), array(
                    'class' => 'btn btn-success',
                )); ?>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="col-sm-4 pull-right text-right">
            <?php $this->widget('application.widgets.GridSummaryText', array(
                'dataProvider' => $dataProvider,
            )); ?>
        </div>
    </div>
    
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $dataProvider,
        'columns' => array(
            array(
                'name' => 'title',
            ),
            array(
                'name' => 'code',
            ),
            array(
                'name' => 'type',
                'value' => 'PropertyValue::enumValue("ServiceTypeEnumerable", $data->type)',
            ),
            array(
                'name' => 'status',
                'value' => 'PropertyValue::enumValue("StatusEnumerable", $data->status)',
            ),
            array(
                'name' => 'description_fr',
            ),
            array(
                'class' => 'application.widgets.ButtonColumn',
                'template' => '<div class="btn-group pull-right">{update} {delete}</div>',
                'buttons' => array(
                    'update' => array(
                        'visible' => 'Yii::app()->user->checkAccess("Backoffice.Country.Update")',
                    ),
                    'delete' => array(
                        'visible' => 'Yii::app()->user->checkAccess("Backoffice.Country.Delete")',
                    ),
                ),
            ),
        ),
    )); ?>
</div>

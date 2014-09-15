<?php
/** 
 * @var $this SocieteController 
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
    <div class="row btn-toolbar top-table" role="toolbar">
        <div class="col-sm-8">
            <?php if (Yii::app()->user->checkAccess('Backoffice.Societe.Create')) : ?>
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
            'name',
            array(
                'header' => 'Account',
                'name' => 'account_name',
                'type' => 'raw',
                'value' => '$data->account ? CHtml::link($data->account->name, array("/backoffice/entities/account/view", "id" => $data->account->primaryKey)) : ""',
            ),
            array(
                'header' => 'Language',
                'name' => 'language_name',
                'type' => 'raw',
                'value' => '$data->langue ? $data->langue->name : ""',
            ),
            'env',
            array(
                'name' => 'fashion',
                'value' => 'PropertyValue::enumValue("DomainModeEnumerable", $data->fashion)',
            ),
            array(
                'name' => 'application_type',
                'type' => 'raw',
                'value' => '$data->applicationType ? $data->applicationType->name : "None"',
            ),
            'theme',
            array(
                'class' => 'application.widgets.ButtonColumn',
                'template' => '<div class="btn-group pull-right">{view} {update} {delete}</div>',
                'buttons' => array(
                    'view' => array(
                        'visible' => 'Yii::app()->user->checkAccess("Backoffice.Domain.View")',
                    ),
                    'update' => array(
                        'visible' => 'Yii::app()->user->checkAccess("Backoffice.Domain.Update")',
                    ),
                    'delete' => array(
                        'visible' => 'Yii::app()->user->checkAccess("Backoffice.Domain.Delete")',
                    ),
                ),
            ),
        ),
    )); ?>
    
</div>
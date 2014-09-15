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
            'ville',
            array(
                'name' => 'country',
                'type' => 'raw',
                'value' => '$data->country ? $data->country->name: ""',
                'header' => 'Pays',
            ),
            
            array(
                'name' => 'phone_fixe',
                'value' => '$data->phone_fixe?$data->phone_fixe:null',
            ),
            array(
                'name' => 'email',
                'value' => '$data->email?$data->email:null',
            ),
            array(
                'name' => 'manager_firstname',
                'value' => '$data->manager_firstname?$data->manager_firstname:null',
            ),
            array(
                'name' => 'manager_lastname',
                'value' => '$data->manager_lastname?$data->manager_lastname:null',
            ),
            array(
                'class'=>'CLinkColumn',
                'label' => 'banques',
                'urlExpression'=>'"/backoffice/bank/index?Banque[societe_id]=".$data->id',
                'labelExpression' => '"Banques (".$data->banquesCount.")"',
                'header' => 'Banques',
            ),
            array(
                'class' => 'application.widgets.ButtonColumn',
                'template' => '<div class="btn-group pull-right">{view} {update} {delete}</div>',
                'buttons' => array(
                    'view' => array(
                        'visible' => 'Yii::app()->user->checkAccess("Backoffice.Societe.View")',
                    ),
                    'update' => array(
                        'visible' => 'Yii::app()->user->checkAccess("Backoffice.Societe.Update")',
                    ),
                    'delete' => array(
                        'visible' => 'Yii::app()->user->checkAccess("Backoffice.Societe.Delete")',
                    ),
                ),
            ),
        ),
    )); ?>
    
</div>
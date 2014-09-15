<?php
/** 
 * @var $this UserController 
 * 
 */

$this->pageTitle = $model->entityLabel;
$this->pageDescription = null;

$this->breadcrumbs = array(
    'Backoffice' => array('/backoffice/default/index'),
    $this->pageTitle,
);

?>

<?php $this->widget('application.widgets.ModalView', array(
    'id' => 'create-bank',
    'title' => 'New ' . $model->entityLabelSingular,
    'visible' => Yii::app()->user->checkAccess('Backoffice.Bank.Create'),
    'content' => $this->renderPartial('_form', array(
        'model' => $model,
        'modal' => true,
    ), true),
    'buttons' => array(
        array(
            'label' => 'Save',
            'class' => 'btn btn-primary',
            'onclick' => '$("#form-bank-edit").submit()',
        ),
    ),
)); ?>

<div class="the-box no-border">
    <div class="row">
        <div class="col-sm-8 btn-toolbar" role="toolbar">
            <?php if (Yii::app()->user->checkAccess('Backoffice.Bank.Create')) : ?>
            <div class="btn-group">
                <?php echo CHtml::link('<i class="fa fa-plus"></i> Create', '#', array(
                    'class' => 'btn btn-success',
                    'data-toggle' => 'modal',
                    'data-target' => '#create-bank',
                )); ?>
            </div>
            <?php endif; ?>
            
            <div class="btn-group">
                
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'form-bank-filter',
                    'method' => 'get',
                    'htmlOptions' => array(
                        'role' => 'form',
                    ),
                )); ?>
                
                <?php echo $form->dropDownList($model, 'societe_id', PropertyValue::enumListData('Societe', true, 'id', 'name'), array(
                    'class' => 'form-control',
                    'empty' => 'Any Societe',
                    'data-placeholder' => "Choose a Societe...",
                    'onchange' => 'js:$("#form-bank-filter").submit();',
                )); ?>
                
                <?php $this->endWidget(); ?>
            </div>
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
            'beneficiaire',
            array(
                'header' => 'Societe',
                'name' => 'societe_name',
                'type' => 'raw',
                'value' => '$data->societe ? CHtml::link($data->societe->name, array("/backoffice/societe/view", "id" => $data->societe->primaryKey)) : ""',
            ),
            'code_iban',
            'code_bic',
            array(
                'name' => 'status',
                'value' => 'PropertyValue::enumValue("StatusEnumerable", $data->status)',
            ),
            array(
                'class' => 'application.widgets.ButtonColumn',
                'template' => '<div class="btn-group pull-right">{view} {update} {delete}</div>',
                'buttons' => array(
                    'view' => array(
                        'visible' => 'Yii::app()->user->checkAccess("Backoffice.Bank.View")',
                    ),
                    'update' => array(
                        'visible' => 'Yii::app()->user->checkAccess("Backoffice.Bank.Update")',
                    ),
                    'delete' => array(
                        'visible' => 'Yii::app()->user->checkAccess("Backoffice.Bank.Delete")',
                    ),
                ),
            ),
        ),
    )); ?>
    
</div>
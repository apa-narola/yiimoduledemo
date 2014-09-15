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
    'id' => 'create-country',
    'title' => 'New ' . $model->entityLabelSingular,
    'visible' => Yii::app()->user->checkAccess('Backoffice.Country.Create'),
    'content' => $this->renderPartial('_form', array(
        'model' => $model,
        'modal' => true,
    ), true),
    'buttons' => array(
        array(
            'label' => 'Save',
            'class' => 'btn btn-primary',
            'onclick' => '$("#form-country-edit").submit()',
        ),
    ),
)); ?>

<div class="the-box no-border">
    <div class="row">
        <div class="col-sm-8 btn-toolbar" role="toolbar">
            <?php if (Yii::app()->user->checkAccess('Backoffice.Country.Create')) : ?>
            <div class="btn-group">
                <?php echo CHtml::link('<i class="fa fa-plus"></i> Create', '#', array(
                    'class' => 'btn btn-success',
                    'data-toggle' => 'modal',
                    'data-target' => '#create-country',
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
                'name' => 'ISO3',
            ),
            array(
                'name' => 'ISO2',
            ),
            array(
                'name' => 'name',
            ),
            array(
                'name' => 'name_fr',
            ),
            array(
                'name' => 'name_es',
            ),
            array(
                'name' => 'nationality',
            ),
            array(
                'name' => 'prefixe_international',
            ),
            array(
                'name' => 'featured',
            ),
            array(
                'name' => 'display_order',
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

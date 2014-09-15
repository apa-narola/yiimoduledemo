<?php
/**
 * @var $this GroupController 
 * 
 */

$this->pageTitle = '<i class="fa fa-group"></i>Groups Management';
$this->pageDescription = 'Manage groups, membership and properties';

$this->breadcrumbs = array(
    'Backoffice' => array('/backoffice/default/index'),
    'Groups Management',
);

?>

<?php $this->widget('application.widgets.ModalView', array(
    'id' => 'create-role',
    'title' => 'New Group',
    'visible' => Yii::app()->user->checkAccess('User.Groups.Create'),
    'content' => $this->renderPartial('_form', get_defined_vars(), true),
    'buttons' => array(
        array(
            'label' => 'Save',
            'class' => 'btn btn-primary',
            'onclick' => '$("#form-user-group").submit()',
        ),
    ),
)); ?>

<div class="the-box no-border">
    
    <div class="row btn-toolbar top-table" role="toolbar">
        <div class="col-sm-8">
            <?php if (Yii::app()->user->checkAccess('User.Groups.Create')) : ?>
            <div class="btn-group">
                <?php echo CHtml::link('<i class="fa fa-plus"></i> Add new group', '#', array(
                    'class' => 'btn btn-success',
                    'data-toggle' => 'modal',
                    'data-target' => '#create-role',
                )); ?>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="col-sm-4 pull-right text-right">
            <?php $this->widget('application.widgets.GridSummaryText', array(
                'dataProvider' => $groups,
            )); ?>
        </div>
    </div>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $groups,
        'columns' => array(
            array(
                'name' => 'Name',
                'type' => 'raw',
                'value' => 'CHtml::encode($data["name"])'
            ),
            array(
                'name' => 'Description',
                'type' => 'raw',
                'value' => 'CHtml::encode($data["description"])'
            ),
            array(
                'name' => 'Members',
                'type' => 'raw',
                'value' => 'CHtml::encode($data["usersCount"])',
            ),
            array(
                'class' => 'application.widgets.ButtonColumn',
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view",array("id"=>$data["id"]))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("id"=>$data["id"]))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete",array("id"=>$data["id"]))',
                'template' => '<div class="btn-group pull-right">{view} {update} {nodelete} {delete}</div>',
                'buttons' => array(
                    'nodelete' => array(
                        'label' => 'Delete',
                        'options' => array(
                            'class' => 'btn btn-xs btn-default disabled',
                        ),
                        'visible' => 'Yii::app()->authManager->getIsSystemRole($data["name"]) && Yii::app()->user->checkAccess("User.Groups.Delete")',
                    ),
                    'update' => array(
                        'visible' => 'Yii::app()->user->checkAccess("User.Groups.Update")',
                    ),
                    'delete' => array(
                        'visible' => '!Yii::app()->authManager->getIsSystemRole($data["name"]) && Yii::app()->user->checkAccess("User.Groups.Delete")',
                    ),
                    'view' => array(
                        'visible' => 'false',
                    ),
                ),
            ),
        ),
    )); ?>

</div>
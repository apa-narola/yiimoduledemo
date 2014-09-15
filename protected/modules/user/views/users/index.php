<?php
/** 
 * @var $this UserController 
 * 
 */

$this->pageTitle = 'Users Management';
$this->pageDescription = 'Manage user accounts and passwords';

$this->breadcrumbs = array(
    'Backoffice' => array('/backoffice/default/index'),
    'Users Management',
);

?>

<div class="the-box no-border">
    <div class="row btn-toolbar top-table" role="toolbar">
        <div class="col-sm-8">
            <?php if (Yii::app()->user->checkAccess('User.Users.Create')) : ?>
            <div class="btn-group">
                <?php echo CHtml::link('<i class="fa fa-plus"></i> Add new user', array('create'), array(
                    'class' => 'btn btn-success',
                )); ?>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="col-sm-4 pull-right text-right">
            <?php $this->widget('application.widgets.GridSummaryText', array(
                'dataProvider' => $users,
            )); ?>
        </div>
    </div>
    
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $users,
        'columns' => array(
            'username',
            'email',
            'prenom',
            'name',
            array(
                'name' => 'agency',
                'value' => '$data->agency?$data->agency->company:null',
            ),
            
            array(
                'class' => 'application.widgets.ButtonColumn',
                'template' => '<div class="btn-group pull-right">{view} {update} {nodelete} {delete}</div>',
                'buttons' => array(
                    'nodelete' => array(
                        'label' => 'Delete',
                        'options' => array(
                            'class' => 'btn btn-xs btn-default disabled',
                        ),
                        'visible' => 'Yii::app()->user->checkAccess("User.Users.Delete") && Yii::app()->user->id == $data->id',
                    ),
                    'update' => array(
                        'visible' => 'Yii::app()->user->checkAccess("User.Users.Update")',
                    ),
                    'delete' => array(
                        'visible' => 'Yii::app()->user->checkAccess("User.Groups.Delete") && Yii::app()->user->id != $data->id',
                    ),
                ),
            ),
        ),
    )); ?>
</div>
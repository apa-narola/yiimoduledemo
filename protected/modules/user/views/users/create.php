<?php
/** 
 * @var $this UserController 
 * 
 */

$this->pageTitle = 'Create new user';
$this->pageDescription = null;

$this->breadcrumbs = array(
    'Backoffice' => array('/backoffice/default/index'),
    'Users Management' => array('/backoffice/user/users/index'),
    $this->pageTitle
);

?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'form-user-create',
    'action' => array('create'),
    'htmlOptions' => array (
    ),
)); ?>
<div class="row">
    <div class="col-sm-8">
        <div class="the-box">
            <h4 class="small-title">USER DETAILS</h4>
            <?php $this->renderPartial('_form', get_defined_vars()); ?>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="the-box">
            <h4 class="small-title">USER GROUPS</h4>
            <?php $this->renderPartial('_groups', array(
                'model' => $model,
                'groups' => $groups,
            )); ?>
            
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>
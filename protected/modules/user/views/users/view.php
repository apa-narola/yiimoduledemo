<?php
/** 
 * @var $this UserController 
 * 
 */

$this->pageTitle = 'User' . '&nbsp;&laquo;' . $model->username . '&raquo;';
$this->pageDescription = null;

$this->breadcrumbs = array(
    'Backoffice' => array('/backoffice/default/index'),
    'Users Management' => array('/backoffice/user/users/index'),
    $this->pageTitle,
);

?>

<div class="row">
    <div class="col-sm-8">
        <div class="the-box">
            <h4 class="small-title">USER DETAILS</h4>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="the-box">
            <h4 class="small-title">USER GROUPS</h4>
        </div>
    </div>
</div>
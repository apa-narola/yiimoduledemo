<?php
/** 
 * @var $this SocieteController 
 * 
 */

$this->pageTitle = $model->entityLabel;
$this->pageDescription = null;

$this->breadcrumbs = array(
    'Backoffice' => array('/backoffice/default/index'),
    'Banks' => array('/backoffice/bank/index'),
    $this->pageTitle
);

?>
<div class="row">
    <div class="col-sm-12">
        <div class="the-box">
            <?php $this->renderPartial('_form', array(
                'model' => $model,
            )); ?>
        </div>
    </div>
</div>

<?php
/** 
 * @var $this SocieteController 
 * 
 */

$this->pageTitle = $model->entityLabel;
$this->pageDescription = null;

$this->breadcrumbs = array(
    'Backoffice' => array('/backoffice/default/index'),
    $model->entityLabelPlural => array('/backoffice/societe/index'),
    $this->pageTitle
);


?>

<div class="row">
    <div class="col-sm-8">
        <div class="the-box">
            <h4 class="small-title">GENERAL INFORMATION</h4>
            <?php $this->renderPartial('_form', get_defined_vars()); ?>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="the-box banque-form">
            <?php $this->renderPartial('_bank_info', array(
                'model' => new Banque,
                'societe' => $model,
                'bankList' => $bankList,
            )); ?>
        </div>
    </div>
</div>

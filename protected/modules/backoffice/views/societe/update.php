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


<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'form-societe-edit',
    'htmlOptions' => array (
        'role' => 'form',
    ),
)); ?>

<div class="row">
    <div class="col-sm-6">
        <div class="the-box">
            <h4 class="small-title">GENERAL INFORMATION</h4>
            <?php $this->renderPartial('_form', get_defined_vars()); ?>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="the-box banque-form">
            
            <?php $this->renderPartial('_bank_info', array(
                'model' => new Banque,
                'societe' => $model,
                'bankList' => $bankList,
            )); ?>
            
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

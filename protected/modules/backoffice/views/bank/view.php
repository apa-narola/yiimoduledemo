<?php
/** 
 * @var $this BankController 
 * @var $societe Banque 
 */

$this->pageTitle = $model->entityLabel;
$this->pageDescription = null;

$this->breadcrumbs = array(
    'Backoffice' => array('/backoffice/default/index'),
    $model->entityLabelPlural => array('/backoffice/bank/index'),
    $this->pageTitle
);

?>

<div class="the-box no-border">
    <div class="row" role="toolbar">
        <div class="col-sm-8 btn-toolbar top-table">
            <div class="btn-group">
                <?php if (Yii::app()->user->checkAccess('Backoffice.Bank.Create')) : ?>
                <?php echo CHtml::link('<i class="fa fa-plus"></i> Create', array('create', 'sid' => $societe->primaryKey), array(
                    'class' => 'btn btn-primary',
                )); ?>
                <?php endif; ?>
                
                <?php if (Yii::app()->user->checkAccess('Backoffice.Bank.Update')) : ?>
                <?php echo CHtml::link('<i class="fa fa-edit"></i> Update', array('update', 'id' => $model->primaryKey), array(
                    'class' => 'btn btn-success',
                )); ?>
                <?php endif; ?>
            </div>
            
            <div class="btn-group">
                <?php if (Yii::app()->user->checkAccess('Backoffice.Bank.Delete')) : ?>
                <?php echo CHtml::link('<i class="fa  fa-trash-o"></i> Delete', array('delete', 'id' => $model->primaryKey), array(
                    'class' => 'btn btn-danger',
                    'confirm' => 'Are you sure you want to delete this item?',
                )); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-4 form-horizontal">
            <div class="the-box">
                <h4 class="small-title">BANK INFORMATION</h4>
                <div class="form-group">
                    <?php echo CHtml::activeLabel($model, 'beneficiaire', array(
                        'class' => 'col-sm-3 control-label',
                    )) ;?>
                    <p class="form-control-static col-sm-9"><?php echo $model->beneficiaire; ?></p>
                </div>
                <div class="form-group">
                    <?php echo CHtml::activeLabel($model, 'code_iban', array(
                        'class' => 'col-sm-3 control-label',
                    )) ;?>
                    <p class="form-control-static col-sm-9"><?php echo $model->code_iban; ?></p>
                </div>
                
                <div class="form-group">
                    <?php echo CHtml::activeLabel($model, 'code_bic', array(
                        'class' => 'col-sm-3 control-label',
                    )) ;?>
                    <p class="form-control-static col-sm-9"><?php echo $model->code_bic; ?></p>
                </div>
                
                <div class="form-group">
                    <?php echo CHtml::activeLabel($model, 'status', array(
                        'class' => 'col-sm-3 control-label',
                    )) ;?>
                    <p class="form-control-static col-sm-9"><?php echo PropertyValue::enumValue('StatusEnumerable', $model->status); ?></p>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="the-box form-horizontal">
                <h4 class="small-title">SOCIETE</h4>
                <?php if ($societe): ?>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($societe, 'name', array(
                                'class' => 'col-sm-3 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-9"><?php echo CHtml::link($societe->name, array("/backoffice/societe/view", "id" => $societe->primaryKey))   ; ?></p>
                        </div>
                        
                        
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($societe, 'manager_firstname', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $societe->manager_firstname; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($societe, 'postal_code', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $societe->postal_code; ?></p>
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($societe, 'Pays', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $societe->country ? $societe->country->name : ''; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($societe, 'manager_firstname', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $societe->manager_firstname; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($societe, 'ville', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $societe->ville; ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($societe, 'address', array(
                                'class' => 'col-sm-2 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-9"><?php echo $societe->address; ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($societe, 'phone_fixe', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $societe->phone_fixe; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($societe, 'fax', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $societe->fax; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($societe, 'email', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $societe->email; ?></p>
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($societe, 'phone_mobile', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $societe->phone_mobile; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($societe, 'siret', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $societe->siret; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($societe, 'n_tvai', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $societe->n_tvai; ?></p>
                        </div>
                        
                    </div>
                </div>
                
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
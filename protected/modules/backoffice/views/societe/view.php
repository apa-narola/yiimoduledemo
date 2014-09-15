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

<div class="the-box no-border">
    <div class="row" role="toolbar">
        <div class="col-sm-8 btn-toolbar top-table">
            <div class="btn-group">
                <?php if (Yii::app()->user->checkAccess('Backoffice.Societe.Create')) : ?>
                <?php echo CHtml::link('<i class="fa fa-plus"></i> Create', array('create'), array(
                    'class' => 'btn btn-primary',
                )); ?>
                <?php endif; ?>
                
                <?php if (Yii::app()->user->checkAccess('Backoffice.Societe.Update')) : ?>
                <?php echo CHtml::link('<i class="fa fa-edit"></i> Update', array('update', 'id' => $model->primaryKey), array(
                    'class' => 'btn btn-success',
                )); ?>
                <?php endif; ?>
            </div>
            
            <div class="btn-group">
                <?php if (Yii::app()->user->checkAccess('Backoffice.Societe.Delete')) : ?>
                <?php echo CHtml::link('<i class="fa  fa-trash-o"></i> Delete', array('delete', 'id' => $model->primaryKey), array(
                    'class' => 'btn btn-danger',
                    'confirm' => 'Are you sure you want to delete this item?',
                )); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-7 form-horizontal">
            <div class="the-box">
                <h4 class="small-title">GENERAL INFORMATION</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($model, 'name', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $model->name; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($model, 'manager_firstname', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $model->manager_firstname; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($model, 'postal_code', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $model->postal_code; ?></p>
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($model, 'country_id', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $model->country ? $model->country->name : ''; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($model, 'manager_lastname', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $model->manager_lastname; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($model, 'ville', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $model->ville; ?></p>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($model, 'address', array(
                                'class' => 'col-sm-2 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-9"><?php echo $model->address; ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($model, 'phone_fixe', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $model->phone_fixe; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($model, 'fax', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $model->fax; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($model, 'email', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $model->email; ?></p>
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($model, 'phone_mobile', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $model->phone_mobile; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($model, 'siret', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $model->siret; ?></p>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::activeLabel($model, 'n_tvai', array(
                                'class' => 'col-sm-5 control-label',
                            )) ;?>
                            <p class="form-control-static col-sm-7"><?php echo $model->n_tvai; ?></p>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-sm-5">
            <div class="the-box">
            <?php $this->renderPartial('_bank_info', array(
                'model' => new Banque,
                'societe' => $model,
                'bankList' => $bankList,
            )); ?>
            </div>
        </div>
    </div>
</div>
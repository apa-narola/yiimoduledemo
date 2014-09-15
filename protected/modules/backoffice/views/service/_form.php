<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'form-service-edit',
    'action' => isset($modal) ? array('create') : null,
    'htmlOptions' => array(
        'role' => 'form',
    ),
)); ?>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <h4 class="small-title">GENERAL INFORMATION</h4>
            <?php echo $form->label($model, 'title') ;?>
            <?php echo $form->textField($model, 'title', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'code') ;?>
            <?php echo $form->textField($model, 'code', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'code'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'status') ;?>
            <div class="input-group">
            <?php echo $form->radioButtonList($model, 'status', PropertyValue::enumListData('StatusEnumerable', false), array(
                'template' => '<label class="radio-inline">{input} {label}</label>',
                'separator' => false,
            )); ?>
            </div>
            <?php echo $form->error($model, 'status'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'type') ;?>
            <?php echo $form->dropDownList($model, 'type', PropertyValue::enumListData('ServiceTypeEnumerable'), array(
                'class' => 'form-control',
            )); ?>
            <?php echo $form->error($model, 'type'); ?>
        </div>
    </div>
    
    <div class="col-sm-8">
        <h4 class="small-title">DESCRIPTION</h4>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#description_en" role="tab" data-toggle="tab">DESCRIPTION EN</a></li>
            <li><a href="#description_fr" role="tab" data-toggle="tab">DESCRIPTION FR</a></li>
            <li><a href="#description_es" role="tab" data-toggle="tab">DESCRIPTION ES</a></li>
            <li><a href="#description_it" role="tab" data-toggle="tab">DESCRIPTION IT</a></li>
            <li><a href="#description_nl" role="tab" data-toggle="tab">DESCRIPTION NL</a></li>
            <li><a href="#description_de" role="tab" data-toggle="tab">DESCRIPTION DE</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content the-box no-border">
            <div class="tab-pane active" id="description_en">
                <div class="form-group">
                    <?php echo $form->textArea($model, 'description_en', array(
                        'class' => 'form-control',
                        'rows' => 4,
                    )) ;?>
                    <?php echo $form->error($model, 'description_en'); ?>
                </div>
            </div>
            <div class="tab-pane" id="description_fr">
                <div class="form-group">
                    <?php echo $form->textArea($model, 'description_fr', array(
                        'class' => 'form-control',
                        'rows' => 4,
                    )) ;?>
                    <?php echo $form->error($model, 'description_fr'); ?>
                </div>
            </div>
            <div class="tab-pane" id="description_es">
                <div class="form-group">
                    <?php echo $form->textArea($model, 'description_es', array(
                        'class' => 'form-control',
                        'rows' => 4,
                    )) ;?>
                    <?php echo $form->error($model, 'description_es'); ?>
                </div>
            </div>
            <div class="tab-pane" id="description_it">
                <div class="form-group">
                    <?php echo $form->textArea($model, 'description_it', array(
                        'class' => 'form-control',
                        'rows' => 4,
                    )) ;?>
                    <?php echo $form->error($model, 'description_it'); ?>
                </div>
            </div>
            <div class="tab-pane" id="description_nl">
                <div class="form-group">
                    <?php echo $form->textArea($model, 'description_nl', array(
                        'class' => 'form-control',
                        'rows' => 4,
                    )) ;?>
                    <?php echo $form->error($model, 'description_nl'); ?>
                </div>
            </div>
            <div class="tab-pane" id="description_de">
                <div class="form-group">
                    <?php echo $form->textArea($model, 'description_de', array(
                        'class' => 'form-control',
                        'rows' => 4,
                    )) ;?>
                    <?php echo $form->error($model, 'description_de'); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if(!isset($modal)): ?>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <?php echo CHtml::link('Cancel', array('index'), array(
                'class' => 'btn btn-default',
            )); ?>
            <?php echo CHtml::submitButton('Save', array(
                'class' => 'btn btn-primary',
            )); ?>
            <?php if (!$model->isNewRecord && Yii::app()->user->checkAccess('Backoffice.Service.Delete')): ?>
            <?php echo CHtml::link('Delete', array('delete', 'id' => $model->primaryKey), array(
                'class' => 'btn btn-danger',
                'confirm' => 'Are you sure you want to delete this item?',
            )); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php endif; ?>

<?php $this->endWidget(); ?>



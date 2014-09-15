<h4 class="small-title">BANK INFORMATION
    <div class="pull-right">
        <a href="#" class="btn btn-primary btn-sm" data-action="bank-create"><i class="fa fa-plus"></i></a>
    </div>
</h4>

<div data-action="bank-create" style="display: none;">
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'form-bank-edit',
    'action' => array('bank'),
    'htmlOptions' => array(
        'role' => 'form',
    ),
)); ?>

<div class="row">
    <div class="col-sm-12">
        <?php echo CHtml::hiddenField('callback', Yii::app()->request->url); ?>
        <div id="form-societe-edit-state"></div>
        <?php echo $form->hiddenField($model, 'societe_id', array(
            'value' => $societe->primaryKey
        )); ?>
        
        <div class="form-group">
            <?php echo $form->label($model, 'beneficiaire') ;?>
            <?php echo $form->textField($model, 'beneficiaire', array(
                'class' => 'form-control',
            )) ;?>
            <?php echo $form->error($model, 'beneficiaire'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'code_iban') ;?>
            <?php echo $form->textArea($model, 'code_iban', array(
                'class' => 'form-control',
                'rows' => 3,
            )) ;?>
            <?php echo $form->error($model, 'code_iban'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'code_bic') ;?>
            <?php echo $form->textArea($model, 'code_bic', array(
                'class' => 'form-control',
                'rows' => 3,
            )) ;?>
            <?php echo $form->error($model, 'code_bic'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($model, 'status') ;?>
            <div class="input-group">
            <?php echo $form->radioButtonList($model, 'status', PropertyValue::enumListData('StatusEnumerable', false), array(
                'template' => '<label class="radio-inline">{input}{label}</label>',
                'separator' => false,
            )); ?>
            </div>
            <?php echo $form->error($model, 'status'); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <?php echo CHtml::submitButton('Save', array(
                'class' => 'btn btn-primary',
            )); ?>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $bankList,
    'columns' => array(
        'beneficiaire',
        'code_iban',
        'code_bic',
        array(
            'name' => 'status',
            'value' => 'PropertyValue::enumValue("StatusEnumerable", $data->status)',
        ),
        array(
            'class' => 'application.widgets.ButtonColumn',
            'visible' => !$societe->isNewRecord,
            'template' => '<div class="btn-group pull-right">{view} {update} {delete}</div>',
            'buttons' => array(
                'view' => array(
                    'visible' => 'Yii::app()->user->checkAccess("Backoffice.Bank.View")',
                    'url' => 'CHtml::normalizeUrl(array("/backoffice/bank/view", "id"=>$data->primaryKey))',
                ),
                'update' => array(
                    'visible' => 'Yii::app()->user->checkAccess("Backoffice.Bank.Update")',
                    'url' => 'CHtml::normalizeUrl(array("/backoffice/bank/update", "id"=>$data->primaryKey))',
                ),
                'delete' => array(
                    'visible' => 'Yii::app()->user->checkAccess("Backoffice.Bank.Delete")',
                    'url' => 'CHtml::normalizeUrl(array("/backoffice/bank/delete", "id"=>$data->primaryKey))',
                ),
            ),
        ),
    ),
)); ?>

<script type="text/javascript">
$(function(){
    $('a[data-action="bank-create"]').click(function(){
        $('div[data-action="bank-create"]').show();
        $('a[data-action="bank-create"]').hide();
    });
    $('#form-bank-edit').submit(function(e){
        $( "#form-societe-edit-state" ).empty();
        $.each( $('#form-societe-edit').serializeArray(), function( i, field ) {
            $( "#form-societe-edit-state" ).append( $('<input type="hidden">').val(field.value).attr('name', field.name) );
        });
    });
});
</script>

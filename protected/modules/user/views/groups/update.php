<?php
/**
 * @var $this GroupController 
 * 
 */

$this->pageTitle = 'Update Group &laquo;' . $model->name . '&raquo;';
$this->pageDescription = $model->description;

$this->breadcrumbs = array(
    'Backoffice' => array('/backoffice/default/index'),
    'Groups Management' => array('/backoffice/user/groups/index'),
    $model->name
);
?>

<div class="row">
    <div class="col-sm-4">
        <div class="the-box">
            <h4 class="small-title">GROUP PERMISSIONS</h4>
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'form-user-group',
            'action' => array('update', 'id' => $model->name),
            'htmlOptions' => array (
            ),
        )); ?>
        <div class="form-group">
            <div class="checkbox">
                <label for="select-all-permissions">
                <?php echo CHtml::checkBox('checkall', false, array(
                    'id' => 'select-all-permissions',
                )); ?>
                Grant all
                </label>
            </div>
        </div>
        <div class="form-group">
            <?php $this->widget('CTreeView', array('data' => $accessLevelTree));?>
        </div>
        <div class="form-group">
            <?php echo CHtml::submitButton('Update', array(
                'class' => 'btn btn-primary',
            )); ?>
        </div>
        <?php $this->endWidget(); ?>
        </div>
    </div>
    
    <div class="col-sm-8">
        <div class="the-box">
            <h4 class="small-title">GROUP MEMBERS</h4>
            
            <div class="form-group">
                <label for="assign-user-group">Add member to &laquo;<?php echo $model->name; ?>&raquo;</label>
                <select id="assign-user-group" data-placeholder="Choose a User..." class="form-control chosen-select">
                    <option></option>
                </select>
            </div>
            
            <?php $this->renderPartial('_group_members_list', array(
                'members' => $members
            )); ?>
        </div>
    </div>
</div>    
    

<script type="text/javascript">
$(function(){
    $('input#select-all-permissions').on('change', function(){
        $("input:checkbox[name^=role]").attr("checked", $(this).is(':checked'));
    });
    
    $('body').delegate('#user-group-revoke', 'click', function(e){
        e.preventDefault();
        var sender = $(e.currentTarget);
        
        if (!confirm('Do you really want to revoke access?')) {
            return;
        }
        
        $.post('<?php echo $this->createUrl('/backoffice/user/groups/revokeAccess'); ?>', {
            group: '<?php echo $model->name; ?>',
            user: sender.attr('href').replace('#', '')
        }, function(data){
            $.fn.yiiGridView.update("_group_members_list");
        });
    });
    
    $('#assign-user-group').ajaxChosen({
        type: 'GET',
        url: '<?php echo $this->createUrl('/backoffice/user/groups/findUser', array('group'=>$model->name)); ?>',
        dataType: 'json'
    }, function (data) {
        var results = [];
        $.each(data, function (i, val) {
            results.push({ value: i, text: val });
        });
        return results;
    }).chosen().change(function(e) {
        var sender = $(e.currentTarget);
        $.post('<?php echo $this->createUrl('/backoffice/user/groups/assignUser'); ?>', {
            group: '<?php echo $model->name; ?>',
            user: sender.val()
        }, function(data){
            sender.val('').trigger("chosen:updated");
            $.fn.yiiGridView.update("_group_members_list");
        });
    });
});
</script>    
	
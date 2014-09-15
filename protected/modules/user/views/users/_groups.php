<?php 
/**
 * @var $authManager CDbAuthManager
 * @var $groups array
 * @var $model User
 */

$authManager = Yii::app()->getAuthManager();

?>

<div class="row">
    <div class="col-sm-12">
        <?php foreach ($groups as $group) : ?>
        <div class="checkbox">
            <label>
                <?php echo CHtml::checkBox('role[]', $authManager->isAssigned($group['name'], $model->primaryKey), array(
                    'class' => 'i-grey',
                    'value' => $group['name'],
                )); ?>

                <?php echo CHtml::encode($group['name']); ?>
            </label>
        </div>
        <?php endforeach; ?>
    </div>
</div>

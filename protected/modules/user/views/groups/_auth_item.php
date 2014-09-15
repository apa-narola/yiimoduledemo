<?php
/**
 * @var $authItem CAuthItem
 */
?>

<?php if ($authItem->type == CAuthItem::TYPE_OPERATION): ?>
<label>
    <?php echo CHtml::checkBox('role[' . $authItem->name .']', in_array($authItem->name, CPropertyValue::ensureArray($role->data))); ?>&nbsp;<?php echo $authItem->description; ?>
</label>
<?php else: ?>
<p class="form-control-static">
    <?php echo ( CAuthItem::TYPE_ROLE == $authItem->type ) ? $authItem->name : $authItem->description; ?>
</p>

<?php endif; ?>

<?php
/**
 * @var $this ModalView
 */
?>

<div class="modal fade" id="<?php echo $this->id; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $this->id; ?>Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-<?php echo $this->size; ?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="<?php echo $this->id; ?>Label"><?php echo $title; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $content; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php foreach ($buttons as $label=>$button): ?>
        <?php echo CHtml::button($label, $button); ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
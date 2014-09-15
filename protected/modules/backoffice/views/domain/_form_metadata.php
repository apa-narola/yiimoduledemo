<div class="form-group">
    <?php echo $form->label($model, 'meta_title') ;?>
    <?php echo $form->textField($model, 'meta_title', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'meta_title'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'meta_keywords') ;?>
    <?php echo $form->textArea($model, 'meta_keywords', array(
        'class' => 'form-control',
        'rows' => 4,
    )) ;?>
    <?php echo $form->error($model, 'meta_keywords'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'meta_description') ;?>
    <?php echo $form->textArea($model, 'meta_description', array(
        'class' => 'form-control',
        'rows' => 4,
    )) ;?>
    <?php echo $form->error($model, 'meta_description'); ?>
</div>
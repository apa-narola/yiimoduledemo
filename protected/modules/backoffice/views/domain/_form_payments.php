
<div class="form-group">
    <?php echo $form->label($model, 'tax') ;?>
    <?php echo $form->textField($model, 'tax', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'tax'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'taux') ;?>
    <?php echo $form->textField($model, 'taux', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'taux'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'currency') ;?>
    <?php echo $form->textField($model, 'currency', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'currency'); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'symbole') ;?>
    <?php echo $form->textField($model, 'symbole', array(
        'class' => 'form-control',
    )) ;?>
    <?php echo $form->error($model, 'symbole'); ?>
</div>
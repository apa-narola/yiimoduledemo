<?php
    $this->layout = 'base';
    $this->pageTitle=Yii::app()->name;
?>


<div class="container">
    <div class="row">
        <div class="col-lg-12 page-header">
            <h1><?php echo Yii::t('user', 'Wellcome to'); ?> <strong><?php echo Yii::app()->name; ?></strong></h1>
        </div>
    </div>
    
    <div class="row separator"></div>
     
    <div class="row">
        <div class="col-lg-12">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
    </div>
     
     <div class="row">
        <div class="col-lg-6">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
         <div class="col-lg-6">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
    </div>
    
    <div class="row separator"></div>
    
    <div class="row">
        <div class="col-lg-2"></div>
        
        <strong><?php echo CHtml::link(Yii::t('user', 'Login'), array('/user/login'), array(
            'class' => 'btn btn-default btn-warning col-lg-2',
        ))?></strong>
        
        <div class="col-lg-4"></div>
        
        <strong><?php echo CHtml::link(Yii::t('user', 'Registration'), array('/user/registration'), array(
            'class' => 'btn btn-default btn-warning col-lg-2'
        ))?></strong>

        <div class="col-lg-2"></div>
    </div>
    
</div>

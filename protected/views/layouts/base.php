<?php 
    $bodyClass = str_replace('/', ' ', $this->route) . ' tooltips';
    
    Yii::app()->clientScript
        ->registerCoreScript('jquery')
        ->registerScriptFile('/lib/bootstrap/js/bootstrap.min.js', CClientScript::POS_END, array())
        ->registerCssFile('/lib/bootstrap/css/bootstrap.min.css');
    
?><html lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo Yii::app()->getParams()->itemAt('description'); ?>">
        <meta name="keywords" content="<?php echo Yii::app()->getParams()->itemAt('keywords'); ?>">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="<?php echo $bodyClass; ?>">
        <?php echo $content; ?>
    </body>
</html>

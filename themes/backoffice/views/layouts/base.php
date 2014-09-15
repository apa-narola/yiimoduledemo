<?php 
    $bodyClass = str_replace('/', ' ', $this->route) . ' tooltips top-navigation';
?><html lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo Yii::app()->getParams()->itemAt('meta_description'); ?>">
        <meta name="keywords" content="<?php echo Yii::app()->getParams()->itemAt('meta_keywords'); ?>">
        <title><?php echo CHtml::encode(strip_tags(trim($this->pageTitle))); ?></title>
        
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="<?php echo $bodyClass; ?>">
        <?php echo $content; ?>
    </body>
</html>

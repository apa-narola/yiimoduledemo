<?php $this->beginContent('//layouts/base'); ?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand"><?php echo Yii::app()->name; ?></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <?php $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array(
                    'class' => 'nav navbar-nav navbar-right'
                ),
                'encodeLabel' => false,
                'items' => array(
                    array('label' => 'About', 'url' => array('/site/page', 'view' => 'about'), 'visible' => Yii::app()->user->isGuest),
                    array('label' => 'Login', 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                    array(
                        'visible' => !Yii::app()->user->isGuest,
                        'label' => ('<span class="glyphicon glyphicon-user"></span> '
                                    . CHtml::encode(Yii::app()->user->name)
                                    . '&nbsp;<b class="caret"></b>' ),
                        'url' => 'javascript:;//',
                        'linkOptions' => array(
                            'class' => 'dropdown-toggle',
                            'data-toggle' => 'dropdown',
                        ),
                        'submenuOptions' => array(
                            'class' => 'dropdown-menu with-triangle',
                        ),
                        'items' => array(
                            array('label' => 'Profile', 'url' => array('/user/profile')),
                            array('label' => null, 'url' => null, 'itemOptions' => array('class' => 'divider')),
                            array('label' => 'Logout', 'url' => array('/user/logout')),
                        ),
                    ),
                ),
            )); ?>
        </div>
    </div>
</nav>

<section id="content" class="container-fluid">
    <?php echo $content; ?>
</section>

<?php $this->endContent(); ?>
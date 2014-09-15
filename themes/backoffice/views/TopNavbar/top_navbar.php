<div class="top-navbar dark-color">
    <div class="top-navbar-inner">
        <!-- Begin Logo brand -->
        <div class="logo-brand">
            <a href="index.html"><img src="<?php echo $baseUrl; ?>/assets/img/sentir-logo-primary.png" alt="Sentir logo"></a>
        </div><!-- /.logo-brand -->
        <!-- End Logo brand -->

        <div class="top-nav-content main-top-nav-layout">
            <!-- Begin button sidebar left toggle -->
            <div class="btn-collapse-main-navigation" data-toggle="collapse" data-target="#top-main-navigation">
                    <i class="fa fa-bars"></i>
            </div><!-- /.btn-collapse-sidebar-left -->
            <!-- End button sidebar left toggle -->

            <!-- Begin button sidebar right toggle -->
            <!-- div class="btn-collapse-sidebar-right">
                    <i class="fa fa-bullhorn"></i>
            </div><!-- /.btn-collapse-sidebar-right -->
            <!-- End button sidebar right toggle -->

            <!-- Begin button nav toggle -->
            <div class="btn-collapse-nav" data-toggle="collapse" data-target="#main-fixed-nav">
                    <i class="fa fa-plus icon-plus"></i>
            </div><!-- /.btn-collapse-sidebar-right -->
            <!-- End button nav toggle -->

            <!-- Begin user session nav -->
            
            <?php $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array(
                    'class' => 'nav-user navbar-right'
                ),
                'encodeLabel' => false,
                'items' => array(
                    array(
                        'label' => '<img src="' 
                                    . $baseUrl 
                                    . '/assets/img/avatar/avatar.jpg" class="avatar img-circle" alt="Avatar">Hi, <strong>' 
                                    . Yii::app()->user->name 
                                    . '</strong>',
                        'url' => 'javascript:;//',
                        'itemOptions' => array(
                            'class' => 'dropdown',
                        ),
                        'linkOptions' => array(
                            'class' => 'dropdown-toggle',
                            'data-toggle' => 'dropdown',
                        ),
                        'submenuOptions' => array(
                            'class' => 'dropdown-menu square primary margin-list-rounded with-triangle',
                        ),
                        'items' => array(
                            array('label' => '<i class="fa fa-user"></i>Profile', 'url' => array('/user/profile')),
                            array('label' => '<i class="fa fa-cog"></i>Settings', 'url' => array('/user/settings')),
                            array('label' => null, 'url' => null, 'itemOptions' => array('class' => 'divider')),
                            array('label' => '<i class="fa fa-power-off"></i>Logout', 'url' => array('/backoffice/user/auth/logout')),
                        ),
                    ),
                ),
            )); ?>
            

            <!-- Begin Collapse menu nav -->
            <div class="collapse navbar-collapse" id="main-fixed-nav">
                    <!-- Begin nav search form -->
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                    </form>
            </div><!-- /.navbar-collapse -->
                <!-- End Collapse menu nav -->
        </div><!-- /.top-nav-content -->
    </div><!-- /.top-navbar-inner -->
</div><!-- /.top-navbar -->
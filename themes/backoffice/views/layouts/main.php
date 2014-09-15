<?php $this->beginContent('//layouts/base'); ?>

<div class="wrapper">
    <!-- BEGIN TOP NAV -->
    <?php $this->widget('backoffice.widgets.TopNavbar'); ?>
    <!-- END TOP NAV -->

    <!-- BEGIN SIDEBAR LEFT -->
    <?php $this->widget('backoffice.widgets.MainMenu'); ?>
    <!-- END SIDEBAR LEFT -->

    <!-- BEGIN PAGE CONTENT -->
    <div class="content no-left-sidebar">
        <div class="container-fluid">
            <h1 class="page-heading"><?php echo $this->pageTitle; ?>
                &nbsp;<small><?php echo $this->pageDescription; ?></small></h1>

            <?php if(isset($this->breadcrumbs)):?>
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                )); ?>
            <?php endif?>

            <?php echo $content; ?>
        </div><!-- /.container-fluid -->

        <footer>
                &copy; <?php echo date('Y'); ?> <a href="/"><?php echo Yii::app()->getParams()->itemAt('companyName'); ?></a><br />
        </footer>
    </div><!-- /.page-content -->
</div><!-- /.wrapper -->


<div id="back-top">
    <a href="#top"><i class="fa fa-chevron-up"></i></a>
</div>

<?php $this->endContent(); ?>
<?php

CHtml::$errorContainerTag = 'small';

return array(
    'components' => array(
        'widgetFactory' => array(
            'widgets' => array(
                'CGridView' => array(
                    'cssFile' => false,
                    'itemsCssClass' => 'table table-th-block table-hover',
                    'pagerCssClass' => 'data-grid-pagination',
                    'summaryCssClass' => 'data-grid-summary',
                    'summaryText' => false,
                    'htmlOptions' => array(
                        'class' => 'table-responsive',
                    ),
                ),
                'CActiveForm' => array(
                    'errorMessageCssClass' => 'help-block',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                        'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => true,
                        'errorCssClass' => 'has-error has-feedback',
                        'successCssClass' => 'has-success has-feedback',
                        'inputContainer' => 'div.form-group',
                    ),
                ),
                'CLinkPager' => array(
                    'cssFile' => false,
                    'header' => false,
                    'hiddenPageCssClass' => 'disabled',
                    'lastPageLabel' => '»',
                    'nextPageLabel' => '›',
                    'firstPageLabel' => '«',
                    'prevPageLabel' => '‹',
                    'selectedPageCssClass' => 'active',
                    'htmlOptions' => array(
                        'class' => 'pagination',
                    ),
                ),
                'CBreadcrumbs' => array(
                    'htmlOptions' => array(
                        'class' => 'breadcrumb default',
                    ),
                    'encodeLabel' => false,
                    'homeLink' => false,
                    'tagName' => 'ol',
                    'separator' => null,
                    'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
                    'inactiveLinkTemplate' => '<li class="active">{label}</li>',
                ),
            ),
        ),
    ),
);

<div class="top-main-navigation">
    <nav class="navbar square navbar-default no-border" role="navigation">
        <div class="container-fluid">
              <div class="collapse navbar-collapse" id="top-main-navigation">
                  <?php $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array(
                        'class' => 'nav navbar-nav',
                    ),
                    'submenuHtmlOptions' => array(
                        'class' => 'dropdown-menu square margin-list-rounded with-triangle',
                    ),
                    'encodeLabel' => false,
                    'items' => array(
                        array(
                            'label' => '<i class="fa fa-dashboard"></i>&nbsp;
                                        <span class="hidden-sm hidden-md">Dashboard</span>', 
                            'url' => array('/backoffice/default/index'),
                            'active' => $this->controller->route === 'backoffice/default/index',
                        ),
                        array(
                            'visible' => Yii::app()->user->checkAccess('User'),
                            'active' => $this->module->id === 'backoffice/user',
                            'itemOptions' => array(
                                'class' => 'dropdown',
                            ),
                            'linkOptions' => array(
                                'class' => 'dropdown-toggle',
                                'data-toggle' => 'dropdown',
                                'title' => 'Create, edit, activate and deactivate users. '
                                    . 'Create and manage groups, permissions and roles.'
                                
                            ),
                            'label' => '<i class="fa fa-users"></i>&nbsp;
                                        <span class="hidden-sm hidden-md">Users</span>', 
                            'url' => array('/backoffice/user/users'),
                            'items' => array(
                                array(
                                    'label' => 'User Management', 
                                    'linkOptions' => array(
                                        'title' => 'Manage user accounts and passwords',
                                    ),
                                    'url' => array('/backoffice/user/users'),
                                    'visible' => Yii::app()->user->checkAccess('User.Users'),
                                ), 
                                array(
                                    'label' => 'Groups Management',
                                    'linkOptions' => array(
                                        'title' => 'Manage groups, membership and properties',
                                    ),
                                    'url' => array('/backoffice/user/groups'), 
                                    'visible' => Yii::app()->user->checkAccess('User.Groups'),
                                ),
                            ),
                        ),
                        
                        array(
                            'label' => '<i class="fa fa-building"></i>&nbsp;
                                        <span class="hidden-sm hidden-md">Entities</span>', 
                            'url' => array('/backoffice/entities/maisons'),
                            'itemOptions' => array(
                                'class' => 'dropdown',
                            ),
                            'linkOptions' => array(
                                'class' => 'dropdown-toggle',
                                'data-toggle' => 'dropdown',
                                'title' => 'Create, edit, activate and deactivate entities. ',
                            ),
                            'visible' => Yii::app()->user->checkAccess('Entities'),
                            'active' => $this->module->id === 'backoffice/entities',
                            'items' => array(
                                array(
                                    'label' => 'Accounts', 
                                    'url' => array('/backoffice/entities/account'),
                                    'visible' => Yii::app()->user->checkAccess('Entities.Account'),
                                ),
                                array(
                                    'label' => 'Business Units', 
                                    'url' => array('/backoffice/entities/businessUnit'),
                                    'visible' => Yii::app()->user->checkAccess('Entities.BusinessUnit'),
                                ),
                                array(
                                    'label' => 'Intermediates', 
                                    'url' => array('/backoffice/entities/intermediate'),
                                    'visible' => Yii::app()->user->checkAccess('Entities.Intermediate'),
                                ),
                                array(
                                    'label' => 'Agences', 
                                    'url' => array('/backoffice/entities/affiliates'),
                                    'visible' => Yii::app()->user->checkAccess('Entities.Affiliates'),
                                ),
                            ),
                        ),
                        
                        array(
                            'label' => '<i class="fa fa-cog"></i>&nbsp;
                                        <span class="hidden-sm hidden-md">Configurations</span>', 
                            'url' => '#',
                            'itemOptions' => array(
                                'class' => 'dropdown',
                            ),
                            'linkOptions' => array(
                                'class' => 'dropdown-toggle',
                                'data-toggle' => 'dropdown',
                            ),
                            'visible' => Yii::app()->user->checkAccess('Backoffice'),
                            'active' => Yii::app()->getModule('backoffice')->configMenuActive,
                            'items' => array(
                                array(
                                    'label' => 'Domains', 
                                    'url' => array('/backoffice/domain/index'),
                                    'visible' => Yii::app()->user->checkAccess('Backoffice.Domain'),
                                ),
                                array(
                                    'label' => 'Societe', 
                                    'url' => array('/backoffice/societe/index'),
                                    'visible' => Yii::app()->user->checkAccess('Backoffice.Societe'),
                                ),
                                array(
                                    'label' => 'Bank', 
                                    'url' => array('/backoffice/bank/index'),
                                    'visible' => Yii::app()->user->checkAccess('Backoffice.Bank'),
                                ),
                                array(
                                    'label' => 'Application Type', 
                                    'url' => array('/backoffice/apptype/index'),
                                    'visible' => Yii::app()->user->checkAccess('Backoffice.ApplicationType'),
                                ),
                                array(
                                    'label' => 'Country', 
                                    'url' => array('/backoffice/country/index'),
                                    'visible' => Yii::app()->user->checkAccess('Backoffice.Country'),
                                ),
                                array(
                                    'label' => 'Language', 
                                    'url' => array('/backoffice/language/index'),
                                    'visible' => Yii::app()->user->checkAccess('Backoffice.Language'),
                                ),
                                array(
                                    'label' => 'Service', 
                                    'url' => array('/backoffice/service/index'),
                                    'visible' => Yii::app()->user->checkAccess('Backoffice.Service'),
                                ),
                            ),
                        ),
                    ),
                )); ?>
              </div>
        </div>
    </nav>
</div>
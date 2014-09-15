<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => '_group_members_list',
    'dataProvider' => $members,
    'columns' => array(
        'username',
        'email',
        'prenom',
        'name',
        array(
            'class' => 'application.widgets.ButtonColumn',
            'template' => '<div class="btn-group pull-right">{revoke}</div>',
            'buttons' => array(
                'revoke' => array(
                    'label' => 'Revoke',
                    'url' => '"#" . $data["id"]',
                    'options' => array(
                        'class' => 'btn btn-xs btn-danger',
                        'id' => 'user-group-revoke',
                    )
                ),
            ),
        ),
    ),
)); ?>
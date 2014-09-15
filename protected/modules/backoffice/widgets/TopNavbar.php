<?php

class TopNavbar extends CWidget {
    public function run() {
        $this->render('top_navbar', array(
            'baseUrl' => Yii::app()->theme->baseUrl,
        ));
    }
}

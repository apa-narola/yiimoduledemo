<?php


class MainMenu extends CWidget {
    
    public function run() {
        $this->render('main_menu', array(
            'baseUrl' => Yii::app()->theme->baseUrl,
        ));
    }
    
    public function getModule()
    {
        if (null === $this->controller->module) {
            return Yii::app();
        }
        
        return $this->controller->module;
    }
}

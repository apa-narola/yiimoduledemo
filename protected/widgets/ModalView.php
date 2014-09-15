<?php

class ModalView extends CWidget
{
    /**
     * @var string modal title 
     */
    public $title;
    
    /**
     * @var string modal content 
     */
    public $content;
    
    /**
     * @var array buttons config 
     */
    public $buttons;
    
    public $size = 'md';
    
    public $visible = true;


    public function init()
    {
        $this->buttons = $this->normalizeButtons($this->buttons);
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if (!$this->visible) {
            return;
        }
        $this->render('modal_view', array(
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'modal' => $this,
        ));
    }
    
    protected function normalizeButtons($items)
    {
        $buttons = array();
        
        foreach ($items as $key => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$key]);
                continue;
            }
            $label = isset($item['label']) ? $item['label'] : '';
            $buttons[$label] = $item;
        }
        
        return $buttons;
    }
}

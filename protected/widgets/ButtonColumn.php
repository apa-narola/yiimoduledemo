<?php

class ButtonColumn extends CButtonColumn
{
    public $viewButtonImageUrl = false;
    public $updateButtonImageUrl = false;
    public $deleteButtonImageUrl = false;
    
    public $viewButtonOptions=array('class'=>'btn btn-xs btn-primary');
    public $updateButtonOptions=array('class'=>'btn btn-xs btn-primary');
    public $deleteButtonOptions=array('class'=>'btn btn-xs btn-warning');
    
    public $template='<div class="btn-group pull-right">{view} {update} {delete}</div>';
    
}

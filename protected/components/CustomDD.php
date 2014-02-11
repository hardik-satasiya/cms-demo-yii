<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomDD
 *
 * @author drc
 */
class CustomDD extends CWidget
{
    /**
     * @var CFormModel
     *
     * @var type 
     */    
    
    public $model;     
    public $attribute;
    
    public $width;             
    public $placeholder;    
    public $tags;
    public $preselected;
    
    
    public function run()
    {        
        
        
        $this->widget('bootstrap.widgets.TbSelect2', array(                                
                                'asDropDownList' => false,
                                'model' => $this->model,
                                'attribute'=>$this->attribute,
                                'options' => array(                                    
                                    'tags' => $this->tags,
                                    //'data' => $this->getAllPrivbooster(),                                    
                                    'placeholder' => $this->placeholder,
                                    'width' => $this->width,
                                    'tokenSeparators' => array(',', ' '),                                
                                ))); 
        echo '<script>
        $(document).ready(function() {
                $("#'. get_class($this->model) .'_'. $this->attribute .'").val('. CJSON::encode($this->preselected) .').trigger("change");
        });
        </script>';
    }
}

?>

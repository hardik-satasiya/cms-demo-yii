<?php
/* @var $this FancyboxController */

$this->breadcrumbs=array(
	'Fancybox',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
    <img src="<?php echo Yii::app()->request->baseUrl.'/images/kids.jpg'?>" width="94" height="92" style="padding-right:50px;float:left;"/>
<p>
<?php 
    echo CHtml::image(Yii::app()->request->baseUrl.'/images/kids.jpg', 'dear', array("width"=>"94","height"=>"92"));
?>
</p> 

<?php

//create a link<p>

$this->widget('bootstrap.widgets.TbButton',array(
        'id'=>'button',   
        'label' => 'Secondary',
        'type' => 'primary',
        'size' => 'medium'
));    
 $ok = '1234555';
//put fancybox on page
$this->widget('ext.fancybox.EFancyBox',array(
        'target'=>'#button',    
        'config'=>array(
            'autoDimensions'=>false,
            'id'=>'button',            
            'width'=>'800',
            'height'=>'200',
            //'scrolling'=>'yes',
            'titlePosition'=>'over',
            'titleShow'=>true,
            content =>  $ok,
            'title'=>'hi there!',                   
            
            'onClosed'=>'js:function(currentArray, currentIndex, currentOpts)
                {
                    setTimeout("$(\"#link\").fancybox().trigger(\"click\")",currentOpts.speedOut);
                    //alert(this.id);
                }',
                ),
    ));  
    
?>  
<p>
<?php echo CHtml::link("Choosen",array('/fancybox/index'), 
    array('id'=>'iframe')) ?>
    
    <?php $this->widget('ext.fancybox.EFancyBox', array(
        'target'=>'a#iframe',
        'config'=>array(
            'id'=>'1_another_url',            
            'scrolling'=>'no',
            'titleShow'=>true,
            'onClosed'=>'js:function()
                {
                    alert(this.id);
                }',
            ),
        )
    );
?>  
</p>
<p>
<?php echo  CHtml::link('link text goes here',"#data",array('id'=>'link')); ?>
<?php $this->widget('ext.fancybox.EFancyBox', array(
    'target'=>'#link',
    'config'=>array(
        'id'=>'parent_link',            
        'scrolling'=>'no',
        'titleShow'=>true,
        'showCloseButton'=>true,
        'modal'=>true,
        'onClosed'=>'js:function()
            {
                setTimeout("$(\"#button\").fancybox().trigger(\"click\")",100);
                //alert(this.id);
            }',
        
        ),
    )
);
?>
    <script>
        $(document).ready(function(){
            //hithere();
        });
        function hithere()
        {
            //alert('hi_dear');
            //$("#link").fancybox().trigger("click");
            
        }
    </script>
        
</p>
<div style="display:none">
    <div id="data">
        <?php echo CHtml::link("Inner_fancy_box",array('/fancybox/index'), 
                array('id'=>'inner'));
                $this->widget('ext.fancybox.EFancyBox', array(
                            'target'=>'a#inner',
                            'config'=>array(
                                'id'=>'inner_link',            
                                'scrolling'=>'no',                                
                                'titleShow'=>true,
                                'onClosed'=>'js:function()
                                            {   
                                                setTimeout("$(\"#link\").fancybox().trigger(\"click\")",100);                                                
                                            }',                                    
                                ),
                            )
                );                
        ?>
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
        when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
        It has survived not only five centuries, but also the leap into electronic typesetting,
        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
        like Aldus PageMaker including versions of Lorem Ipsum.
    </div>
</div>

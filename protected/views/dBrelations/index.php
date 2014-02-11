<?php
/* @var $this DBrelationsController 
 * @var $model Users
 */


$this->breadcrumbs=array(
	'D Brelations',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $model->search(),
	//'filter' => $model,
	'columns' => array(
        array(
			'name' => 'id',
			'type' => 'raw',
			'value' => 'CHtml::encode($data->id)',
            'htmlOptions'=>array("width"=>"20"),
		),
        array(
			'name' => 'usertype_id',
			'type' => 'raw',
			'value' => 'CHtml::encode($data->usertype->id)'
		),
        array(
			'header' => 'my_own',
			'type' => 'raw',
			'value' => 'CHtml::image(Yii::app()->request->baseUrl."/images/kids.jpg", "dear", array("width"=>"94","height"=>"92"))',
		),
		array(
			'name' => 'usertype_name',
			'type' => 'raw',
			'value' => 'CHtml::encode($data->usertype->role)'
		),
        array(            
            'header'=>'Column From Method',
            //call the method 'gridDataColumn' from the controller
            'value'=>array($this,'gridDataColumn'), 
        ),
        
		array(
			'name' => 'username',
			'type' => 'raw',
			'value' => '$data->username',
		),
        array(            // display a column with "view", "update" and "delete" buttons
            'header' => 'actions',
            'class'=>'CButtonColumn',
        ), 
         array(            // display a column with "view", "update" and "delete" buttons
            'name' => 'remarks',
			'type' => 'raw',
			'value' => 'CHtml::encode($data->remarks)'
        ), 
         array(            // display a column with "view", "update" and "delete" buttons
            'header' => 'ajax',
			'class'=>'CButtonColumn',
            'template'=>'{edit}',			
            'buttons'=>array(
                                'edit' => array(
                                        'options'=>array('title'=>'down_dear','class'=>'ajaxedit'),                                
                                    ),
                            ),
        ), 
        array(            // display a column with "view", "update" and "delete" buttons
            'header' => 'actions',
            'class'=>'CButtonColumn',
            'template'=>'{down}{edit}',
            'buttons'=>array(
                         
                            'down' => array(                                
                                'options'=>array('title'=>'down_dear'),
                                'imageUrl'=>Yii::app()->request->baseUrl.'/images/bullet_toggle_plus.png',
                                //'visible'=>'$data->score > 0',
                                'click'=>'function(){alert("Going down!");}',
                            ),
                            'edit' => array(                                
                                'options'=>array('title'=>'dow'),
                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/bullet_toggle_plus.png',
                                //'visible'=>'$data->score > 0',                                
                                'url'=>'$this->grid->controller->createUrl("update", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                                'click'=>'function(){ $("#loader").css({"display":"block"}); $("#cru-frame").attr("src",$(this).attr("href"));$("#cru-dialog").dialog("open");  return false; }',
                                
                            ),
                            
                    )
                           
            ),   
//**************************************************************************************************        
//************************************rendering_partial_views_from_methods**********************
//        array(            
//            'header'=>'address',
//            'type'=>'raw', //because of using html-code from the rendered view
//            'value'=>array($this,'gridAddress'), //call this controller method for each row
//        ),
//************************************rendering_partial_views_from_methods**********************
//
//************************************putting_widgets_inside_gridview****************************        
        array(            
            'header'=>'my_column',
            'type' => 'raw',            
            'value'=>  function(){
                          Yii::app()->controller->widget('bootstrap.widgets.TbProgress', array(
                        'type'=>'danger', // 'info', 'success' or 'danger'
                        'percent'=>100, // the progress                        
                        'striped'=>true,
                        'animated'=>true,
                        ));    
            }, 
//**************************************************************************************************
        ),
	),
));


?>
<?php
$this->widget('ext.fancybox.EFancyBox', array('target'=>'.ajaxedit'));
?>
    <?php
//--------------------- begin new code --------------------------
// add the (closed) dialog for the iframe
 $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
 'id'=>'cru-dialog',
 'options'=>array(
     'title'=>'Detail view',
     'autoOpen'=>false,
     'modal'=>false,
     'width'=>400,
     'height'=>500,
 ),
 ));
?>
<style>
#loader
{    
    background: url("../../images/loader.gif") no-repeat scroll 50%;    
    height: 100%;
    opacity: 0.4;    
    position: absolute;
    width: 95%;
}    
</style>
    
<script type="text/javascript">
function hideProgress()
{
        $('#loader').css({'display':'none'});
}
</script>
<div id="loader" ></div>
<iframe id="cru-frame" width="100%" height="100%" onload="hideProgress()"></iframe>
<?php 
$this->endWidget();
//--------------------- end new code --------------------------
?>
</p>

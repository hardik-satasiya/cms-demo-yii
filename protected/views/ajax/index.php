<?php
/* @var $this AjaxController */

$this->breadcrumbs=array(
	'Ajax',
);
?>
<style>
    p{
        border-bottom: thick blueviolet solid;
    }
</style>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<h2>Ajax Dropdown List</h2>
<p>
<?php 
    $data = Usertype::model()->findAll();
    $data = CHtml::listData($data,'id', 'role');
?>
<?php                                   
    echo CHtml::dropDownList('roles','',
    $data, 
    array(
      'prompt'=>'Select Region',
      'ajax' => array(
                        'type'=>'POST', 
                        'url'=>CController::createUrl('loadcities'),
                        'update'=>'#city_name', 
                        'data'=>array('role'=>'js:this.value'),
                        //'beforeSend'=>'js:function(){console.log($("#roles"))}',
                        //'complete'=>'js:function(){alert("hi");}'
                     )
        )
    ); 
    
    echo CHtml::dropDownList('city_name','', array(), array('prompt'=>'Select City'));
?>
<!--<div id="city_name"></div>-->


<h2>Ajax Using renderpartial</h2>
<p>
<?php echo CHtml::textField("myval","enter text"); ?>    
<?php echo CHtml::ajaxButton ("Update data",CController::createUrl('Ajax/UpdateAjax'),
        array(
            'type'=>'POST',
            'update' => '#data',
            'data' => array('value'=>'js:$("#myval").attr("value")'),
            )
        
        );
?>

<?php
echo CHtml::beginForm(CHtml::normalizeUrl(array('retrivedata')), 'get', array('id'=>'filter-form'))
    . CHtml::textField('string', (isset($_GET['string'])) ? $_GET['string'] : '', array('id'=>'string'))
    . CHtml::submitButton('Search', array('name'=>''))
    . CHtml::endForm(); ?>

<?php Yii::app()->clientScript->registerScript('search',"
    var ajaxUpdateTimeout;
    var ajaxRequest;
    $('input#string').change(function()
    {
            ajaxRequest = $(this).serialize();
            clearTimeout(ajaxUpdateTimeout);
            ajaxUpdateTimeout = setTimeout(
                                function () 
                                {   
                                    //your function to call
                                    //$.fn.yiiListView.update('ajaxListView',{type: 'POST',data: ajaxRequest});
                                },300);
    });"
); ?>



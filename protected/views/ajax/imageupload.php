<?php
/* @var $this DBrelationsController 
 * @var $model Users
 */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jquery.form.js");

$this->breadcrumbs=array(
	'Image Upload',
);

?>
<style>    
.mythumbnail {    
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.96);
    display: block;
    float: left;
    line-height: 20px;
    padding: 4px;
    margin: 5px;    
    transition: all 1s ease-in-out;
}
</style>
<h3>Image Upload (Using AJAX)</h3>
<?php $this->widget('bootstrap.widgets.TbFileUpload', array(
    'url' => $this->createUrl("Ajax/upload"),
    'model' => $model,
    'attribute' => 'picture', // see the attribute?
    'multiple' => true,
    'options' => array(
    'maxFileSize' => 2000000,
    'acceptFileTypes' => 'js:/(\.|\/)(gif|jpe?g|png)$/i',        
))); ?>




<script type="text/javascript" src="../js/jquery.form.js"></script>    
<form action="AjaxDefupload" method="post" enctype="multipart/form-data">
<input name="myFile" type="file">
<input type="submit" value ="ajax">
<div id="results"></div></body>
</html>
</form>    
    
<script>
$(document).ready(function()
{  
        $('form').ajaxForm({
        beforeSubmit: function() {
            //$('#results').html('Submitting...');
        },
        success: function(data) {
            var $out = $('#results');
            //$out.html('Your results:');
            $out.append('<div class="mythumbnail">'+ data +'</div>');
        }
    });
})
</script>
    

<!-- The form starts -->



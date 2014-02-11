<?php
/* @var $this FileopsController */

$this->breadcrumbs=array(
	'Fileops',
);
?>
<h4><?php echo $this->id . '/' . $this->action->id; ?></h4>

<?php Yii::app()->clientScript->registerScriptFile('../js/jquery.form.js'); ?>
<!--<script type="text/javascript" src="../js/jquery.form.js"></script>-->    
<form action="AjaxVidupload" method="post" enctype="multipart/form-data">
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
            $('#results').html('Submitting...');
        },
        success: function(data) {
            var $out = $('#results');
            $out.html('Your results:');
            $out.append('<pre><div>'+ data +'</div></pre>');
        }
    });
})


</script>
    








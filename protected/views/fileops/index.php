<?php
/* @var $this FileopsController */

$this->breadcrumbs=array(
	'Fileops',
);
?>
<h4><?php echo $this->id . '/' . $this->action->id; ?></h4>

<?php echo CHtml::link("Download PDF", "Getfilepdf"); ?>

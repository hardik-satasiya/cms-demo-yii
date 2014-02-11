<?php
/* @var $this ManagemenuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Menus',
);

$this->menu=array(
	array('label'=>'Create Menu', 'url'=>array('create')),
	array('label'=>'Manage Menu', 'url'=>array('admin')),
);
?>

<h1>Menus</h1>

<?php
 $dataProvider->pagination->pageSize = 3;
 
 $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

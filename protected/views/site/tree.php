<?php
/* @var $this DBrelationsController 
 * @var $model Users
 */


$this->breadcrumbs=array(
	'D Brelations',
);
?>
<h4><?php echo $this->id . '/' . $this->action->id; ?></h4>
<style>
    
ul, ol {
    margin: 0 0 10px 25px;
    padding-left: 20px;
}
ul {
    list-style-type: disc;
}
</style>
    
<?php
$con=mysqli_connect("localhost","root","drc123","cms_demo");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT
        id, parent_id, name
    FROM
        folder
    ORDER BY
        parent_id, name");



$menuData = array(
    'items' => array(),
    'parents' => array()
);

while ($menuItem = mysqli_fetch_assoc($result))
{

    $menuData['items'][$menuItem['id']] = $menuItem;
    $menuData['parents'][$menuItem['parent_id']][] = $menuItem['id'];
} 
//echo "<pre>";
//print_r($menuData);
//exit;
function buildMenu($parentId, $menuData)
{
    $html = '';

    if (isset($menuData['parents'][$parentId]))
    {
        $html = '<ul>';
        foreach ($menuData['parents'][$parentId] as $itemId)
        {
            $html .= '<li>' . $menuData['items'][$itemId]['name']."(".$itemId.")";
            // find childitems recursively
            $html .= buildMenu($itemId, $menuData);

            $html .= '</li>';
        }
        $html .= '</ul>';
    }

    return $html;
}
echo buildMenu(0, $menuData); 

mysqli_close($con);
?>
<?php

    echo "<h4>Using Yii</h4>";
    //parent_child data uding Yii
    $model = Folder::model()->findAll();       
    
    
    $menuData = array(
    'items' => array(),
    'parents' => array()
    );
    
    foreach ($model as $row)
    {        
//      print_r($row->id);        
//      print_r("--".$row->parents);        
//      echo "<br>";
        $menuData['items'][$row->id] = array('id'=>$row->id,'name'=>$row->name,'parent_id'=>$row->parent_id);
        $menuData['parents'][$row->parent_id][] = $row->id;
        
        
        
    }
    
//      echo "<pre/>";
//      print_r($menuData);

    echo buildMenu(0, $menuData);   
    
    $this->widget('application.extensions.cfilebrowser.CFileBrowserWidget',array(
                'script'=>array('site/filebrowser'),
                //'root'=>'/var/www/',
                'folderEvent'=>'click',
                'expandSpeed'=>1000,
                'collapseSpeed'=>1000,
                'multiFolder'=>true,
                'loadMessage'=>'File Browser Is Loading...hang on a sec',
                'callbackFunction'=>'alert("I selected " + f)'
    )); 
    
    
    
    $dataTree=array(
		array(
			'text'=>'Grampa', //must using 'text' key to show the text
			'children'=>array(//using 'children' key to indicate there are children
				array(
					'text'=>'Father',
					'children'=>array(
						array('text'=>"<input type='radio' name='g1' /><img src='".Yii::app()->baseUrl."/images/folder_add.png'> me"),
						array('text'=>"<input type='radio' name='g1' /> big sis"),
						array('text'=>"<input type='radio' name='g1' /> little brother"),
					)
				),
				array(
					'text'=>'Uncle',
					'children'=>array(
						array('text'=>'Ben'),
						array('text'=>'Sally'),
					)
				),
				array(
					'text'=>'Aunt',
				)
			)
		)
	);
    
    $this->widget('CTreeView',array(
        'data'=>$dataTree,
        'animated'=>'fast', //quick animation
        'collapsed'=>'false',//remember must giving quote for boolean value in here
        'htmlOptions'=>array(
                'class'=>'treeview-red',//there are some classes that ready to use
    ),
    ));
    
    
   
    
?>
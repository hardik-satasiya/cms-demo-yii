<?php

class Menu_sortableController extends Controller
{
	public function actionIndex()
	{
            
            $this->render('index');                
	}
        public function actionAjaxsort()
	{
            if(isset($_POST['Order']) && isset($_POST['role']))
            {
                $criteria = new CDbCriteria();
                $criteria->condition = "role='". $_POST['role'] ."'";                
                $model=  Usertype::model()->find($criteria);
                if($model->saveAttributes(array('actions'=> $_POST['Order'])))
                {
                        
                        echo CJSON::encode(array("status"=>"<code>".$_POST['role']." Saved</code>"));
                        //$msg = "ok wow!!";
                        //echo '<script> temp=" '. $msg .' ";</script>';
                }
                else
                {
                        echo "failure!!";   
                }
                
//                $model->actions = $_POST['Order'];
//                
//                if($model->save())
//                {
//                        echo "ok!!";
//                }
            }
            exit;
	}
   
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
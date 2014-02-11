<?php
/* 
 * @var $model Users
 */
class DBrelationsController extends Controller
{    
    //public $layout='//layouts/column1';
    public function actionIndex()
	{
        //$model = Users::model();                                
        
        //$model = Users::model()->with('usertype');                                                     //
        $model = Users::model()->with(array('usertype'));                                                             
        //$model = Users::model()->with(array('usertype'=>array('select' => true)));                                                     
        //**********************************less_sql_query_using_with*************************************
		$this->render('index',array("model"=>$model));
	}
    public function actionUpdate($id)
    {   
        $model=$this->loadModel($id);
//        echo "<pre/>";
//        print_r($model->attributes);
//        print_r($_POST);
//        exit;
        
        
        // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);
 
        if(isset($_POST['Users']))
        {
            
            $model->attributes=$_POST['Users'];
            if($model->save())
                //----- begin new code --------------------
                if (!empty($_GET['asDialog']))
                {
                    //Close the dialog, reset the iframe and update the grid
                    echo CHtml::script("window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
                    Yii::app()->end();
                }
                else
                //----- end new code --------------------
                $this->redirect(array('view','id'=>$model->id));
                
        }

        //----- begin new code --------------------
        if (!empty($_GET['asDialog']))
            $this->layout = '//layouts/iframe';
        //----- end new code --------------------

        $this->render('update',array(
            'model'=>$model,
        ));        
        
    }
    protected function gridDataColumn($data,$row)
     {
          // ... generate the output for the column
 
          // Params:
          // $data ... the current row data   
         // $row ... the row index          
        echo "<code>".print_r($data->usertype->role,true)."</code>";         
        
        //return $theCellValue;    
    }
    
    public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    protected function gridAddress($data,$row)
    {     
        $model = Users::model()->findByPk($data->id); //$data->address is the FK from the user table

       //get the view from the address CRUD controller (generated with gii)
        return $this->renderPartial('../manage/view',array('model'=>$model),true); //set $return = true, don't display direct
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
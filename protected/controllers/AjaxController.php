<?php

class AjaxController extends Controller
{
    public function actions()
    {
        return array(
            'quote'=>array(
                'class'=>'CWebServiceAction',
            ),
        );
    }
    
    
    public function actionImageupload()
    {
       $model = new Uploads();
       $this->render('imageupload',array('model'=>$model));
    }
    
	public function actionIndex()
	{
        
        $this->render('index');
        //$this->renderFile('/../views/ajax/_ajaxContent.php', $data);        
	
	}
    public function actionSoap()
    {
        $this->render('soap');
    }
    
    /**
     * @return object
     * @soap
     */  
    public function getUsers()
    {
        $model = Users::model()->findAll();
        return $model;
    }
    /**
     * @param string the symbol of the stock
     * @return float the stock price
     * @soap
     */    
    public function  actionAjaxDefupload()
    {

        
        $upload_file = CUploadedFile::getInstanceByName("myFile");
        
        if($upload_file->saveAs(Yii::app()->basePath."/../images/".$upload_file->name))
        {
                $this->create_scaled_image($upload_file->name);
                //echo "ok";
                echo "<img src=".Yii::app()->baseUrl."/images/thumbnail/".$upload_file->name.">";
        }      
        else
                echo "no";
    }
    Public function create_scaled_image($file_name, $version="thumbnail", $options=array('max_width' => 80,'max_height' => 80))
    {
        $full_path = Yii::app()->basePath."/../images/".$file_name;        
        $file_path = Yii::app()->basePath."/../images/";
//        $file_path = $this->get_upload_path($file_name);
        if (!empty($version)) 
        {
            $version_dir = $file_path."/".$version;
            if (!is_dir($version_dir)) {
                mkdir($version_dir, 0777, true);
            }
            $new_file_path = $version_dir.'/'.$file_name;
        } else {
            $new_file_path = $file_path;
        }
        list($img_width, $img_height) = @getimagesize($full_path);                
        
        if (!$img_width || !$img_height) {
            return false;
        }       
        
        
        $scale = min(
            $options['max_width'] / $img_width,
            $options['max_height'] / $img_height
        );
        
        
        if ($scale >= 1) {
            if ($file_path !== $new_file_path) {
                return copy($file_path, $new_file_path);
            }
            return true;
        }
        
        $new_width = $img_width * $scale;
        $new_height = $img_height * $scale;
        
        
        $new_img = @imagecreatetruecolor($new_width, $new_height);
        
        
        switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
            case 'jpg':
            case 'jpeg':
                $src_img = @imagecreatefromjpeg($full_path);
                $write_image = 'imagejpeg';
                $image_quality = isset($options['jpeg_quality']) ?
                    $options['jpeg_quality'] : 75;
                break;
            case 'gif':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                $src_img = @imagecreatefromgif($full_path);
                $write_image = 'imagegif';
                $image_quality = null;
                break;
            case 'png':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                @imagealphablending($new_img, false);
                @imagesavealpha($new_img, true);
                $src_img = @imagecreatefrompng($full_path);
                $write_image = 'imagepng';
                $image_quality = isset($options['png_quality']) ?
                    $options['png_quality'] : 9;
                break;
            default:
                $src_img = null;
        }
        $success = $src_img && @imagecopyresampled(
            $new_img,
            $src_img,
            0, 0, 0, 0,
            $new_width,
            $new_height,
            $img_width,
            $img_height
        ) && $write_image($new_img, $new_file_path, $image_quality);
        // Free up memory (imagedestroy does not delete files):
        @imagedestroy($src_img);
        @imagedestroy($new_img);
        return $success;
    }
    
    public function actionDefupload()
    {
             
        $model = new UploadForm;
        
        if(isset($_POST['UploadForm']))
        {   
            $model->upload_file=CUploadedFile::getInstance($model,'upload_file');
            $model->upload_file->saveAs("//var//www//".$model->upload_file->name);
            
            echo "<pre/>";
            print_r($model->upload_file);
            exit; 
        }
            
        $this->render("defupload",array('model'=>$model));        
        
        
    }
    public function getPrice($symbol)
    {
        $prices=array('IBM'=>100, 'GOOGLE'=>350);
        return isset($prices[$symbol])?$prices[$symbol]:0;
        //...return stock price for $symbol
    }
    public function actionLoadcities()
    {    
        //var ctx = $(".jqplot-event-canvas");
        //context = ctx[0].getContext('2d')
        //context.strokeStyle = '#ff0000';
        
        $data = Users::model()->findAll('usertype_id=:role',array(':role'=>(int) $_POST['role']));
        $data=CHtml::listData($data,'id','username');        
        echo "<option value=''>Select City</option>";
        foreach($data as $id=>$user_name)
            echo CHtml::tag('option', array('value'=>$id),CHtml::encode($user_name),true);
    }
    public function actionUpdateAjax()
    {
        $data = array();
        $data["myValue"] = "<h4>".$_POST['value']."</h4>";        
        Yii::app()->user->setState('var',$data["myValue"]);        
        //$data["myValue"] = Yii::app()->user->getState('var');                        
        $this->renderPartial('/layouts/_ajaxContent', $data, false, true);
    }
    
    public function actionRetrivedata()
    {
        echo "ok";
    }
    public function actionUpload()
    {        
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) && 
            (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false))
        {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }
        $data = array();
        
        $model = new Uploads('upload');
        
        $model->picture = CUploadedFile::getInstance($model, 'picture');
        $model->path = $model->picture->name;
        $model->file_name = $model->picture->name;
        
        
        
        if ($model->picture !== null )// && $model->validate(array('picture')))
        {
            $model->picture->saveAs(Yii::app()->basePath."//..//images//".$model->picture->name,true);            
            // save picture name
            if( $model->save())
            {
                // return data to the fileuploader
                $data[] = array(
                    'name' => $model->picture->name,
                    'type' => $model->picture->type,
                    'size' => $model->picture->size,
                    'tempName'=>$model->picture->tempName,                    
                    // we need to return the place where our image has been saved
                    'url' => $model->getImageUrl(), // Should we add a helper method?
                    // we need to provide a thumbnail url to display on the list
                    // after upload. Again, the helper method now getting thumbnail.
                    'thumbnail_url' => $model->getThumbImageUrl(),
                    // we need to include the action that is going to delete the picture
                    // if we want to after loading 
                    'delete_url' => $this->createUrl('my/delete', 
                        array('id' => $model->id, 'method' => 'uploader')),
                    'delete_type' => 'POST');
            }
            else
            {
                $data[] = array('error' => 'Unable to save model after saving picture');
            }
        }
        else
        {
            if ($model->hasErrors('picture'))
            {
                $data[] = array('error', $model->getErrors('picture'));
            }
            else 
            {
                throw new CHttpException(500, "Could not upload file ".     CHtml::errorSummary($model));
            }
        }
        // JQuery File Upload expects JSON data
        echo json_encode($data);
        
    }
 
// .... more code here 
 

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

<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    public function actionForceDownload()
    {
        $this->render('downloadindex');        
    }
    public function actionForceDownloadLogic()
    {
        if(ini_get('zlib.output_compression'))
            ini_set('zlib.output_compression', 'Off');
        $file = Yii::app()->basePath. "/../images/kids.jpg";
        $filename = "kids.jpg";         
        $file_extension = strtolower(substr(strrchr($filename,"."),1));
        
        switch( $file_extension )
        {
          case "pdf": $ctype="application/pdf"; break;
          case "exe": $ctype="application/octet-stream"; break;
          case "zip": $ctype="application/zip"; break;
          case "doc": $ctype="application/msword"; break;
          case "xls": $ctype="application/vnd.ms-excel"; break;
          case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
          case "gif": $ctype="image/gif"; break;
          case "png": $ctype="image/png"; break;
          case "jpeg":
          case "jpg": $ctype="image/jpg"; break;
          default: $ctype="application/force-download";
        }
        
        header("Pragma: public"); // required
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); // required for certain browsers 
        header("Content-Type: $ctype");
        // change, added quotes to allow spaces in filenames, by Rajkumar Singh
        header("Content-Disposition: attachment; filename=$filename;" );
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".filesize($file));
        readfile("$file",true);
        //$content = "image/jpg";
        //yii::app()->request->sendFile($file, $content);
    }
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid                        
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
    public function actionTree()
    {
        $this->render('tree');
    }
    public function actionMyLogin()
	{
                            
		$model=new MyLoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['MyLoginForm']))
		{
                        
			$model->attributes=$_POST['MyLoginForm'];
			// validate user input and redirect to the previous page if valid                        
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form                
		$this->render('mylogin',array('model'=>$model));
	}
    
    public function actionAjaxFillTree()
    {
            if (!Yii::app()->request->isAjaxRequest) {
                    exit();
            }
            $parentId = "NULL";
            if (isset($_GET['root']) && $_GET['root'] !== 'source') {
                    $parentId = (int) $_GET['root'];
            }
            $sql = "SELECT m1.id, m1.title AS text, m2.id IS NOT NULL AS hasChildren,m1.url "
            . "FROM menu AS m1 LEFT JOIN menu AS m2 ON m1.id=m2.id_parent "
            . "WHERE m1.id_parent <=> $parentId "
            . "GROUP BY m1.id ORDER BY m1.position ASC";
            $req = Yii::app()->db->createCommand($sql);
            $children = $req->queryAll();
            $children = $this->createLinks($children);

            echo str_replace(
                    '"hasChildren":"0"',
                    '"hasChildren":false',
                    CTreeView::saveDataAsJson($children)
            );
            exit();
    }

    private function createLinks($children){
            $child = array();
            $return = array();
            foreach($children AS $key=>$value){
                    $child['id']=$value['id'];
                    $child['text']=$value['text'];
                    $child['hasChildren']=$value['hasChildren'];

                    if(strlen($value['url'])>0){
                            $child['text'] = $this->format($value['text'],$value['url'],Yii::app()->request->url);
                    }

                    $return[] = $child;
                    $child = array();
            }

            return $return;
    }
        
    private function format($text, $url,$icon = NULL)
    {
            $img = '';
            if(isset($icon))
                    $img = '<img src="'.app()->theme->baseUrl.'/images/icons/'.$icon.'">';

            return sprintf('<span>%s</span>',CHtml::link(($img.' '.$text), app()->createUrl($url)));
    }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
    public function actionMyLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
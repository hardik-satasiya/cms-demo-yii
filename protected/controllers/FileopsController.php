<?php

class FileopsController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionGivesomeHTML()
    {
        echo "<h1>Take This</h1>";
        Yii::app()->end();
    }

    public function actionGetfilepdf()
    {

        $resumeName ="name";

        $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'cm', 'A4', true, 'UTF-8');
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE,1);
        $pdf->SetFontSize(12,true);
        $pdf->AliasNbPages();
        $pdf->AddPage();

        //$Resume_Data = file_get_contents($resumeURL.'&download=1');
        //
        $Resume_Data .= file_get_contents("http://localhost/yii_framework/cms_demo/usertype/index");
        //$Resume_Data = file_get_contents("http://localhost/yii_framework/cms_demo/Fileops/GivesomeHTML");
        echo $Resume_Data;
       exit;
        //echo Yii::app()->baseUrl."/usertype/index";

       //echo $Resume_Data; die;
        $pdf->writeHTML($Resume_Data, true, false, false, false,'LTR');


        if ($SaveFile == false) {

            $pdf->Output($resumeName,'D');
            Yii::app()->end();

        } else {
            $pdf->Output($resumeName,'F');
            if (file_exists($resumeName)) {
                return true;
            } else {
                return false;
            }
        }

    }

    public function  actionVids()
    {
        $this->render('vids');
    }

    public function  actionAjaxVidupload()
    {
        $upload_file = CUploadedFile::getInstanceByName("myFile");

        if($upload_file->saveAs(Yii::app()->basePath."/../uploads/".$upload_file->name))
        {

            if(!extension_loaded('ffmpeg'))
            {
                echo "<h5>sorry you are not loaded with ffmpeg :( </h5>";
            }
            echo "<h5>you are loaded with ffmpeg :) </h5>";

            $ffmpegInstance = new ffmpeg_movie(Yii::app()->basePath."/../uploads/".$upload_file->name);

            print_r($ffmpegInstance);

            $details = array();
            $details["getDuration: "]       = $ffmpegInstance->getDuration();
            $details["getFrameCount: "]     = $ffmpegInstance->getFrameCount();
            $details["getFrameRate: "]      = $ffmpegInstance->getFrameRate();
            $details["getFilename: "]       = $ffmpegInstance->getFilename();
            $details["getFrameHeight: "]    = $ffmpegInstance->getFrameHeight();
            $details["getFrameWidth: "]     = $ffmpegInstance->getFrameWidth();
            $details["getPixelFormat: "]    = $ffmpegInstance->getPixelFormat();
            $details["getBitRate: "]        = $ffmpegInstance->getBitRate();
            $details["getVideoBitRate: "]   = $ffmpegInstance->getVideoBitRate();
            $details["getAudioBitRate: "]   = $ffmpegInstance->getAudioBitRate();
            $details["getAudioSampleRate: "]= $ffmpegInstance->getAudioSampleRate();
            $details["getVideoCodec: "]     = $ffmpegInstance->getVideoCodec();
            $details["getAudioCodec: "]     = $ffmpegInstance->getAudioCodec();
            $details["getAudioChannels: "]  = $ffmpegInstance->getAudioChannels();
            $details["hasAudio: "]          = $ffmpegInstance->hasAudio();



            $thumb = $ffmpegInstance->getFrame($ffmpegInstance->getFrameCount() / 2);

            //$thumb->resize(80, 80);
            print_r($thumb);
            exit;
            $file_name =  $ffmpegInstance->getFilename();
            imagejpeg($thumb->toGDImage(), Yii::app()->basePath."/../images/thumbnail/".$file_name);

            echo "<img src=".Yii::app()->baseUrl."/images/thumbnail/".$file_name.">";

            print_r($details);
        }
        else
        {
            echo "Error Upload :P";
        }
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
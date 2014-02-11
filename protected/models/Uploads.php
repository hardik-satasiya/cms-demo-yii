<?php

/**
 * This is the model class for table "uploads".
 *
 * The followings are the available columns in table 'uploads':
 * @property integer $id
 * @property string $path
 */
class Uploads extends CActiveRecord
{
    
    
    public $picture; 
    public $file_name; 
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Uploads the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'uploads';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('path', 'required'),
			array('path', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, path', 'safe', 'on'=>'search'),
            array('picture', 'length', 'max' => 255, 'tooLong' => '{attribute} is too long (max {max} chars).', 'on' => 'upload'),
            array('picture', 'file', 'types' => 'jpg,jpeg,gif,png', 'maxSize' => 1024 * 1024 * 2, 'tooLarge' => 'Size should be less then 2MB !!!', 'on' => 'upload'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'path' => 'Path',
            'picture' => 'Picture',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('path',$this->path,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getThumbImageUrl()
    {
        $path = Yii::app()->baseUrl."/images/thumbnail/".$this->path;        
        return $path;
    }
    public function getImageUrl()
    {
        $path = Yii::app()->baseUrl."/images/".$this->path;
        $this->create_scaled_image($this->path);
        return $path;
    }
    
    
//    protected function create_scaled_image($file_name, $version="thumbnail", $options=array('max_width' => 80,'max_height' => 80))
//    {
//        $file_path = Yii::app()->baseUrl."/images/";
////        $file_path = $this->get_upload_path($file_name);
//        if (!empty($version)) 
//        {
//            $version_dir = Yii::app()->baseUrl."/images/thumb/";
//            if (!is_dir($version_dir)) {
//                mkdir($version_dir, 0777, true);
//            }
//            $new_file_path = $version_dir.'/'.$file_name;
//        } else {
//            $new_file_path = $file_path;
//        }
//        list($img_width, $img_height) = @getimagesize($file_path);
//        if (!$img_width || !$img_height) {
//            return false;
//        }
//        $scale = min(
//            $options['max_width'] / $img_width,
//            $options['max_height'] / $img_height
//        );
//        if ($scale >= 1) {
//            if ($file_path !== $new_file_path) {
//                return copy($file_path, $new_file_path);
//            }
//            return true;
//        }
//        $new_width = $img_width * $scale;
//        $new_height = $img_height * $scale;
//        $new_img = @imagecreatetruecolor($new_width, $new_height);
//        switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
//            case 'jpg':
//            case 'jpeg':
//                $src_img = @imagecreatefromjpeg($file_path);
//                $write_image = 'imagejpeg';
//                $image_quality = isset($options['jpeg_quality']) ?
//                    $options['jpeg_quality'] : 75;
//                break;
//            case 'gif':
//                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
//                $src_img = @imagecreatefromgif($file_path);
//                $write_image = 'imagegif';
//                $image_quality = null;
//                break;
//            case 'png':
//                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
//                @imagealphablending($new_img, false);
//                @imagesavealpha($new_img, true);
//                $src_img = @imagecreatefrompng($file_path);
//                $write_image = 'imagepng';
//                $image_quality = isset($options['png_quality']) ?
//                    $options['png_quality'] : 9;
//                break;
//            default:
//                $src_img = null;
//        }
//        $success = $src_img && @imagecopyresampled(
//            $new_img,
//            $src_img,
//            0, 0, 0, 0,
//            $new_width,
//            $new_height,
//            $img_width,
//            $img_height
//        ) && $write_image($new_img, $new_file_path, $image_quality);
//        // Free up memory (imagedestroy does not delete files):
//        @imagedestroy($src_img);
//        @imagedestroy($new_img);
//        return $success;
//    }
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
}
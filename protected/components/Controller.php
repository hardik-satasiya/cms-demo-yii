<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
define('SUPERADMIN', 1);
define('ADMIN', 2);
define('USER', 3);
define('GUEST', 4);

class Controller extends CController
{
        public $userData;
        public function init() 
        {
            
            // Load the user
            if (!Yii::app()->user->isGuest)
                $this->userData = Usertype::model()->findByPk(Yii::app()->user->id);
            //$firephp = FirePHP::getInstance(true);
            //$firephp->info($this->userData->attributes, 'hardik_debug'); 
            
        }
        public function allowUser($min_level)
        { //-1 no login required 1..3: admin level
            
            $current_level = 4;
            if ($this->userData !== null)
                $current_level = $this->userData->id;
            if ($min_level < $current_level) {
                throw new CHttpException(403, 'You have no permission to view this content');
            }
        }
        public function getMenufor($role)
        {
            
            $menu_model  = Menu::model()->findall();
            
            $criteria = new CDbCriteria;
            $criteria->condition = "role ='" . $role ."'";
            
            $privs_model = Usertype::model()->find($criteria);
            $actions = explode(",",$privs_model->actions);
            
            $temp = array();
            foreach($menu_model as $item)
            {
                $temp[$item->id] = $item;
            }            
            $sorted = array();            
            
            foreach($actions as $item)
            {
                $sorted[$item] = $temp[$item];                
            }            
            $sortable = array();
            foreach($sorted as $row)                
                $sortable[$row->id] = "<span style=\"color: yellowgreen;\">(".$row->id.") </span>".$row->menu_name;
            
            return $sortable;
        }
        public function getCustomMenu()
        {
            $menu_model  = Menu::model()->findall(); 
            
            if (!Yii::app()->user->isGuest)
                $actions = explode (',', $this->userData->actions);                                    
            else
                $actions = explode (',', '6,7');
            
            $menu = array();                        
            array_push($menu,array('label'=>'Home', 'url'=>array('/site/index'),'visible'=>1));                        
            //print_r($actions);            
            
            $temp = array();
            foreach($menu_model as $item)
            {
                $temp[$item->id] = $item;
            }
            $sorted = array();
            foreach($actions as $item)
            {
                $sorted[$item] = $temp[$item];
            }
            //print_r($sorted);
            
//            $res = array();
//            foreach($actions as $sortId) {
//               foreach($temp as $item ) {
//                  if( $item['id'] == $sortId ) {
//                     $res = $item;
//                     break;
//                  }
//               }
//            }
//            print_r($res);
            foreach($sorted as $item)
            {                   
                    //echo $item['id']. "--";
                    if(in_array($item['id'],$actions))
                    {
                        if(!$item->static)
                            $url = array($item->url);
                        else
                            $url = array($item->url,'view'=>$item->view,);                
                        
                        array_push($menu,array('id'=>$item->id,'label'=>$item->menu_name,'url'=>$url,'visible'=>1));
 
                        $count++;
                        
                    }
            }             
            
            
            array_push($menu,array('label'=>'myLogin', 'url'=>array('/site/mylogin'), 'visible'=>Yii::app()->user->isGuest),
                             array('label'=>'myLogout ('.Yii::app()->user->name.')', 'url'=>array('/site/mylogout'), 'visible'=>!Yii::app()->user->isGuest));
            
            return $menu;
        }
        
        public function get_declared_classes()
        {
            $allcls = array();
            foreach (glob(Yii::getPathOfAlias('application.controllers') . "/*Controller.php") as $controller){
              $class = basename($controller, ".php");
              if (!in_array($class, $declaredClasses))
                Yii::import("application.controllers." . $class, true);
              
              //if you want to use reflection
              array_push($allcls, $class);
              $reflection = new ReflectionClass($class); 
              $methods = $reflection->getMethods();
              //uncomment this if you want to get the class methods with more details
              //print_r($methods);

              //uncomment this if you want to get the class methods
              //print_r(get_class_methods($class));
            }
            return $allcls;    
            //you should see a list of all Controllers/Models
            //print_r(get_declared_classes());                    
        }
        
        public function getAllactions()
        {
              //print_r($this->get_declared_classes());
              $pagelist = array();
              foreach($this->get_declared_classes() as $cls)
                    {
                        if (preg_match('/Controller/',$cls)) 
                        {   
                            //print_r($cls);
                            $reflection = new ReflectionClass($cls);
                            $methods = $reflection->getMethods();
                            foreach($methods as $method)
                            {

                                if (preg_match('/^action+\w{2,}/',$method->name)) 
                                {
                                     $str = ("/".substr($method->class,0,  strlen($method->class)-10)."/".substr($method->name,6));
                                     //print_r(substr($method->class,0,  strlen($method->class)-10)."/".substr($method->name,6));echo "<br>";
                                     $pagelist[$str] = $str;
                                    // do something
                                }
                            }
                        }
                    }
                    
                return $pagelist;
        }
        public function getUsertypeDropdown()
        {
            $usertypes = CHtml::listData(Usertype::model()->findAll(), 'id', 'role');            
            return $usertypes;
        }
        public function getUsertypeValueDropdown()
        {
            $usertypes = CHtml::listData(Usertype::model()->findAll(), 'role', 'role');            
            return $usertypes;
        }        
        public function getCheckedPrivbooster($model)
        {            
            return (CJSON::encode($model->actions));            
        }
        public function getAllPrivs()
        {
                $criteria = new CDbCriteria;
                $criteria->select = "id,CONCAT(menu_name,' (',id,')') as labeled";            
                $criteria->condition = "active=1";

                $permissions = Menu::model()->findAll($criteria);
                
                return $permissions;
        }
        public function getCustomDDList($model,$id_field,$val_field)
        {
            $list = $model;

            $outer_array = array();
            foreach($list as $val)
            {
                $tmp_arr = array();                            

                $tmp_arr['id']=$val[$id_field];
                $tmp_arr['text']=$val[$val_field];

                array_push($outer_array,$tmp_arr);
            }        
            return $outer_array;
        }        
        public function getPriv_chk_box()
        {
            $criteria = new CDbCriteria;
            $criteria->select = "id,CONCAT(menu_name,' (',id,')') as labeled";            
            $criteria->condition = "active=1";           
            
            $privs = CHtml::listData(Menu::model()->findAll($criteria), 'id', 'labeled');                                   
            
            return $privs;
        }
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
}
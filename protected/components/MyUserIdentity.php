<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class MyUserIdentity extends CUserIdentity
{

        private $_id = 4;
        /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()	{


            $criteria = new CDbCriteria;
	       $criteria->select = '*';
	       $criteria->condition = "username='" . $this->username . "' AND userpass='" . $this->password . "'";


          $user = Users::model()->find($criteria);
            /*$users=array(
                    // username => password
                    'hardik'=>'hardik',
            );*/

            if(!isset($user->username))
                    $this->errorCode=self::ERROR_USERNAME_INVALID;
            elseif($user->userpass!==$this->password)
                    $this->errorCode=self::ERROR_PASSWORD_INVALID;
            else
            {
                    $this->errorCode=self::ERROR_NONE;
                    $this->_id = $user->usertype_id;
            }

            return !$this->errorCode;

	}
        public function getId()
        {
            return $this->_id;
        }

}
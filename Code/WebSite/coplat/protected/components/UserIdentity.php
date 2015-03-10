<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    private $_id;
    //private $_fullName;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{

		$user= User::model()->findByAttributes(array(
				'username'=>$this->username));

		
		if($user === null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		elseif($user->activated == 0)
			$this->errorCode = 7;				
		else
		{
            $this->_id=$user->id;
            //$this->_fullName = $user->fname . " " . $user->lname;
			$this->username = $user->username;
			//$this->setState('lastLogin', date('m/d/y''));
			
			$this->errorCode=self::ERROR_NONE;
		}	
		return !$this->errorCode;
	}
		
	
	public function authenticateOutside()
	{
		$user= User::model()->findByAttributes(array(
				'username'=>$this->username));
	
		$this->username = $user->username;
		//$this->setState('lastLogin', date('m/d/y''));

		
		return true;
	}



    public function getId()
    {
        return $this->_id;
    }

}
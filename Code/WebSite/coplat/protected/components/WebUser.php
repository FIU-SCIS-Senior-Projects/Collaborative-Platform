<?php
class WebUser extends CWebUser
{
    public function __get($name)
    {
        if ($this->hasState('__userInfo')) {
            $user=$this->getState('__userInfo',array());
            if (isset($user[$name])) {
                return $user[$name];
            }
        }

        return parent::__get($name);
    }

    public function login($identity, $duration) {
        $this->setState('__userInfo', $identity->getUser());
        parent::login($identity, $duration);
    }

    /*
    * Required to checkAccess function
    * Yii::app()->user->checkAccess('operation')
    */
    public function getId()
    {
        return $this->id;
    }

    public function getFullName()
    {

        return $this->getName();
    }
}
?>

?>
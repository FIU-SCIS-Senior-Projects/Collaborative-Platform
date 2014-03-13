<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $fname
 * @property string $mname
 * @property string $lname
 * @property string $pic_url
 * @property integer $activated
 * @property string $activation_chain
 * @property integer $disable
 * @property string $biography
 * @property string $linkedin_id
 * @property string $fiucs_id
 * @property string $google_id
 *
 * The followings are the available model relations:
 * @property Message[] $messages
 * @property Message[] $messages1
 * @property Domain[] $domains
 * @property Role[] $roles
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, lname, pic_url, activated', 'required'),
			array('activated, disable', 'numerical', 'integerOnly'=>true),
			array('username, fname, mname, activation_chain, linkedin_id, fiucs_id, google_id', 'length', 'max'=>45),
			array('password, email, pic_url', 'length', 'max'=>255),
			array('lname', 'length', 'max'=>100),
			array('biography', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, fname, mname, lname, pic_url, activated, activation_chain, disable, biography, linkedin_id, fiucs_id, google_id', 'safe', 'on'=>'search'),
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
			'messages' => array(self::HAS_MANY, 'Message', 'receiver'),
			'messages1' => array(self::HAS_MANY, 'Message', 'sender'),
			'domains' => array(self::MANY_MANY, 'Domain', 'user_domain(user_id, domain_id)'),
			'roles' => array(self::MANY_MANY, 'Role', 'user_role(user_id, role_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'fname' => 'Fname',
			'mname' => 'Mname',
			'lname' => 'Lname',
			'pic_url' => 'Pic Url',
			'activated' => 'Activated',
			'activation_chain' => 'Activation Chain',
			'disable' => 'Disable',
			'biography' => 'Biography',
			'linkedin_id' => 'Linkedin',
			'fiucs_id' => 'Fiucs',
			'google_id' => 'Google',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('mname',$this->mname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('pic_url',$this->pic_url,true);
		$criteria->compare('activated',$this->activated);
		$criteria->compare('activation_chain',$this->activation_chain,true);
		$criteria->compare('disable',$this->disable);
		$criteria->compare('biography',$this->biography,true);
		$criteria->compare('linkedin_id',$this->linkedin_id,true);
		$criteria->compare('fiucs_id',$this->fiucs_id,true);
		$criteria->compare('google_id',$this->google_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
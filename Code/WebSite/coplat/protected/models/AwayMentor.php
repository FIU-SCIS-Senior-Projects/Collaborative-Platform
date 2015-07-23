<?php

/**
 * This is the model class for table "away_mentor".
 *
 * The followings are the available columns in table 'away_mentor':
 * @property integer $userID
 * @property string $tiStamp
 */
class AwayMentor extends CActiveRecord
{
    public $user_search;
    public $name_search;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return AwayMentor the static model class
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
        return 'away_mentor';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('userID', 'numerical', 'integerOnly'=>true),
            array('tiStamp', 'default',
                'value'=>new CDbExpression('NOW()'),
                'setOnEmpty'=>false,'on'=>'insert'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('userID, tiStamp, user_search, name_search', 'safe', 'on'=>'search'),

        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('User' => array(self::BELONGS_TO, 'User',    'userID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'userID' => 'User',
            'tiStamp' => 'Time Stamp',
            'user_search' => 'User Name',
            'name_search' => 'Full Name',

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
        $criteria->with = array( 'user' );
        $criteria->compare('userID',$this->userID);
        $criteria->compare( 'user.username', $this->user_search, true );
        $criteria->compare( 'user.lname', $this->name_search, true, 'OR' );
        $criteria->compare( 'user.fname', $this->name_search, true, 'OR' );
        $criteria->compare('tiStamp',$this->tiStamp,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'attributes'=>array(
                    'user_search'=>array(
                        'asc'=>'user.username',
                        'desc'=>'user.username DESC',
                    ),
                    'name_search'=>array(
                        'asc'=>'user.fullName',
                        'desc'=>'user.fullName DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }

}
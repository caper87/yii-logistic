<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 */
class User extends CActiveRecord
{
	public $captcha;
	public $password2;
	static private $currentAuthUser = null;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, phone', 'required'),
			array('username, password, email, code, phone', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, email, code, created_at', 'safe', 'on'=>'search'),
			
			array('email',    'match',   'pattern'    => '/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/', 'message' => 'Не верный формат e-mail адреса.'),
			array('password2', 'compare', 'compareAttribute' => 'password', 'on'=>'reg'),
            array('captcha',  'captcha', 'allowEmpty' => !extension_loaded('gd'), 'on'=>'reg'),
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
			'username' => 'Логин',
			'password' => 'Пароль',
			'email' => 'Email',
			'code' => 'Код пользователя',
			'created_at' => 'Дата регистрации',
			'password2' => 'Пароль еще раз:',
            'captcha'   => 'Введите код с картинки:',
			'phone' => 'Телефон',
		);
	}
	
	static public function current() {
      if (Yii::app()->user->isGuest) {
         return new self();
      }
      if (is_null(self::$currentAuthUser)) {
         self::$currentAuthUser = self::model()->findByPk(
            Yii::app()->user->getId()
         );
      }
      return self::$currentAuthUser;
   }
   
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('created_at',$this->created_at,true);
		//$criteria->compare('rules',$this->rules,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password,$this->password);
    }
 
    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }
}

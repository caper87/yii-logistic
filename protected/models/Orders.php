<?php

/**
 * This is the model class for table "tbl_orders".
 *
 * The followings are the available columns in table 'tbl_orders':
 * @property integer $id
 * @property varchar $code
 * @property string $date_in
 * @property integer $num
 * @property string $description
 * @property string $comment
 * @property varchar $delivery
 * @property integer $price
 * @property varchar $insurance
 * @property integer $weight
 * @property integer $size
 * @property string $date_out
 * @property varchar $status
 */
class Orders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, date_in,  description, delivery, price, insurance, weight, size, status', 'required'),
			array('num,  price', 'numerical', 'integerOnly'=>true),
			array('comment,plot, weight, size,date_out', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,username, date_in, date_out, description, comment, delivery, price, insurance, weight, size, date_out, status', 'safe', 'on'=>'search'),
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
			'code'=>'Код пользователя',
			'date_in' => 'Дата поступления',
          //'num' => 'Количество в товара на одно место',
          //'num_place'=>'Количество мест',
			'description' => 'Описание груза',
			'comment' => 'Комментарий к заказу',
			'delivery' => 'Тип доставки',
			'price' => 'Оценочная стоимость груза в $',
			'insurance' => 'Страховка',
			'weight' => 'Вес',
			'size' => 'Объем',
            'plot' => 'Плотность',
			'date_out' => 'Дата отправки со склада',
			'status' => 'Статус заказа',
		);
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('date_in',$this->date_in,true);
		$criteria->compare('num',$this->num);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('delivery',$this->delivery);
		$criteria->compare('price',$this->price);
		$criteria->compare('insurance',$this->insurance);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('size',$this->size);
		$criteria->compare('date_out',$this->date_out,true);
		$criteria->compare('status',$this->status,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public  function addimg($id){
		$output_dir = "images/";
		if(isset($_FILES["myfile"]))
		{
			
			$ret = array();
			
		//	This is for custom errors;	
		/*	$custom_error= array();
			$custom_error['jquery-upload-file-error']="File already exists";
			echo json_encode($custom_error);
			die();
		*/
			$error =$_FILES["myfile"]["error"];
			//You need to handle  both cases
			//If Any browser does not support serializing of multiple files using FormData() 
			if(!is_array($_FILES["myfile"]["name"])) //single file
			{
		 	 	$fileName = $id.'__'.$_FILES["myfile"]["name"];
		 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
		    	$ret[]= $fileName;
		    	
		    	$foto = new Foto;
				$foto->id_order = $id;
			  	$foto->src = $fileName;
			  	$foto->save();
			}
			else  //Multiple files, file[]
			{
			  $fileCount = count($_FILES["myfile"]["name"]);
			  for($i=0; $i < $fileCount; $i++)
			  {
			  	$fileName = $id.'__'.$_FILES["myfile"]["name"][$i];
				move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
			  	$ret[]= $fileName;
			  	
			  	$foto = new Foto;
				$foto->id_order = $id;
			  	$foto->src = $fileName;
			  	$foto->save();
			  	
			  }
			
			}
		    echo json_encode($ret);
		 }
	}
}

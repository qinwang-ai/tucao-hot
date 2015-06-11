<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property string $item_id
 * @property string $item_title
 * @property string $item_detail
 * @property string $item_picture
 * @property string $publisher
 * @property string $publish_time
 * @property string $zan_times
 * @property string $cai_times
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Item extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_title', 'length', 'max'=>128),
			array('publisher', 'length', 'max'=>64),
			array('zan_times, cai_times, user_id', 'length', 'max'=>10),
			array('item_detail, item_picture', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('item_id, item_title, item_detail, item_picture, publisher, publish_time, zan_times, cai_times, user_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	public function scopes() {
		return array(
			'bystatus' => array('order' => 'publish_time DESC'),
			'bypop' => array('order' => 'zan_times*2-cai_times DESC'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'item_id' => 'Item',
			'item_title' => '标题',
			'item_detail' => '内容',
			'item_picture' => '上传图片',
			'publisher' => '发布者',
			'publish_time' => '发布时间',
			'zan_times' => '赞',
			'cai_times' => '踩',
			'user_id' => 'User',
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

		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('item_title',$this->item_title,true);
		$criteria->compare('item_detail',$this->item_detail,true);
		$criteria->compare('item_picture',$this->item_picture,true);
		$criteria->compare('publisher',$this->publisher,true);
		$criteria->compare('publish_time',$this->publish_time,true);
		$criteria->compare('zan_times',$this->zan_times,true);
		$criteria->compare('cai_times',$this->cai_times,true);
		$criteria->compare('user_id',$this->user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Item the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

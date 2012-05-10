<?php

/**
 * This is the model base class for the table "Lp".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Lp".
 *
 * Columns in table "Lp" available as properties of the model,
 * followed by relations of table "Lp" available as properties of the model.
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $website
 * @property string $rank
 * @property string $firm_id
 * @property double $assets_umgmt
 * @property string $assets_umgmt_ori
 * @property integer $top_interests
 *
 * @property Firm $firm
 * @property Lpcontinent[] $lpcontinents
 * @property Lpdocument[] $lpdocuments
 * @property Lpregion[] $lpregions
 * @property Lpsector[] $lpsectors
 * @property Lptarget[] $lptargets
 */
abstract class BaseLp extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'lp';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Lp|Lps', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('rank, firm_id, assets_umgmt, assets_umgmt_ori, top_interests', 'required'),
			array('top_interests', 'numerical', 'integerOnly'=>true),
			array('assets_umgmt', 'numerical'),
			array('name', 'length', 'max'=>50),
			array('website, assets_umgmt_ori', 'length', 'max'=>100),
			array('rank', 'length', 'max'=>1),
			array('firm_id', 'length', 'max'=>10),
			array('description', 'safe'),
			array('description', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, description, website, rank, firm_id, assets_umgmt, assets_umgmt_ori, top_interests', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'firm' => array(self::BELONGS_TO, 'Firm', 'firm_id'),
			'lpcontinents' => array(self::HAS_MANY, 'Lpcontinent', 'lp_id'),
			'lpdocuments' => array(self::HAS_MANY, 'Lpdocument', 'lp_id'),
			'lpregions' => array(self::HAS_MANY, 'Lpregion', 'lp_id'),
			'lpsectors' => array(self::HAS_MANY, 'Lpsector', 'lp_id'),
			'lptargets' => array(self::HAS_MANY, 'Lptarget', 'lp_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'name' => Yii::t('app', 'Name'),
			'description' => Yii::t('app', 'Description'),
			'website' => Yii::t('app', 'Website'),
			'rank' => Yii::t('app', 'Rank'),
			'firm_id' => null,
			'assets_umgmt' => Yii::t('app', 'Assets Umgmt'),
			'assets_umgmt_ori' => Yii::t('app', 'Assets Umgmt Ori'),
			'top_interests' => Yii::t('app', 'Top Interests'),
			'firm' => null,
			'lpcontinents' => null,
			'lpdocuments' => null,
			'lpregions' => null,
			'lpsectors' => null,
			'lptargets' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('website', $this->website, true);
		$criteria->compare('rank', $this->rank, true);
		$criteria->compare('firm_id', $this->firm_id);
		$criteria->compare('assets_umgmt', $this->assets_umgmt);
		$criteria->compare('assets_umgmt_ori', $this->assets_umgmt_ori, true);
		$criteria->compare('top_interests', $this->top_interests);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}

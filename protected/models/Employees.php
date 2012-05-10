<?php

Yii::import('application.models._base.BaseEmployees');

class Employees extends BaseEmployees
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    public function fullname() {
        return $this->last_name . ', ' . $this->first_name;
    }
    
}

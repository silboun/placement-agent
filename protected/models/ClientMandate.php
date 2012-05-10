<?php

Yii::import('application.models._base.BaseClientMandate');

class ClientMandate extends BaseClientMandate
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    public function getGps() {
        $gps = Gp::model()->findAll();
        $list =  array();
        foreach ($gps as $gp) {
            $list[$gp->id] = $gp->firm->name;
        }
        natcasesort($list);
        return $list;
    }
    
    public function LpItems($lps) {
        $list =  array();
        foreach ($lps as $lp) {
            $list[$lp->id] = $lp->firm->name;
        }
        natcasesort($list);
        return $list;
    }
    
    public function findLps($ranks, $continent_ids, $region_ids, $sector_ids) {
        $lps = array();
        
        $criteria = new CDbCriteria;
        $criteria->select = 't.id, t.firm_id';
        $criteria->distinct = true;
        $criteria->join = 'LEFT JOIN lpcontinent ON (lpcontinent.lp_id = t.id)
                           LEFT JOIN lpregion ON (lpregion.lp_id = t.id)
                           LEFT JOIN lpsector ON (lpsector.lp_id = t.id)';

        $criteria->addInCondition('lpcontinent.continent_id', $continent_ids, 'OR');
        $criteria->addInCondition('lpregion.region_id', $region_ids, 'OR');
        $criteria->addInCondition('lpsector.sector_id', $sector_ids, 'OR');

        $criteria2 = new CDbCriteria;
        $criteria2->addInCondition('rank', $ranks);
        $criteria->mergeWith($criteria2);
        $lps = Lp::model()->findAll($criteria);
        

        return $lps;
    }
    
    public function addLps($lps) {
        foreach ($lps as $lp) {
            $search = array('lp_id' => $lp, 'client_mandate_id' => $this->id);
            $exist = ClientMandateLp::model()->findAllByAttributes($search);
            if ( empty($exist)) {
                $cmlp = new ClientMandateLp();
                $cmlp->lp_id = $lp;
                $cmlp->client_mandate_id = $this->id;
                $cmlp->status = 1;
                if (!$cmlp->save()) {
                    throw new Exception('Error on add lp to client mandate.');
                }
            }
        }
    }
}

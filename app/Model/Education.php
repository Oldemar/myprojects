<?php
App::uses('AppModel', 'Model');
/**
 * Education Model
 *
 * @property User $User
 * @property Edulevel $Edulevel
 * @property Institute $Institute
 */
class Education extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Edulevel' => array(
			'className' => 'Edulevel',
			'foreignKey' => 'edulevel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Institute' => array(
			'className' => 'Institute',
			'foreignKey' => 'institute_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'City' => array(
				'className' => 'City',
				'foreignKey' => 'city_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
		)
	);
	
	public $validate = array(
				'perm' => array(
						'rule'     => 'numeric',
						'required' => true,
						'message'  => 'The Shared Level must be entered.',
						'allowEmpty' => false
				),
				'user_id' => array(
						'rule'     => 'numeric',
						'required' => true,
						'message'  => 'The user must be selected.',
						'allowEmpty' => false
				),

				'edulevel_id' => array(
						'rule'     => 'numeric',
						'required' => true,
						'message'  => 'The Education Level must be entered.',
						'allowEmpty' => false
				),
				'institute_id' => array(
						'rule'     => 'numeric',
						'required' => true,
						'message'  => 'The Institute must be entered.',
						'allowEmpty' => false
				),
				'city_id' => array(
						'rule'     => 'numeric',
						'required' => true,
						'message'  => 'The Location must be entered.',
						'allowEmpty' => false
				)
				
			);
	
	/**
	 * These virtual fields will be use in the controller and view
	 * @var enddate, startdate
	 */
	public $virtualFields = array(	'startdate' => 'CONCAT(Education.start_year,"-", Education.start_month,"-",Education.start_day)',
			'enddate' => 'CONCAT(Education.end_year,"-", Education.end_month,"-",Education.end_day)',
			'location' => 'Education.city_id'
	);
	
	
	/**
	 * This method fixes the fields
	 * Specialy: If the Edulevel_id is null, a new Edulevel is created.
	 * Location: If the Educationplace_is is null, a new Educationplace is created.
	 * City: If the city_id is null, a new City is created
	 * Enddate: If the current elemnt is 1, The end date is 9999-99-99
	 *
	 * @return boolean True: if all  required data is completed.
	 *
	 * @see Model::beforeSave()
	 */
	public function beforeValidate(){
	
		if(isset($this->data)){
			
			$this->data['Education']['start_year'] 		= ($this->data['Education']['startdate']['year']		!= '')?$this->data['Education']['startdate']['year']	:'0000';
			$this->data['Education']['start_month'] 		= ($this->data['Education']['startdate']['month'] 	!= '')?$this->data['Education']['startdate']['month']	:'00';
			$this->data['Education']['start_day'] 		= ($this->data['Education']['startdate']['day']			!= '')?$this->data['Education']['startdate']['day']		:'00';
						
			//The enddate field will be 9999-99-99
			if($this->data['Education']['current'] == '1'){
			
				$this->data['Education']['end_year'] 	= '9999';
				$this->data['Education']['end_month'] 	= '99';
				$this->data['Education']['end_day'] 	= '99';
			}
			else{
				
				$this->data['Education']['end_year'] 		= ($this->data['Education']['enddate']['year']		!= '')?$this->data['Education']['enddate']['year']		:'0000';
				$this->data['Education']['end_month'] 		= ($this->data['Education']['enddate']['month'] 	!= '')?$this->data['Education']['enddate']['month']		:'00';
				$this->data['Education']['end_day'] 		= ($this->data['Education']['enddate']['day']		!= '')?$this->data['Education']['enddate']['day']		:'00';
								
			}
				

		}
	
	}
	
	
	/**
	 * The validatePositivePeriod method validate the start_date < end_date
	 *
	 * @param Date $start
	 * @param Date $end
	 * @return boolean true if start > end
	 */
	public function validatePositivePeriod($start, $end = null){

		return ( strtotime($start) < strtotime($end) );

	}	
	
	
	/**
	 * TEST PROPOSAL
	 * Enter description here ...
	 * @param unknown_type $user_id
	 */
	public function getEducation($user_id){
	
		return $this->find('all', array('conditions'=>array('Education.user_id'=>$user_id ), 'order'=>array('Education.end_date'=>'desc')));
	}
	
	/**
	 * The listEducationByUserId method returns an array Education objects based on the user id
	 *
	 * @param inter $userId
	 * @return array Education objects
	 */
	public function listEducationByUserId($userId = null){
	
		return $this->findBy('user_id', $userId, 'all', array('order' => array( 'Education.enddate DESC')));
	
	
	}
	
	public function listGlobalEducationByUserId($userId = null){
		
		return $this->findBy('user_id', $userId, 'all', array('conditions'=>array('perm'=>2), 'order' => array( 'Education.enddate DESC')));
	}

	
	public function listGlobalFriendEducationByUserId($userId = null, $friend = false){

		$condition = array(2);
		
		if($friend){
			$condition = array(1,2);
		}
		
		return $this->findBy('user_id', $userId, 'all', array('conditions'=>array('perm'=>$condition), 'order' => array( 'Education.enddate DESC')));
	}
	
	
	public function getEducationById($id = null){
	
		return $this->findById($id) ;
	
	}
	
	/**
	 * Adds the fields: city, institute and edulevel. if these are new added by the user
	 *
	 * @return avoid
	 */
	public function setFields(){
		
		//Save the Edulevel if this is already in the database
		if(empty($this->data['Education']['edulevel_id'] ) ){
		
			if( $this->data['Edulevel']['name'] != ''){
		
		
				$this->data['Edulevel']['id'] 			= null;
				$this->data['Edulevel']['user_id'] 		= $this->data['Education']['user_id'];
				$this->data['Edulevel']['active'] 		= 0;
		
				if($this->Edulevel->save($this->data['Edulevel'])){
		
					$this->data['Education']['edulevel_id'] = $this->Edulevel->id;
				}
		
			}
		}
		
		
		//Save the Educationplace.name if this is not already in the database
		if(empty($this->data['Education']['institute_id'])){
		
			if( $this->data['Institute']['name'] != ''){
		
				$this->data['Institute']['id'] 			= null;
				$this->data['Institute']['user_id'] 	= $this->data['Education']['user_id'];
				$this->data['Institute']['active'] 		= 0;
		
				if($this->Institute->save($this->data['Institute'])){
		
					$this->data['Education']['institute_id'] = $this->Institute->id;
				}
			}
		}
		
		//Add city if this is not in the database
		if(empty($this->data['Education']['city_id'])){
		
			if( $this->data['Education']['location'] != ''){
		
				$this->loadModel('City');
		
				if($cityId = $this->City->addCityForUser($this->data['Education']['location'], $this->data['Education']['user_id'])){
		
					$this->data['Education']['city_id'] = $cityId;
				}
		
			}
				
		}		
	}
	
}

<?php
App::uses('AppModel', 'Model');
/**
 * Work Model
 *
 * @property User $User
 * @property Specialty $Specialty
 * @property Workplace $Workplace
 */
class Work extends AppModel {

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
		'Specialty' => array(
			'className' => 'Specialty',
			'foreignKey' => 'specialty_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Workplace' => array(
			'className' => 'Workplace',
			'foreignKey' => 'workplace_id',
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
	
	/**
	 * These virtual fields will be use in the controller and view
	 * @var enddate, startdate
	 */
	public $virtualFields = array(	'startdate' => 'CONCAT(Work.start_year,"-", Work.start_month,"-",Work.start_day)',
									'enddate' => 'CONCAT(Work.end_year,"-", Work.end_month,"-",Work.end_day)'
								);
	
	/**
	 * @TODO: The message must be used the i18n
	 * @var unknown_type
	 */
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

				'specialty_id' => array(
						'rule'     => 'numeric',
						'required' => true,
						'message'  => 'The Specialty must be entered.',
						'allowEmpty' => false
				),
				'workplace_id' => array(
						'rule'     => 'numeric',
						'required' => true,
						'message'  => 'The Workplace must be entered.',
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
	 * This method fixes the fields
	 * Specialy: If the specialty_id is null, a new Specialty is created.
	 * Location: If the workplace_is is null, a new Workplace is created.
	 * City: If the city_id is null, a new City is created
	 * Enddate: If the current elemnt is 1, The end date is 9999-99-99
	 * 
	 * @return boolean True: if all  required data is completed.
	 * 
	 * @see Model::beforeSave()
	 */
	public function beforeValidate(){
		
		if(isset($this->data)){
			
			$this->data['Work']['start_year'] 		= ($this->data['Work']['startdate']['year']		!= '')?$this->data['Work']['startdate']['year']		:'0000';
			$this->data['Work']['start_month'] 		= ($this->data['Work']['startdate']['month'] 	!= '')?$this->data['Work']['startdate']['month']	:'00';
			$this->data['Work']['start_day'] 		= ($this->data['Work']['startdate']['day']		!= '')?$this->data['Work']['startdate']['day']		:'00';
				
				
			//The enddate field will be 9999-99-99
			if($this->data['Work']['current'] == 1){
				
				$this->data['Work']['end_year'] 	= '9999';
				$this->data['Work']['end_month'] 	= '99';
				$this->data['Work']['end_day'] 		= '99';
			}
			else{
				
				$this->data['Work']['end_year'] 		= ($this->data['Work']['enddate']['year']		!= '')?$this->data['Work']['enddate']['year']		:'0000';
				$this->data['Work']['end_month'] 		= ($this->data['Work']['enddate']['month'] 		!= '')?$this->data['Work']['enddate']['month']		:'00';
				$this->data['Work']['end_day'] 			= ($this->data['Work']['enddate']['day']		!= '')?$this->data['Work']['enddate']['day']		:'00';
				
			}
			
		}
		
	}	
	
	/**
	 * TEST PROPOSAL
	 * Enter description here ...
	 * @param unknown_type $user_id
	 * 
	 * @TODO: Change the name of the method to getWorkByUserId
	 * @deprecated
	 */
	public function getWork($user_id){
	
		return $this->find('all', array('conditions'=>array('Work.user_id'=>$user_id ), 'order'=>array('Work.end_date'=>'desc')));
	}
	
	/**
	 * The listWorkByUserId method returns an array Work object based on the user id
	 * 
	 * @param inter $userId
	 * @return array Work
	 */
	public function listWorkByUserId($userId = null){
		
		return $this->findBy('user_id', $userId, 'all', array('order' => array( 'Work.enddate DESC')));
		

	}
	
	public function listGlobalWorkByUserId($userId = null){
	
		return $this->findBy('user_id', $userId, 'all', array('conditions'=>array('perm'=>2), 'order' => array( 'Work.enddate DESC')));
	
	
	}
	
	public function listGlobalFriendWorkByUserId($userId = null, $friend = false){
	
		$condition = array(2);
	
		if($friend){
			$condition = array(1,2);
		}
	
		return $this->findBy('user_id', $userId, 'all', array('conditions'=>array('perm'=>$condition), 'order' => array( 'Work.enddate DESC')));
	}
	
	
	
	public function getWorkById($id = null){
		
		return $this->findById($id) ;
		
	}
	
	/**
	 * Adds the fields: city, specialty and workplace. if these are new added by the user
	 * 
	 * @return avoid
	 */
	public function setFields(){

		//Save the Specialty if this is already in the database
		if(empty($this->data['Work']['specialty_id'] ) ){
		
			if( $this->data['Specialty']['name'] != ''){
		
		
				$this->data['Specialty']['id'] 			= null;
				$this->data['Specialty']['user_id'] 	= $this->data['Work']['user_id'];
				$this->data['Specialty']['active'] 		= 0;
		
				if($this->Specialty->save($this->data['Specialty'])){
		
					$this->data['Work']['specialty_id'] = $this->Specialty->id;
				}
					
			}
		}
			
		
		//Save the Workplace.name if this is not already in the database
		if(empty($this->data['Work']['workplace_id'])){
		
			if( $this->data['Workplace']['name'] != ''){
					
				$this->data['Workplace']['id'] = null;
				$this->data['Workplace']['user_id'] = $this->data['Work']['user_id'];
				$this->data['Workplace']['active'] = 0;
		
				if($this->Workplace->save($this->data['Workplace'])){
		
					$this->data['Work']['workplace_id'] = $this->Workplace->id;
				}
			}
		}
		
		//Add city if this is not in the database
		if(empty($this->data['Work']['city_id'])){
		
			if( $this->data['Workplace']['location'] != ''){
					
				if($cityId = $this->City->addCityForUser($this->data['Workplace']['location'], $this->data['Work']['user_id'])){
		
					$this->data['Work']['city_id'] = $cityId;
				}
					
			}
				
		}		
	}
}

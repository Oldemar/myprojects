<?php 

class City extends AppModel {
	
	public $name = 'City';

	public $belongsTo = array(
			'Region' => array(
				'className' => 'Region',
				 'foreignKey' => 'region_id'
			),
			'Country'=> array(
				'className' => 'Country',
				'foreingKey' => 'country_id'
			)
		);
	
	public $hasMany = array(
			'Journal' => array(
				'className'=>'Journal',
				'foreingKey' =>'city_id'
			),
			'CityBirth' => array(
				'className' => 'Contact', 
				'foreignKey' => 'birth_city_id'
			),
			'CityRes' => array(
				'className' => 'Contact', 
				'foreignKey' => 'res_city_id'
			),
			'CityBus' => array(
				'className' => 'Contact', 
				'foreignKey' => 'bus_city_id'
			)
		);
	
	
	/**
	 * Get the most used cities to use on CityHelper
	 */
	function getCitiesForSmartCache(){
		$cacheName = 'CitySmartCache';
		
		if(!$result = Cache::read($cacheName,'1 week')){
			$tmp = $this->query('
			select 
				city_id , count(1) qtd
			from 
				works 
			where 
				city_id > 0
			group by 
				city_id
			union all
			select 
				city_id, count(1) qtd
			from 
				educations 
			where 
				city_id > 0
			group by 
				city_id
			order by qtd desc
				limit 50
			');
			
			$arrCityId = array();
			foreach($tmp as $value){
				$arrCityId[] = $value[0]['city_id'];
			}
			
			if(count($arrCityId) > 0){
				$conditions = array(
					'1'=>'1 and City.id in ('.implode(',',$arrCityId).')',
					'City.user_id' => 0
					);
			}else{
				$conditions = array('City.user_id' => 0);
			}
			
			$result = $this->find('all',array(
									'limit'=>50,
									'recursive'=>0,
									'order' => array('City.name'),
									'conditions' => $conditions
								)
							);
							
			Cache::write($cacheName,$result,'1 week');			
		}
		return $result;	
	}
	
	/**
	 * Search utilized on autocomplete location
	 */
	function searchCities($search){
		$cacheName = 'CitySearch'.md5($search);
		
		if(!$result = Cache::read($cacheName,'1 week')){	
			$result = $this->find('all',
					array(
							'recursive'=>0,
							'conditions' => array(
									"City.name LIKE" => "%".$search."%",
									"City.user_id" => '0' 
							),
							'limit'=>20,
							'order' => array('City.name')
					)
			);
			Cache::write($cacheName, $result,'1 week');
		}
		return $result;
		
	}
	
	/**
	 * Transform and Database Array into an array formated for autocomplete helper
	 * @param array $result
	 * @return array
	 */
	function prepareResultsForAutocomplete($result){
		$return = array();
		foreach($result as $key => $value){
			if(isset($value['Region']['code'])){
				$return[] = array('label'=>$value['City']['name'].', '.$value['Region']['code'].', '.$value['Country']['name'],'id'=>$value['City']['id']);
			}else{
				$return[] = array('label'=>$value['City']['name']);
			}
		}
		return $return;
	}
	
	
	/**
	 * The addCityForUser method, create a new city record when the entered City form the user is not in the database
	 * 
	 * @param String $city
	 * @param String $user
	 */
	public function addCityForUser($cityName, $userId){
		
		$city = array('City' => array('country_id'=>0,
					'region_id'=> 0,
					'name'=>$cityName,
					'latitude'=>0,
					'longitude'=>0,
					'timezone'=>0,
					'dmaid'=>0,
					'code'=>0,
					'user_id'=>$userId));
		
		if($this->save($city)){
		
			return $this->id;
		}
		
		return null;
	}
	
	/**
	 * The searchNewCity method search the new city tiped by the user.
	 * 
	 * @param String $cityName
	 * @param String $userId
	 * @return obj City
	 */
	public function searchNewCity($cityName, $userId){
		
		if($cityObj = $this->findObjects('first', array('conditions'=>array('City.name'=>$cityName,'City.user_id'=>$userId)), 0)){
			
			return $cityObj;
			
		}
		
		return false;
	}
	

	/**
	 * Search for and return all the cities associated to a USER.
	 * If a city has user_id it means that this city didn't exist on the table when the user needed.
	 * Cities with user_id should only be visible to the user with that id
	 */
	function searchCitiesForUser($search,$user){
		if(is_object($user)){
			$user = $user->getAttr('id');
		}
		
		return $this->findObjects('all',array('conditions'=>array('City.user_id'=>$user,'City.name like'=>'%'.$search.'%')));
	}
	
	/**
	 * The getNameToExhibit method returns the String City, Region, Country
	 * If the City doesn't have Region, It only returns the City name
	 * 
	 * @return String 'City, Region, Country'
	 */
	public function getNameToExhibit(){
		$regionId = $this->getAttr('region_id');
		
		if($regionId > 0){
			$this->loadModel('Region');
			$this->Region = $this->Region->findById($regionId);
			
			return $this->getAttr('name').', '.$this->Region->getAttr('region').', '.$this->Region->Country->getAttr('name');
		}else{
			return $this->getAttr('name');
		}
		
	}
	
	public function getNameToExhibitWithCountryCode(){
		$regionId = $this->getAttr('region_id');
	
		if($regionId > 0){
			$this->loadModel('Region');
			$this->Region = $this->Region->findById($regionId);
				
			return $this->getAttr('name').', '.$this->Region->getAttr('code').', '.$this->Region->Country->getAttr('iso3');
		}else{
			return $this->getAttr('name');
		}
	
	}	


}

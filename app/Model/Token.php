<?php 

class Token extends AppModel {
	
	var $useTable = false;
	
	private $key;
	private $lastDigitSalt;
	private $token;
	
	private function setKey($key){
		$this->key = $key;
	}
	
	private function setLastDigitSalt(){
		$this->lastDigitSalt = intval(substr($this->key,strlen($this->key)-1,1));
	}
	
	private function _generate(){
		$s = date('s');
		$s1 = substr($s,0,1);
		$s2 = substr($s,1,1);
		
		$hi = date('Hi');
		
		
		$this->token = substr($hi,0,1).$s1.substr($hi,1,1).$s2.substr($hi,2,2);
	}
	
	private function addSalt(){
		$this->setLastDigitSalt();
		$tmpToken = '';
		for($x=0;$x<strlen($this->token);$x++){
			$tmp = substr($this->token,$x,1)+$this->lastDigitSalt;
			$tmpToken .= substr($tmp,strlen($tmp)-1,1);
		}
		$this->token = strrev($tmpToken);
	}
	
	private function removeSalt(){
		$this->setLastDigitSalt();
		$this->token = strrev($this->token);
		$tmpToken = array();
		for($x=0;$x<strlen($this->token);$x++){
			$t = substr($this->token,$x,1);
			$t = (int) $t;
			
			if(($t - $this->lastDigitSalt)<0){
				$t = 10 + ($t - $this->lastDigitSalt); 
			}else{
				$t = $t - $this->lastDigitSalt;
			}
			$tmp = $t;
			$tmpToken[] = $tmp;
		}
		
		$this->token = implode('' , $tmpToken);
	}
	
	private function getHi(){
		$this->removeSalt();
		$hi = array();
		$hi['h'] = substr($this->token,0,1).substr($this->token,2,1);
		$hi['i'] = substr($this->token,4,2);
		return $hi;
	}
	
	public function getSixDigitToken($key){
		$this->setKey($key);
		
		$this->_generate();
		
		$this->addSalt();
		return $this->token;
	}
	
	public function validateTokenByTime($token, $key, $minutes){
		$token = intval($token);
		if(!is_numeric($token) || !$token){
			return false;
		}
		$this->key = $key;
		$this->token = $token;
		$now = new DateTime('now');
		
		$before = clone $now;
		$before->sub(new DateInterval('PT'.$minutes.'M'));
		
		$hi = $this->getHi();
		if(!is_numeric($hi['h']) || $hi['h'] > 24){
			return false;
		}
		
		if(!is_numeric($hi['i']) || $hi['i'] > 60){
			return false;
		}
		
		
		$tokenDate = new DateTime($before->format('Y-m-d ').$hi['h'].':'.$hi['i'].':00');
		
		if($tokenDate >= $before && $tokenDate <= $now){
			return true;
		}
		
		return false;
	}
}
?>

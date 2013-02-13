<?php
class GlobalJournalsShell extends AppShell {
	
	public $uses = array('Journal');
	
	public function main() {
		$arr = $this->Journal->query('SELECT * FROM global_journals_audit GROUP BY journal_id');
		$countAdded = 0;
		$countDeleted = 0;
		$arrJournalId = array();
		
		$this->out('COUNT:'.count($arr));
		
		if(is_array($arr)){
			foreach($arr as $key => $value){
				$arrJournalId[] = $journalId = $value['global_journals_audit']['journal_id'];
				
				$objJournal = $this->Journal->findById($journalId);
				if($objJournal->isJournalGlobal()){
					$this->Journal->query('REPLACE INTO global_journals SET journal_id='.$objJournal->getID());
					$countAdded++;
				}else{
					$this->Journal->query('DELETE FROM global_journals WHERE journal_id='.$objJournal->getID());
					$countDeleted++;
				}
			}
			if(count($arrJournalId) > 0){
				$this->Journal->query('DELETE FROM global_journals_audit WHERE journal_id in ('.implode(',',$arrJournalId).')');
			}
		}
		$this->out('COUNT GLOBAL:'.$countAdded);
		$this->out('COUNT NOT GLOBAL:'.$countDeleted);
	}
}
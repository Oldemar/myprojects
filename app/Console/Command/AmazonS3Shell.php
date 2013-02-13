<?php
class AmazonS3Shell extends AppShell {
	
	public $uses = array('Photo','AmazonS3ImageBucket','Journal', 'Picture','Video');
	
	public function main(){
		App::uses('CakeEmail', 'Network/Email');
		
		//IMPORTANT: THIS CRON IS NOT SUPOSED TO RUN ON ANY SERVER OTHER THAN PRODUCTION
		if(Configure::read('environment') != "production"){
			exit();
		}
		
		$arr = $this->Photo->query('SELECT * FROM photos Photo WHERE url = "/img/"');
		$out = '';
		
		$out .= 'Total photos to be moved to Amazon S3:'.count($arr);
		
		
		if(is_array($arr)){
			foreach($arr as $key => $value){
				$out .= '<br><b>'.($key+1) .'</b>:<pre>'.print_r($value,true).'</pre>';
				
				$targetFile = IMAGES.$value['Photo']['name'];
				$file = new File($targetFile,false,0777);
				
				$targetThumb50 = IMAGES.$value['Photo']['w50'];
				$file50 = new File($targetThumb50,false,0777);
				
				$targetThumb150 = IMAGES.$value['Photo']['w150'];
				$file150 = new File($targetThumb150,false,0777);
				
				$targetThumb240 = IMAGES.$value['Photo']['w240'];
				$file240 = new File($targetThumb240,false,0777);
				
				$targetThumb520 = IMAGES.$value['Photo']['w520'];
				$file520 = new File($targetThumb520,false,0777);
				
				
				$objJournal = $this->Journal->findById($value['Photo']['journal_id'],array(),0);
				$objJournal->buildBelong('User');
				
				try{
					if(!$file->exists() || !$file50->exists() || !$file150->exists() || !$file240->exists() || !$file520->exists()){
						throw new Exception("The file or one the thumbnails don't exist.");
					}
					
					$amazonS3 = $this->AmazonS3ImageBucket;
					$amazonS3->init(); // necessary for now; maybe not in the future
					$amazonS3->putObjectFile($targetFile, $amazonS3->bucket, 'img/'.$value['Photo']['name'], S3::ACL_PUBLIC_READ);
					$amazonS3->putObjectFile($targetThumb50, $amazonS3->bucket, 'img/'.$value['Photo']['w50'], S3::ACL_PUBLIC_READ);
					$amazonS3->putObjectFile($targetThumb150, $amazonS3->bucket, 'img/'.$value['Photo']['w150'], S3::ACL_PUBLIC_READ);
					$amazonS3->putObjectFile($targetThumb240, $amazonS3->bucket, 'img/'.$value['Photo']['w240'], S3::ACL_PUBLIC_READ);
					$amazonS3->putObjectFile($targetThumb520, $amazonS3->bucket, 'img/'.$value['Photo']['w520'], S3::ACL_PUBLIC_READ);
					
					$this->Photo->query("UPDATE photos SET url='".Configure::read('IMG_URL')."' WHERE id = ".$value['Photo']['id'].' limit 1');
					
					if(!$file->delete()){
						throw new Exception('Error deleting: '.print_r($file->info(),true));
						continue;
					}
					if(!$file50->delete()){
						throw new Exception('Error deleting: '.print_r($file->info(),true));
						continue;
					}
					if(!$file150->delete()){
						throw new Exception('Error deleting: '.print_r($file->info(),true));
						continue;
					}
					if(!$file240->delete()){
						throw new Exception('Error deleting: '.print_r($file->info(),true));
						continue;
					}
					if(!$file520->delete()){
						throw new Exception('Error deleting: '.print_r($file->info(),true));
						continue;
					}
					
					
				}catch (Exception $e){
					$out .= '<b><font color="red">EXCEPTION:'.$e->getMessage().'</font></b>';
					continue;
				}
				
					
			}
		}
		
		if(count($arr) > 0){
			$email = new CakeEmail('smtp');
			$email->from(array('info@alphasunandsport.com' => 'Info AlphaSunAndSport'))
			->to(Configure::read('Developers.email'))
			->subject('S3 Cron')
			->emailFormat('html')
			->send($out);
		}
	}
	
	public function video(){
		App::uses('CakeEmail', 'Network/Email');

		//IMPORTANT: THIS CRON IS NOT SUPOSED TO RUN ON ANY SERVER OTHER THAN PRODUCTION
		if(Configure::read('environment') != "production"){
			exit();	
		}

		$arr = $this->Video->query('SELECT * FROM videos Video WHERE url = "/img/"');
		$out = '';

		$out .= 'Total VIDEOS to be moved to Amazon S3:'.count($arr);

		if(is_array($arr)){
			foreach($arr as $key => $value){
				$out .= '<br><b>'.($key+1) .'</b>:<pre>'.print_r($value,true).'</pre>';

				$targetFileOriginal = IMAGES.$value['Video']['name'].".".$value['Video']['originalextension'];
				$fileOriginal = new File($targetFileOriginal,false,0777);

				$targetFileConverted = IMAGES.$value['Video']['name'].".mp4";
				$fileConverted = new File($targetFileConverted,false,0777);

				$targetThumbJpg = IMAGES.$value['Video']['name'].".jpg";
				$fileJpg = new File($targetThumbJpg,false,0777);

				$targetThumb140 = IMAGES.$value['Video']['w140'].".jpg";
				$file140 = new File($targetThumb140,false,0777);

				$targetThumb375 = IMAGES.$value['Video']['w375'].".jpg";
				$file375 = new File($targetThumb375,false,0777);

				$out .= "<br>
						Original Video   => $targetFileOriginal<br>
						Converted Video  => $targetFileConverted<br>
						JPG Normal       => $targetThumbJpg<br>
						JPG 140          => $targetThumb140<br>
						JPG 375          => $targetThumb375<br>" ;
				
				$objJournal = $this->Journal->findById($value['Video']['journal_id'],array(),0);
				$objJournal->buildBelong('User');

				try{
 					if(!$fileOriginal->exists() || !$fileConverted->exists() || !$fileJpg->exists() || !$file140->exists() || !$file375->exists()){
						throw new Exception("The file or one the thumbnails doesn't exist.");
					}

					$amazonS3 = $this->AmazonS3ImageBucket;
					$amazonS3->init(); // necessary for now; maybe not in the future
					$amazonS3->putObjectFile($targetFileOriginal, $amazonS3->bucket, 'img/'.$value['Video']['name'].".".$value['Video']['originalextension'], S3::ACL_PUBLIC_READ);
					$amazonS3->putObjectFile($targetFileConverted, $amazonS3->bucket, 'img/'.$value['Video']['name'].".mp4", S3::ACL_PUBLIC_READ);
					$amazonS3->putObjectFile($targetThumbJpg, $amazonS3->bucket, 'img/'.$value['Video']['name'].".jpg", S3::ACL_PUBLIC_READ);
					$amazonS3->putObjectFile($targetThumb140, $amazonS3->bucket, 'img/'.$value['Video']['w140'].".jpg", S3::ACL_PUBLIC_READ);
					$amazonS3->putObjectFile($targetThumb375, $amazonS3->bucket, 'img/'.$value['Video']['w375'].".jpg", S3::ACL_PUBLIC_READ);
					
					$this->Video->query("UPDATE videos SET url='".Configure::read('IMG_URL')."' WHERE id = ".$value['Video']['id'].' limit 1');
					
					if(!$fileOriginal->delete()){
						throw new Exception('Error deleting: '.print_r($file->info(),true));
						continue;
					}
					if(!$fileConverted->delete()){
						throw new Exception('Error deleting: '.print_r($file->info(),true));
						continue;
					}
					if(!$fileJpg->delete()){
						throw new Exception('Error deleting: '.print_r($file->info(),true));
						continue;
					}
					if(!$file140->delete()){
						throw new Exception('Error deleting: '.print_r($file->info(),true));
						continue;
					}
					if(!$file375->delete()){
						throw new Exception('Error deleting: '.print_r($file->info(),true));
						continue;
					}
					
				}catch (Exception $e){
					$out .= '<b><font color="red">EXCEPTION:'.$e->getMessage().'</font></b>';
						continue;
				}
				}
			}

		if(count($arr) > 0){
				$email = new CakeEmail('smtp');
				$email->from(array('info@alphasunandsport.com' => 'Info AlphaSunAndSport'))
					->to(Configure::read('Developers.email'))
					->subject('S3 Cron - Videos')
					->emailFormat('html')
					->send($out);
	
		}

	}
	
	
}
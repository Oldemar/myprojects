<?php
class AlbumcommentsController extends AppController {

/**
 * saveAlbumcommnet method
 *
 * @return void
 */
	public function saveAlbumcomment() {
		if ($this->request->is('post')) {
			$this->Albumcomment->save($this->request->data);
		}
		$this->redirect($this->referer());
	}

	
}

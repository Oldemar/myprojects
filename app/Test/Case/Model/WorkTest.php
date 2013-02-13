<?php
App::uses('Work', 'Model');

/**
 * Work Test Case
 *
 */
class WorkTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.work', 'app.user', 'app.picture', 'app.contact', 'app.country', 'app.journal', 'app.area', 'app.interest', 'app.areas_user', 'app.region', 'app.city', 'app.comment', 'app.photo', 'app.photo_comment', 'app.album_comment', 'app.video', 'app.videocomment', 'app.journalperm', 'app.journalrate', 'app.invitation', 'app.group', 'app.groups_user', 'app.relation', 'app.specialty', 'app.workplace');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Work = ClassRegistry::init('Work');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Work);

		parent::tearDown();
	}

}

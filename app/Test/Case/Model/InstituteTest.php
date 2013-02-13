<?php
App::uses('Institute', 'Model');

/**
 * Institute Test Case
 *
 */
class InstituteTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.institute', 'app.user', 'app.picture', 'app.contact', 'app.country', 'app.journal', 'app.area', 'app.interest', 'app.areas_user', 'app.region', 'app.city', 'app.comment', 'app.photo', 'app.photo_comment', 'app.album_comment', 'app.video', 'app.videocomment', 'app.journalperm', 'app.journalrate', 'app.invitation', 'app.group', 'app.groups_user', 'app.relation', 'app.education', 'app.edulevel', 'app.edulevels_institute');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Institute = ClassRegistry::init('Institute');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Institute);

		parent::tearDown();
	}

}

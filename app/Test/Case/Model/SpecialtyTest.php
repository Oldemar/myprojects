<?php
App::uses('Specialty', 'Model');

/**
 * Specialty Test Case
 *
 */
class SpecialtyTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.specialty', 'app.user', 'app.picture', 'app.contact', 'app.country', 'app.journal', 'app.area', 'app.interest', 'app.areas_user', 'app.region', 'app.city', 'app.comment', 'app.photo', 'app.photo_comment', 'app.album_comment', 'app.video', 'app.videocomment', 'app.journalperm', 'app.journalrate', 'app.invitation', 'app.group', 'app.groups_user', 'app.relation', 'app.work', 'app.workplace');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Specialty = ClassRegistry::init('Specialty');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Specialty);

		parent::tearDown();
	}

}

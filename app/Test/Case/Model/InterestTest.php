<?php
App::uses('Interest', 'Model');

/**
 * Interest Test Case
 *
 */
class InterestTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.interest', 'app.user', 'app.picture', 'app.contact', 'app.country', 'app.journal', 'app.area', 'app.areas_user', 'app.region', 'app.city', 'app.comment', 'app.photo', 'app.video', 'app.journalperm', 'app.relation', 'app.community', 'app.communities_user', 'app.education', 'app.edulevel', 'app.institute', 'app.edulevels_institute', 'app.group', 'app.groups_user', 'app.invitation', 'app.specialty', 'app.work', 'app.specialties', 'app.workplace');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Interest = ClassRegistry::init('Interest');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Interest);

		parent::tearDown();
	}

}

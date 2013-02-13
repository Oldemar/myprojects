<?php
App::uses('InterestsController', 'Controller');

/**
 * TestInterestsController *
 */
class TestInterestsController extends InterestsController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * InterestsController Test Case
 *
 */
class InterestsControllerTestCase extends CakeTestCase {
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
		$this->Interests = new TestInterestsController();
		$this->Interests->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Interests);

		parent::tearDown();
	}

}

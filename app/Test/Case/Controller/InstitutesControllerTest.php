<?php
App::uses('InstitutesController', 'Controller');

/**
 * TestInstitutesController *
 */
class TestInstitutesController extends InstitutesController {
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
 * InstitutesController Test Case
 *
 */
class InstitutesControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.institute', 'app.user', 'app.picture', 'app.contact', 'app.country', 'app.journal', 'app.area', 'app.interest', 'app.areas_user', 'app.region', 'app.city', 'app.comment', 'app.photo', 'app.photo_comment', 'app.album_comment', 'app.video', 'app.videocomment', 'app.journalperm', 'app.journalrate', 'app.invitation', 'app.group', 'app.groups_user', 'app.relation', 'app.education', 'app.edulevel');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Institutes = new TestInstitutesController();
		$this->Institutes->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Institutes);

		parent::tearDown();
	}

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {

	}
/**
 * testView method
 *
 * @return void
 */
	public function testView() {

	}
/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {

	}
/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {

	}
/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {

	}
}

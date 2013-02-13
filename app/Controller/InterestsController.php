<?php

/**
 * Interests Controller
 *
 * @property Interest $Interest
 */
class InterestsController extends AppController
{
	/**
	 * Load helpers
	 * 
	 * @var array
	 */
	public $helpers = array('Js', 'Html', 'Form');

	/**
	 * Load Models
	 * 
	 * @var array
	 */
	public $uses = array('Interest');

	/**
	 * index method
	 * 
	 * This sets all the variables to display the index page of 'interests'.
	 * 
	 * @return void
	 */
	public function index()
	{
		// Get user information.
		$user = $this->Interest->User->find('first', array(
			'conditions' => array(
				'User.id' => $this->Auth->user('id')
			),
			'contain' => array(
				'Picture'
			)
		));

		// Get Area records.
		$areas = $this->Interest->findAllAreas();

		// Get Interests records of user
		$interests = $this->Interest->findAll($this->Auth->user('id'));

		$this->set(compact('areas', 'interests', 'user'));
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function view($id = null)
	{
		
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null)
	{
		
	}

	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function delete()
	{
		$this->layout = $this->autoRender = false;
		if ($this->request->data) {
			$this->request->data['Interest']['user_id'] = $this->Auth->user('id');
			$this->Interest->deleteAll(array(
				'Interest.user_id'  => $this->Auth->user('id'),
				'Interest.mainarea' => $this->request->data['Interest']['mainarea'],
				'Interest.area_id'  => $this->request->data['Interest']['area_id']
			));
			print_r($this->request->data);
		} else {
			echo 'Nothing deleted';
		}
	}

	/**
	 * Update Interest
	 */
	public function change() 
	{
		$this->layout = $this->autoRender = false;
		if ($this->request->data) {
			$this->request->data['Interest']['user_id'] = $this->Auth->user('id');
			$this->Interest->deleteAll(array(
				'Interest.user_id'  => $this->Auth->user('id'),
				'Interest.mainarea' => $this->request->data['Interest']['mainarea'],
				'Interest.area_id'  => $this->request->data['Interest']['area_id']
			));
			$this->Interest->save($this->request->data);
		}
	}
}

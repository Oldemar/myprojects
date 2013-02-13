<?php
/**
 * WorkFixture
 *
 */
class WorkFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'specialty_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'workplace_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'start_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'end_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'profile' => array('column' => 'user_id', 'unique' => 0), 'speciality' => array('column' => 'specialty_id', 'unique' => 0), 'workplace' => array('column' => 'workplace_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'specialty_id' => 1,
			'workplace_id' => 1,
			'start_date' => '2012-09-13',
			'end_date' => '2012-09-13',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2012-09-13 11:40:37',
			'modified' => '2012-09-13 11:40:37'
		),
	);
}

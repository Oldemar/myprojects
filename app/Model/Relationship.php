<?php
App::uses('AppModel', 'Model');
/**
 * Relationship Model
 *
 */
class Relationship extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Relation_A' => array(
			'className' => 'Relation',
			'foreignKey' => 'relationship1_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Relation_B' => array(
			'className' => 'Relation',
			'foreignKey' => 'relationship2_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
			)
	);
}

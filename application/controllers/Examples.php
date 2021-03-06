<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',(array)$output);
	}

	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}

	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}





	public function country_management()
	{
//		$crud->set_theme('datatables');	
		$crud = new grocery_CRUD();
		
		$crud->set_table('country');
		$crud->columns('id','name','active');
		$crud->set_subject('country');
//		$crud->display_as('field_name','field_label');
		
		$crud->field_type('active','true_false');
		$crud->required_fields('name','active');
		$output = $crud->render();
//		var_dump($output);
//		exit();
		$this->_example_output($output);
	}


	public function action_item_management()
	{
		$crud = new grocery_CRUD();
		
		$crud->set_table('action_item');
		$crud->columns
		('id','name','active','objectives','description','status','owner','due_date','revised_date','comments','short_code');
																	//('week','month','qty','target_timeline','type');	
		$crud->set_subject('action_item');
		$crud->display_as('target_timeline','Target Time Line');
		$crud->field_type('active','true_false');
		$crud->required_fields('name','active');

		$crud->set_relation('objectives','objectives','name');
		$crud->set_relation('owner','owner','short_code');
		$crud->set_relation('status','status','name');
		$crud->set_relation('type','type','name');

		$crud->unset_add_fields('week','month','qty','target_timeline','type');
		$output = $crud->render();
 
		$this->_example_output($output);
	}


	public function objective_management()
	{	
		$crud = new grocery_CRUD();
		
		$crud->set_table('objectives');
		$crud->columns
		('id','name','active','description','country','owner','due_date','comments','short_code','revised_date');	//('qty','target_timeline','type','week','month');
		$crud->set_subject('objectives');
		$crud->display_as('target_timeline','Target Time Line');		
		$crud->field_type('active','true_false');
		$crud->required_fields('name','active'); 	

//		$crud->set_relation('owner','owner','name');
		$crud->set_relation('country','country','name');
		$crud->set_relation('owner','owner','{short_code}');
		$crud->set_relation('type','type','name');
//		$crud->set_relation('owner','owner','{name} ( {id} )'); 		//	'{name} ( {id} {short_code} )'  //	'{name} -> {id} {short_code}'

		$crud->unset_add_fields('week','month','qty','target_timeline','type');
		$output = $crud->render();
		 
		$this->_example_output($output);
	}


	public function status_management()
	{
		$crud = new grocery_CRUD();
		
		$crud->set_table('status');
		$crud->columns('id','name','active');
		$crud->set_subject('status');
		$crud->field_type('active','true_false');
		$crud->required_fields('name','active');
		$output = $crud->render();

		$this->_example_output($output);
	}


	public function type_management()
	{
		$crud = new grocery_CRUD();
		
		$crud->set_table('type');
		$crud->columns('id','name','active','short_code');
		$crud->set_subject('Type');
		$crud->field_type('active','true_false');
		$crud->required_fields('name','active','short_code');
//		$crud->field_type('short_code','set',array($name));
//		$crud->callback_edit_field( string $name , mixed $callback );
		$output = $crud->render();

		$this->_example_output($output);
	}


	public function owner_management()
	{
		$crud = new grocery_CRUD();
		
		$crud->set_table('owner');
		$crud->columns('id','name','active','short_code');
		$crud->set_subject('owner');

//		$crud->callback_edit_field( string $name , mixed $callback );
//		$crud->callback_edit_field('phone', function ($value, $primary_key) {
//		return '+30 <input type="text" maxlength="50" value="'.$value.'" name="phone" style="width:462px">';});
//		$crud->set_data($name,'name');

		$crud->field_type('active','true_false');
		$crud->required_fields('name','active','short_code');
		$output = $crud->render();

		$this->_example_output($output);
	}

}

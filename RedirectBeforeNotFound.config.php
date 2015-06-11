<?php

/**
 * Configure the Hello World module
 *
 * This type of configuration method requires ProcessWire 2.5.5 or newer.
 * For backwards compatibility with older versions of PW, you'll want to
 * instead want to look into the getModuleConfigInputfields() method, which
 * is specified with the .module file. So we are assuming you only need to
 * support PW 2.5.5 or newer here.
 *
 * For more about configuration methods, see here:
 * http://processwire.com/blog/posts/new-module-configuration-options/
 *
 *
 */

// Template::flagSystem


class RedirectBeforeNotFoundConfig extends ModuleConfig {

	protected $selected_templates;
	protected $selected_fields;

	protected function findTemplates() {
		$array = array();
		foreach ($this->templates as $template) {
			if ($template->flags == Template::flagSystem) continue;
			if ($template->getNumPages() === 0) continue;
	    	$array[$template->name] = ($template->label ? $template->label : $template->name);
		}
		$this->selected_templates = $array;
	}

	protected function findFields() {
		$array = array();
		foreach ($this->fields as $field) {
			if ($field->type != 'FieldtypePage') continue;
			if ($field->flags) continue;
	    	$array[$field->name] = $field->name;
		}
		$this->selected_fields = $array;
	}


	public function __construct() {

		// init Templates array
		$this->findTemplates();
		$this->findFields();

		$this->add(array(
			// Radio buttons: greetingType
			array(
				'name' => 'redirect_templates',
				'type' => 'asmSelect',
				'label' => $this->_('Select template'),
				'description' => $this->_('Enable redirection for selected templates'),
				'options' => $this->selected_templates,
				'columnWidth' => 50,
			),
			array(
				'name' => 'redirect_field',
				'type' => 'select',
				'label' => $this->_('Select field'),
				'description' => $this->_('Select the page field to redirect to.'),
				'options' => $this->selected_fields,
				'columnWidth' => 50,
			),
		));
	}
}

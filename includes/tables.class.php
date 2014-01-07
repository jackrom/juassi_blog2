<?php

class tables {

	var $table_prefix;
	
	//original tables
	var $users;
	var $posts;
	var $post_categories;
	var $comments;
	var $ban_list;
	var $links;
	var $link_categories;
	var $sessions;
	var $site;
	var $search;
	var $events;
	var $tables = array();

	function tables($table_prefix) {

		$this->table_prefix = strtolower($table_prefix);
		
		$this->users = $this->table_prefix . 'users';
		$this->posts = $this->table_prefix . 'posts';
		$this->posts_to_categories = $this->table_prefix . 'posts_to_categories';
		$this->comments = $this->table_prefix . 'comments';
		$this->links = $this->table_prefix . 'links';
		$this->link_categories = $this->table_prefix . 'link_categories';
		$this->sessions = $this->table_prefix . 'sessions';
		$this->site = $this->table_prefix . 'site';
		$this->events = $this->table_prefix . 'events';
		$this->categories = $this->table_prefix . 'categories';
		$this->file_permissions = $this->table_prefix . 'file_permissions';
		$this->groups = $this->table_prefix . 'groups';
		$this->files_to_groups = $this->table_prefix . 'files_to_groups';
		$this->task_permissions = $this->table_prefix . 'task_permissions';
		$this->tasks_to_groups = $this->table_prefix . 'tasks_to_groups';
		$this->soap_clients = $this->table_prefix . 'soap_clients';
		
		$this->tables = array(
			'users' => $this->table_prefix . 'users',
			'posts' =>  $this->table_prefix . 'posts',
			'posts_to_categories' =>  $this->table_prefix . 'posts_to_categories',
			'comments' => $this->table_prefix . 'comments',
			'links' => $this->table_prefix . 'links',
			'link_categories' => $this->table_prefix . 'link_categories',
			'sessions' => $this->table_prefix . 'sessions',
			'site' => $this->table_prefix . 'site',
			'events' => $this->table_prefix . 'events',
			'categories' => $this->table_prefix . 'categories',
			'file_permissions' => $this->table_prefix . 'file_permissions',
			'groups' => $this->table_prefix . 'groups',
			'files_to_groups' => $this->table_prefix . 'files_to_groups',
			'task_permissions' => $this->table_prefix . 'task_permissions',
			'tasks_to_groups' => $this->table_prefix . 'tasks_to_groups',
			'soap_clients' => $this->table_prefix . 'soap_clients'
		);
	
	}
	
	function add_table($table_name) {

		//notice the extra $ ($this->_$_table_name) 
		$this->$table_name = $this->table_prefix . $table_name;
		$this->tables += array($table_name => $this->table_prefix . $table_name);
		
	}

}

?>
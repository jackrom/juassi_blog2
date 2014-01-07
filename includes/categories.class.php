<?php
/*
	Juassi 2.0 Nested Set Tree Model
	Juan Carlos Reyes C 2012

	Modified for Juassi from "Nested Set Tree Library"  By Rolf Brugger
	http://www.edutech.ch/contribution/nstrees
*/

	class juassi_categories {

		private $table_name;
		private $left_col;
		private $right_col;

		public function __construct($table_name, $left_col = 'lft', $right_col = 'rgt') {
			$this->table_name = $table_name;
			$this->left_col = $left_col;
			$this->right_col = $right_col;
		}


		/* ******************************************************************* */
		/* Tree Constructors */
		/* ******************************************************************* */

		public function new_root($root_name, $root_x_name = '') {
		/* creates a new root record and returns the node 'l'=1, 'r'=2. */
			$node['left'] = 1;
			$node['right'] = 2;

			$this->insert_new($node, $root_name, $root_x_name);

			return $node;

		}

		public function new_first_child($node, $child_name, $child_x_name = '') {
			/* creates a new first child of 'node'. */

			$temp_node['left'] = $node['left'] + 1;
			$temp_node['right'] = $node['left'] + 2;

			$this->shift_right_left_values($temp_node['left'], 2);
			$this->insert_new($temp_node, $child_name, $child_x_name);

			return $temp_node;

		}

		public function new_last_child($node, $child_name, $child_x_name = '') {
			/* creates a new last child of 'node'. */

			$temp_node['left'] = $node['right'];
			$temp_node['right'] = $node['right'] + 1;

			$this->shift_right_left_values($temp_node['left'], 2);
			$this->insert_new($temp_node, $child_name, $child_x_name);

			return $temp_node;
		}

		public function new_prev_sibling($node, $sibling_name, $sibling_x_name = '') {

			$temp_node['left'] = $node['left'];
			$temp_node['right'] = $node['left'] + 1;

			$this->shift_right_left_values($temp_node['left'], 2);
			$this->insert_new($temp_node, $sibling_name, $sibling_x_name);

			return $temp_node;

		}

		public function new_next_sibling($node, $sibling_name, $sibling_x_name = '') {

			$temp_node['left'] = $node['right'] + 1;
			$temp_node['right'] = $node['right'] + 2;

			$this->shift_right_left_values($temp_node['left'], 2);
			$this->insert_new($temp_node, $sibling_name, $sibling_x_name);

			return $temp_node;

		}

		/* *** internal routines *** */

		private function insert_new($node, $root_name, $root_x_name = '') {
			/* creates a new root record and returns the node 'l'=1, 'r'=2. */
			global $juassi_db;

			if (empty($root_name)) return false;

			if (empty($root_x_name)) {
				$root_x_name = $root_name;
			}
			$root_x_name = juassi_x_title($root_x_name);
			//return_first_x_title function here
			$root_x_name = $this->return_first_x_name($root_x_name);

			$stmt = $juassi_db->prepare("INSERT INTO $this->table_name (name, x_name, $this->left_col, $this->right_col) VALUES (?, ?, ?, ?)");

			$stmt->bindParam(1, $root_name);
			$stmt->bindParam(2, $root_x_name);
			$stmt->bindParam(3, $node['left']);
			$stmt->bindParam(4, $node['right']);
			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
			return true;

		}

		private function shift_right_left_values($first, $delta) {
			/* adds '$delta' to all L and R values that are >= '$first'. '$delta' can also be negative. */
			global $juassi_db;

			//print("SHIFT: add $delta to gr-eq than $first <br/>");
			$stmt = $juassi_db->prepare("UPDATE $this->table_name SET $this->left_col = $this->left_col + ? WHERE $this->left_col >= ?");

			$stmt->bindParam(1, $delta);
			$stmt->bindParam(2, $first);

			$stmt->execute();

			$stmt = $juassi_db->prepare("UPDATE $this->table_name SET $this->right_col = $this->right_col + ? WHERE $this->right_col >= ?");

			$stmt->bindParam(1, $delta);
			$stmt->bindParam(2, $first);

			$stmt->execute();

		}

		private function shift_right_left_range($first, $last, $delta) {
			/*
				adds '$delta' to all L and R values that are >= '$first' and <= '$last'. '$delta' can also be negative.
				returns the shifted first/last values as node array.
			*/
			global $juassi_db;

			$stmt = $juassi_db->prepare("UPDATE $this->table_name SET $this->left_col = $this->left_col + ? WHERE $this->left_col >= ? AND $this->left_col <= ?");

			$stmt->bindParam(1, $delta);
			$stmt->bindParam(2, $first);
			$stmt->bindParam(3, $last);

			$stmt->execute();

			$stmt = $juassi_db->prepare("UPDATE $this->table_name SET $this->right_col = $this->right_col + ? WHERE $this->right_col >= ? AND $this->right_col <= ?");

			$stmt->bindParam(1, $delta);
			$stmt->bindParam(2, $first);
			$stmt->bindParam(3, $last);

			$stmt->execute();


			return array('left'=>$first+$delta, 'right'=>$last+$delta);
		}

		/* ******************************************************************* */
		/* Tree Reorganization */
		/* ******************************************************************* */

		/* all nstMove... functions return the new position of the moved subtree. */
		public function move_to_next_sibling($src, $dst)
		/* moves the node '$src' and all its children (subtree) that it is the next sibling of '$dst'. */
		{
		  return $this->move_subtreee($src, $dst['right']+1);
		}

		public function move_to_prev_sibling($src, $dst)
		/* moves the node '$src' and all its children (subtree) that it is the prev sibling of '$dst'. */
		{
		  return $this->move_subtreee($src, $dst['left']);
		}

		public function move_to_first_child($src, $dst)
		/* moves the node '$src' and all its children (subtree) that it is the first child of '$dst'. */
		{
		  return $this->move_subtreee($src, $dst['left']+1);
		}

		function move_to_last_child($src, $dst)
		/* moves the node '$src' and all its children (subtree) that it is the last child of '$dst'. */
		{
		  return $this->move_subtreee($src, $dst['right']);
		}

		private function move_subtreee($src, $to) {
			/* '$src' is the node/subtree, '$to' is its destination l-value */

			$tree_size = $src['right'] - $src['left'] + 1;

			$this->shift_right_left_values($to, $tree_size);

			if($src['left'] >= $to) { // src was shifted too?
				$src['left'] += $tree_size;
				$src['right'] += $tree_size;
			}

			/* now there's enough room next to target to move the subtree*/
			$new_pos = $this->shift_right_left_range($src['left'], $src['right'], $to-$src['left']);

			/* correct values after source */
			$this->shift_right_left_values($src['right'] + 1, - $tree_size);

			if($src['left'] <= $to){ // dst was shifted too?
				$new_pos['left'] -= $tree_size;
				$new_pos['right'] -= $tree_size;
			}

			return $new_pos;
		}

		/* ******************************************************************* */
		/* Tree Destructors */
		/* ******************************************************************* */

		public function delete_tree() {
			/* deletes the entire tree structure including all records. */
			global $juassi_db;

			$result = $juassi_db->query("DELETE FROM $this->table_name");
		}

		public function delete($node) {
			/* deletes the node '$node' and all its children (subtree). */
			global $juassi_db;

			$leftanchor = $node['left'];

			$stmt = $juassi_db->prepare("DELETE FROM $this->table_name WHERE $this->left_col >= ? AND $this->right_col <= ?");

			$stmt->bindParam(1, $node['left']);
			$stmt->bindParam(2, $node['right']);

			$stmt->execute();

			$this->shift_right_left_values($node['right']+1, $node['left'] - $node['right'] -1);

			return $this->get_node_where("$this->left_col < $leftanchor ORDER BY $this->right_col DESC");

		}

		/* ******************************************************************* */
		/* Tree Queries */
		/*
		 * the following functions return a valid node (L and R-value),
		 * or L=0,R=0 if the result doesn't exist.
		 */
		/* ******************************************************************* */

		private function get_node_where($where_clause)
		//need to be _really_ careful with this function use get_node() where possible
		/* returns the first node that matches the '$whereclause'.
		   The WHERE-caluse can optionally contain ORDER BY or LIMIT clauses too.
		 */
		{
			global $juassi_db;
			$noderes['left'] = 0;
			$noderes['right'] = 0;
			$query = "SELECT * FROM $this->table_name WHERE " . $where_clause;
			$stmt = $juassi_db->prepare($query);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
			if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$noderes['left'] = $row[$this->left_col];
				$noderes['right'] = $row[$this->right_col];
			}

			return $noderes;
		}

		public function get_node($value, $type = '') {
			global $juassi_db;

			$noderes['left'] = 0;
			$noderes['right'] = 0;

			switch($type) {
				case 'name':
					$query = "SELECT * FROM $this->table_name WHERE name = ?";
				break;

				case 'x_name';
					$query = "SELECT * FROM $this->table_name WHERE x_name = ?";
				break;

				default:
					$query = "SELECT * FROM $this->table_name WHERE category_id = ?";
			}

			$stmt = $juassi_db->prepare($query);
			$stmt->bindParam(1, $value);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
			if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$noderes['left'] = $row[$this->left_col];
				$noderes['right'] = $row[$this->right_col];
			}

			return $noderes;

		}

		public function get_node_where_left($leftval)
		/* returns the node that matches the left value 'leftval'.
		 */
		{ return $this->get_node_where("$this->left_col = $leftval");
		}
		public function get_node_where_right($rightval)
		/* returns the node that matches the right value 'rightval'.
		 */
		{ return $this->get_node_where("$this->right_col = $rightval");
		}

		public function root()
		/* returns the first node that matches the '$whereclause' */
		{ return $this->get_node_where("$this->left_col = 1");
		}
		public function first_child($node)
		{ return $this->get_node_where ("$this->left_col = (" .$node['left']. "+1)");
		}
		public function last_child($node)
		{ return $this->get_node_where ("$this->right_col = (" .$node['right']. "-1)");
		}
		public function prev_sibling ($node)
		{ return $this->get_node_where ("$this->right_col = (".$node['left']."-1)");
		}
		public function next_sibling ($node)
		{ return $this->get_node_where ("$this->left_col = (".$node['right']."+1)");
		}
		public function ancestor($node) {

		$where =	$this->left_col ."<".($node['left'])
				   ." AND ".$this->right_col.">".($node['right'])
				   ." ORDER BY ".$this->right_col;

			return $this->get_node_where($where);
		}

		/* ******************************************************************* */
		/* Tree Functions */
		/*
		 * the following functions return a boolean value
		 */
		/* ******************************************************************* */

		public function valid_node($node)
		/* only checks, if L-value < R-value (does no db-query)*/
		{ return ($node['left'] < $node['right']);
		}
		public function has_ancestor($node)
		{ return $this->valid_node($this->ancestor($node));
		}
		public function has_prev_sibling($node)
		{ return $this->valid_node($this->prev_sibling($node));
		}
		public function has_next_sibling($node)
		{ return $this->valid_node($this->next_sibling($node));
		}
		public function has_children($node)
		{ return (($node['right']-$node['left'])>1);
		}
		public function is_root($node)
		{ return ($node['left']==1);
		}
		public function is_leaf($node)
		{ return (($node['right']-$node['left'])==1);
		}
		public function is_child($node1, $node2)
		/* returns true, if 'node1' is a direct child or in the subtree of 'node2' */
		{ return (($node1['left']>$node2['left']) and ($node1['right']<$node2['right']));
		}
		public function is_child_or_equal($node1, $node2)
		{ return (($node1['left']>=$node2['left']) and ($node1['right']<=$node2['right']));
		}
		public function equal($node1, $node2)
		{ return (($node1['left']==$node2['left']) and ($node1['right']==$node2['right']));
		}
		/* ******************************************************************* */
		/* Tree Functions */
		/*
		 * the following functions return an integer value
		 */
		/* ******************************************************************* */

		function nb_children($node) {
			return (($node['right']-$node['left']-1)/2);
		}

		function level($node)
		/* returns node level. (root level = 0)*/
		{
			global $juassi_db;

			$stmt = $juassi_db->prepare("SELECT COUNT(*) AS level FROM $this->table_name WHERE $this->left_col < ? AND $this->right_col > ?");

			$stmt->bindParam(1, $node['left']);
			$stmt->bindParam(2, $node['right']);
			$stmt->execute();

		  	if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row["level"];
			}
			else {
				return 0;
			}
		}

		/* ******************************************************************* */
		/* Tree Walks  */
		/* ******************************************************************* */

		public function walk_preorder ($node)
		/* initializes preorder walk and returns a walk handle */
		{
		global $juassi_db;

			$stmt = $juassi_db->prepare("SELECT * FROM $this->table_name WHERE $this->left_col >= ? AND $this->right_col <= ? ORDER BY $this->left_col");

			$stmt->bindParam(1, $node['left']);
			$stmt->bindParam(2, $node['right']);
			$stmt->execute();

		  	$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

		  return array('recset'=>$res,
		               'prevl'=>$node['left'], 'prevr'=>$node['right'], // needed to efficiently calculate the level
		               'level'=>-2 );
		}

			public function walk_next(&$walk_hand)
			{
				if (!is_array($walk_hand['recset'])) return false;
				if ($row = current($walk_hand['recset'])) {
					$walk_hand['level']+= $walk_hand['prevl'] - $row[$this->left_col] +2;
					// store current node
				    $walk_hand['prevl'] = $row[$this->left_col];
				    $walk_hand['prevr'] = $row[$this->right_col];
				    $walk_hand['row']   = $row;
					 next($walk_hand['recset']);
				    return array('left'=>$row[$this->left_col], 'right'=>$row[$this->right_col]);
				}
				else {
					return false;
				}

			}

			public function walk_attribute($walk_hand, $attribute)
			{
			  return $walk_hand['row'][$attribute];
			}

			public function walk_current($walk_hand)
			{
			  return array('left'=>$walk_hand['prevl'], 'right'=>$walk_hand['prevr']);
			}
			public function walk_level($walk_hand)
			{
			  return $walk_hand['level'];
			}

			/* ******************************************************************* */
		/* Printing Tools */
		/* ******************************************************************* */

		public function node_attribute ($node, $attribute)
		/* returns the attribute of the specified node */
		{
			global $juassi_db;

			$stmt = $juassi_db->prepare("SELECT * FROM $this->table_name WHERE $this->left_col = ?");

			$stmt->bindParam(1, $node['left']);
			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
			if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row[$attribute];
			}
			else {
				return false;
			}
		}

		public function print_subtree($node, $attributes) {

			$wlk = $this->walk_preorder($node);
			$return = '';
			while ($curr = $this->walk_next($wlk)) {
				// print indentation
				//$return .= (str_repeat('&nbsp;', $this->walk_level($wlk)*4));
				// print attributes
				$att = reset($attributes);
				$permalink_format = juassi_get_config('category_permalink_format');
				while($att){
					$permalink = str_replace('%x_title%', juassi_htmlentities($wlk['row']['x_name']), $permalink_format);
					$permalink = juassi_get_config('address') . $permalink;
					$return .= '<li><a href="'.$permalink.'">'.juassi_htmlentities($wlk['row'][$att]).'</a></li>';
					$att = next($attributes);
				}
				//$return .= '';
			}
			return $return;
		}
		
		public function print_tagclouds($node, $attributes) {
		
			$wlk = $this->walk_preorder($node);
			$return = '';
			while ($curr = $this->walk_next($wlk)) {
				// print indentation
				$return .= (str_repeat('&nbsp;', $this->walk_level($wlk)*4));
				// print attributes
				$att = reset($attributes);
				$permalink_format = juassi_get_config('category_permalink_format');
				while($att){
					$permalink = str_replace('%x_title%', juassi_htmlentities($wlk['row']['x_name']), $permalink_format);
					$permalink = juassi_get_config('address') . $permalink;
					$return .= '<a href="'.$permalink.'">'.juassi_htmlentities($wlk['row'][$att]).'</a>';
					$att = next($attributes);
				}
				//$return .= '';
			}
			return $return;
		}

		public function print_subtree_select($node, $attributes) {

			$wlk = $this->walk_preorder($node);
			$return = '';
			while ($curr = $this->walk_next($wlk)) {
				// print indentation
				$return .= (str_repeat('&nbsp;', $this->walk_level($wlk)*4));
				// print attributes
				$att = reset($attributes);
				while($att){
					$return .= '<input type="radio" name="category_id-'.(int)$wlk['row']['category_id'].'" value="1" />' . juassi_htmlentities($wlk['row'][$att]);

					$att = next($attributes);
				}
				$return .= '</br>';
			}
			return $return;
		}

		public function print_subtree_radio($node, $attributes) {

			$wlk = $this->walk_preorder($node);
			$return = '';
			while ($curr = $this->walk_next($wlk)) {
				// print indentation
				$return .= (str_repeat('&nbsp;', $this->walk_level($wlk)*4));
				// print attributes
				$att = reset($attributes);
				while($att){
					$return .= '<input type="radio" name="category_id" value="'.(int)$wlk['row']['category_id'].'" id="optionsRadios1" />' . juassi_htmlentities($wlk['row'][$att]);
					$att = next($attributes);
				}
				$return .= '<br />';
			}
			return $return;
		}

		public function print_subtree_selected($node, $attributes, $category_array) {

			$wlk = $this->walk_preorder($node);
			$return = '';
			while ($curr = $this->walk_next($wlk)) {
				// print indentation
				$return .= (str_repeat('&nbsp;', $this->walk_level($wlk)*4));
				// print attributes
				$att = reset($attributes);
				while($att){
					if (!in_array($wlk['row']['category_id'], $category_array)) {
						$return .= '<input type="checkbox" name="category_id-'.(int)$wlk['row']['category_id'].'" value="1" />' . juassi_htmlentities($wlk['row'][$att]);
					}
					else {
						$return .= '<input type="checkbox" name="category_id-'.(int)$wlk['row']['category_id'].'" value="1" checked="checked" />' . juassi_htmlentities($wlk['row'][$att]);
					}
					$att = next($attributes);
				}
				$return .= '<br />';
			}
			return $return;
		}

		public function subtree_array($node, $attributes) {
			return array();
		}

		public function tree_array($attributes)
		/* Prints attributes of the entire tree. */
		{
		  return $this->subtree_array($this->root(), $attributes);
		}

		public function print_tree($attributes)
		/* Prints attributes of the entire tree. */
		{
		  return $this->print_subtree($this->root(), $attributes);
		}
		
		public function print_clouds($attributes)
		/* Prints attributes of the entire tree. */
		{
			return $this->print_tagclouds($this->root(), $attributes);
		}

		public function print_tree_select($attributes)
		/* Prints attributes of the entire tree. */
		{
		  return $this->print_subtree_select($this->root(), $attributes);
		}
		public function print_tree_selected($attributes, $category_array)
		{
			return $this->print_subtree_selected($this->root(), $attributes, $category_array);
		}
		public function print_tree_radio($attributes)
		/* Prints attributes of the entire tree. */
		{
		  return $this->print_subtree_radio($this->root(), $attributes);
		}

		public function breadcrumbs_string_old($node)
		/* returns a string representing the breadcrumbs from $node to $root
		   Example: "root > a-node > another-node > current-node"

		   Contributed by Nick Luethi
		 */
		{
		  // current node
		  $ret = $this->node_attribute($node, "name");
		  // treat ancestor nodes
		  while($this->ancestor ($node) != array("left"=>0,"right"=>0)){
		    $ret = "".$this->node_attribute($this->ancestor($node), "name")." &gt; ".$ret;
		    $node = $this->ancestor($node);
		  }
		  return $ret;
		  //return "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;breadcrumb: <font size='1'>".$ret."</font>";
		}

		//Juassi Version (using juassi_htmlentities)
		public function breadcrumbs_string($node)
		/* returns a string representing the breadcrumbs from $node to $root
		Example: "root > a-node > another-node > current-node"

		Contributed by Nick Luethi
		*/
		{
			// current node
			$ret = juassi_htmlentities($this->node_attribute($node, 'name'));
			// treat ancestor nodes
			while($this->ancestor ($node) != array('left'=>0,'right'=>0)){
				$ret = juassi_htmlentities($this->node_attribute($this->ancestor($node), 'name')).' &gt; '. $ret;
				$node = $this->ancestor($node);
			}
			return $ret;
		}

		public function return_first_x_name($x_name) {
			global $juassi_db;
			static $number_count = 1;

			if ($number_count > 1) {
				$check_value = $x_name . '-' . $number_count;
			}
			else {
				$check_value = $x_name;
			}

			$stmt = $juassi_db->prepare("SELECT count(*) FROM $this->table_name WHERE x_name = ?");
			$stmt->bindParam(1, $check_value);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			if ($array = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
				$number = $array[0]['count(*)'];
			}
			else {
				$number = 0;
			}

			if ($number > 0) {
				$number_count++;
				$this->return_first_x_name($x_name);
			}
			else {
				return $x_name;
			}

			return $x_name . '-' . $number_count;

		}

		public function get_category($category_id) {
			global $juassi_db;

			$query = "SELECT * FROM $this->table_name WHERE category_id = :category_id LIMIT 1";
			$stmt = $juassi_db->prepare($query);
			$stmt->bindParam(':category_id', $category_id);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
			$array = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($array) {
				return $array;
			}
			else {
				return array();
			}
		}

		public function edit_category($category_array) {
			global $juassi_db;

			$category_id = (int) $category_array['id'];
			$category_name = $category_array['name'];
			$category_x_name = $category_array['x_name'];

			$query = "UPDATE $this->table_name SET x_name = :x_name, name = :name WHERE category_id = :category_id";

			$stmt = $juassi_db->prepare($query);
			$stmt->bindParam(':category_id', $category_id);
			$stmt->bindParam(':name', $category_name);
			$stmt->bindParam(':x_name', $category_x_name);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			return true;
		}
}

?>
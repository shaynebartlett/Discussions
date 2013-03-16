<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');



/**
* Post Table class
*/
class TableDiscussionsComment extends JTable {

	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var int
	 */
	var $parent_id = null;

	/**
	 * @var int
	 */
	var $cat_id = null;

	/**
	 * @var int
	 */
	var $context_id = null;

	/**
	 * @var int
	 */
	var $user_id = null;

	/**
	 * @var string
	 */
	var $comment = null;

	/**
	 * @var datetime
	 */
	var $created_at = null;

    /**
   	 * @var datetime
   	 */
   	var $updated_at = null;

	/**
	 * @var int
	 */
	var $published = null;

	/**
	 * @var int
	 */
	var $wfm = null;

	/**
	 * @var string
	 */
	var $params = null;



	function __construct(& $db) {
	
		parent::__construct( '#__discussions_comments', 'id', $db);
		
	}



	function bind($array, $ignore = '') {
	
		if (key_exists( 'params', $array ) && is_array( $array['params'] )) {
		
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = $registry->toString();
			
		}

		return parent::bind( $array, $ignore);
	}



	function check() {
	

		return true;
	}
	
	
}

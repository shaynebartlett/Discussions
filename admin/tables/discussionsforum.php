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
* Forum Table class
*/
class TableDiscussionsForum extends JTable {

	function __construct(& $db) {
	
		parent::__construct( '#__discussions_categories', 'id', $db);
		
	}


	function check() {
	

		return true;
	}
	
	
}

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

jimport('joomla.application.component.model');


class DiscussionsModelComment extends JModel {

	var $_id = null;

	var $_data = null;



	function __construct() {

		parent::__construct();

		$array  = JRequest::getVar( 'cid', array(0), '', 'array');
		$edit	= JRequest::getVar( 'edit', true);
		
		if($edit) {
		
			$this->setId( (int)$array[0]);
			
		}
						
	}



	function setId( $id) {
	
		$this->_id		= $id;
		
		$this->_data	= null;
		
	}



	function &getData() {
	
		if ( $this->_loadData()) {

			$user = &JFactory::getUser();

		}
		else  {
			$this->_initData();
		}

		return $this->_data;
	}



	function _loadData() {
	
		if (empty($this->_data)) {

            $query = "SELECT c.id, c.parent_id, c.cat_id, c.context_id, c.user_id, c.comment, c.published, DATE_FORMAT( created_at, '%d.%m.%Y %k:%i') AS commentdate, a.title, u.username " .
          					" FROM #__discussions_comments c, #__content a, #__users u " .
                              " WHERE c.parent_id = a.id AND c.user_id = u.id AND c.id='" . (int) $this->_id ."'";

			$this->_db->setQuery($query);
			
			$this->_data = $this->_db->loadObject();
			
			return (boolean) $this->_data;
			
		}
		
		return true;
		
	}



	function store( $data) {
	
        $row =& JTable::getInstance('discussionscomment', 'Table');

		if ( !$row->bind($data)) {
		
			$this->setError($this->_db->getErrorMsg());
			
			return false;
			
		}

		if ( !$row->id) { // new entry

			// $row->created_at  = gmdate('Y-m-d H:i:s');
					
		}
		else { // edited entry
		
			// $row->updated_at = gmdate('Y-m-d H:i:s');
			
		}

		if ( !$row->check()) {
		
			$this->setError( $this->_db->getErrorMsg());
			
			return false;
			
		}

		if ( !$row->store()) {
		
			$this->setError( $this->_db->getErrorMsg());
			
			return false;
			
		}

		return true;
	}



	function _initData() {

		if (empty($this->_data)) {
		
			$comment = new stdClass();
			
            $comment->id			= 0;
            $comment->parent_id		= 0;
            $comment->cat_id		= 0;
            $comment->context_id	= 0;
            $comment->user_id		= 0;
            $comment->comment		= "";
            $comment->published		= 0;
            $comment->wfm			= 0;
						
			$this->_data			= $comment;
			
			return (boolean) $this->_data;
			
		}
		
		return true;
		
	}



	function delete($cid = array()) {

		if (count( $cid )) {
		
			JArrayHelper::toInteger($cid);
			
			$cids = implode( ',', $cid );
			
			$query = 'DELETE FROM #__discussions_comments' . ' WHERE id IN ( '.$cids.' )';
				
			$this->_db->setQuery( $query );
			
			if(!$this->_db->query()) {
			
				$this->setError($this->_db->getErrorMsg());
				
				return false;
				
			}
			
		}

		return true;
		
	}


}

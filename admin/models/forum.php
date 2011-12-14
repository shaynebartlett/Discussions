<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');


class DiscussionsModelForum extends JModel {

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
		
			$query = 'SELECT * FROM #__discussions_categories WHERE id = '.(int) $this->_id;
					
			$this->_db->setQuery($query);
			
			$this->_data = $this->_db->loadObject();
			
			return (boolean) $this->_data;
			
		}
		
		return true;
		
	}



	function store( $data) {
	
        $row =& JTable::getInstance('discussionsforum', 'Table');

		if ( !$row->bind($data)) {
		
			$this->setError($this->_db->getErrorMsg());
			
			return false;
			
		}

		if ( !$row->id) { // new entry

			$row->created  = gmdate('Y-m-d H:i:s');
			$row->modified = gmdate('Y-m-d H:i:s');
		
			$where = 'parent_id = ' . (int) $row->parent_id ;
			
			$row->ordering = $row->getNextOrder( $where );
			
		}
		else { // edited entry
		
			$row->modified = gmdate('Y-m-d H:i:s');
			
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
		
			$forum = new stdClass();
			
			$forum->id					= 0;
			$forum->parent_id			= 0;
			$forum->name				= "";
			$forum->alias				= "";
			$forum->description			= "";
			$forum->image				= null;
			$forum->show_image      	= 0;
			$forum->published			= 0;
			$forum->counter_posts		= 0;
			$forum->counter_threads		= 0;
			$forum->last_entry_user_id	= 0;
			$forum->ordering	    	= 0;
			$forum->private				= 0;
			$forum->moderated			= 0;			

			$forum->meta_title			= "";
			$forum->meta_description	= "";
			$forum->meta_keywords		= "";

			$forum->banner_top			= "";
			$forum->banner_bottom		= "";
			
			$this->_data				= $forum;
			
			return (boolean) $this->_data;
			
		}
		
		return true;
		
	}



	function delete($cid = array()) {
	
		$result = false;

		if (count( $cid )) {
		
			JArrayHelper::toInteger($cid);
			
			$cids = implode( ',', $cid );
			
			$query = 'DELETE FROM #__discussions_categories' . ' WHERE id IN ( '.$cids.' )';
				
			$this->_db->setQuery( $query );
			
			if(!$this->_db->query()) {
			
				$this->setError($this->_db->getErrorMsg());
				
				return false;
				
			}
			
		}

		return true;
		
	}






}
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


class DiscussionsModelPost extends JModel {

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
		
			$query = 'SELECT * FROM #__discussions_messages WHERE id = '.(int) $this->_id;
					
			$this->_db->setQuery($query);
			
			$this->_data = $this->_db->loadObject();
			
			return (boolean) $this->_data;
			
		}
		
		return true;
		
	}



	function store( $data) {
	
        $row =& JTable::getInstance('discussionspost', 'Table');

		if ( !$row->bind($data)) {
		
			$this->setError($this->_db->getErrorMsg());
			
			return false;
			
		}

		if ( !$row->id) { // new entry

			$row->date  = gmdate('Y-m-d H:i:s');
					
		}
		else { // edited entry
		
			// $row->modified = gmdate('Y-m-d H:i:s');
			
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
		
			$post = new stdClass();
			
			$post->id					= 0;
			$post->parent_id			= 0;
			$post->cat_id				= 0;
			$post->thread				= 0;
			$post->user_id				= 0;
			$post->account				= "";
			$post->name					= "";
			$post->email				= "";
			$post->ip					= "";
			$post->type      			= 0;
			$post->subject				= "";
			$post->alias				= "";
			$post->message				= "";
			$post->hits					= 0;
			$post->locked				= 0;
			$post->published			= 0;
			$post->counter_replies     	= 0;
			$post->sticky				= 0;
			$post->wfm					= 0;
            $post->apikey_id		    = 0;

			$this->_data				= $post;
			
			return (boolean) $this->_data;
			
		}
		
		return true;
		
	}



	function delete($cid = array()) {
	
		// todo recalculate stats
	
		$result = false;

		if (count( $cid )) {
		
			JArrayHelper::toInteger($cid);
			
			$cids = implode( ',', $cid );
			
			$query = 'DELETE FROM #__discussions_messages' . ' WHERE id IN ( '.$cids.' )';
				
			$this->_db->setQuery( $query );
			
			if(!$this->_db->query()) {
			
				$this->setError($this->_db->getErrorMsg());
				
				return false;
				
			}
			
		}

		return true;
		
	}






}
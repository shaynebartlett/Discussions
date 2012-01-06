<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2011 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.model');

require_once(JPATH_COMPONENT.DS.'classes/user.php');



/** 
 * Messages Inbox Model
 */ 
class DiscussionsModelInbox extends JModel {

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct() {

		parent::__construct();

        $app = JFactory::getApplication();

		$config = JFactory::getConfig();

		$db =& $this->getDBO(); 


		// Get the pagination request variables
		$this->setState('limit', $app->getUserStateFromRequest('com_discussions.limit', 'limit', $config->getValue('config.list_limit'), 'int'));
		$this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));


		$_submit = JRequest::getVar('submit', '');
		$_selmsg = JRequest::getVar('selectedMessages', '');
				
				
	    if( $_submit == JText::_( 'COFI_BUTTON_DELETE' )) {
	    
	    	if( strlen( $_selmsg) > 0) {
	      
	      		$whereclause="";
	        	$tok = strtok( $_selmsg, " ");
	        	while ($tok !== false) {
	            	$whereclause .= "id='".$tok."'";
	            	$tok = strtok(" ");
	            	if( $tok !== false) {
	                	$whereclause .= " OR ";
	            	}
	        	}
	
				$sql = "DELETE FROM #__discussions_messages_inbox WHERE $whereclause";
				$db->setQuery( $sql);					
				$db->query();
	
	      	}
	      	
	    }

	    if( $_submit == JText::_( 'COFI_BUTTON_MARK_READ' )) {
	    
	    	if( strlen( $_selmsg) > 0) {
	      
	      		$whereclause="";
	        	$tok = strtok( $_selmsg, " ");
	        	while ($tok !== false) {
	            	$whereclause .= "id='".$tok."'";
	            	$tok = strtok(" ");
	            	if( $tok !== false) {
	                	$whereclause .= " OR ";
	            	}
	        	}
	
				$sql = "UPDATE #__discussions_messages_inbox SET flag_read='1' WHERE $whereclause";
				$db->setQuery( $sql);					
				$db->query();
	
	      	}
	      	
	    }


	    if( $_submit == JText::_( 'COFI_BUTTON_MARK_UNREAD' )) {
	    
	    	if( strlen( $_selmsg) > 0) {
	      
	      		$whereclause="";
	        	$tok = strtok( $_selmsg, " ");
	        	while ($tok !== false) {
	            	$whereclause .= "id='".$tok."'";
	            	$tok = strtok(" ");
	            	if( $tok !== false) {
	                	$whereclause .= " OR ";
	            	}
	        	}
	
				$sql = "UPDATE #__discussions_messages_inbox SET flag_read='0' WHERE $whereclause";
				$db->setQuery( $sql);					
				$db->query();
	
	      	}
	      	
	    }
	    	    
		
	}


	/** 
     * Gets Messages data 
     * 
     * @return array 
     */ 
     function getMessages() { 

        	$db =& $this->getDBO(); 

			// Load messages if they doesn't exist
			if (empty($this->_data)) {
				$selectQuery = $this->_buildSelectQuery();

    	        $limitstart = $this->getState('limitstart');
 	           	$limit = $this->getState('limit');
	
				$this->_data = $this->_getList( $selectQuery, $limitstart, $limit);
			}
		
        	return $this->_data;            
        
     } 


	/**
	 * Method to get the total number of messages
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal() {
		if (empty($this->_total)) {
			$countQuery = $this->_buildCountQuery();
			$this->_total = $this->_getListCount($countQuery);
		}

		return $this->_total;
	}


	/**
	 * Method to get a pagination object
	 *
	 * @access public
	 * @return integer
	 */
	function getPagination() {
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;
	}


	function _buildSelectQuery() {
     	
		$user 		=& 	JFactory::getUser();
		$_user_id 	= 	$user->id;

        $params = JComponentHelper::getParams('com_primezilla');        
		$_dateformat	= $params->get( 'dateformat', '%d.%m.%Y');
		$_timeformat	= $params->get( 'timeformat', '%H:%i');        		        	        		        		

        $db =& $this->getDBO();

		$selectQuery = "SELECT id, user_id, user_from_id,
							DATE_FORMAT( msg_date, '" . $_dateformat . "') AS msg_date, 
							DATE_FORMAT( msg_time, '" . $_timeformat . "') AS msg_time, 
							subject, message, 
							flag_read, flag_answered, flag_deleted
						FROM ".$db->nameQuote('#__discussions_messages_inbox')."
						WHERE user_id = '".$_user_id."' AND flag_deleted != '1'
						ORDER BY id DESC";

        return $selectQuery;
	}


	function _buildCountQuery() {

		$user 		=& 	JFactory::getUser();
		$_user_id 	= 	$user->id;

        $db =& $this->getDBO();

		$countQuery = "SELECT * FROM ".$db->nameQuote('#__discussions_messages_inbox')." WHERE user_id = '".$_user_id."' AND flag_deleted != '1'";
		return $countQuery;
	}


} 


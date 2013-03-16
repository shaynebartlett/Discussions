<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.model');

require_once(JPATH_COMPONENT.DS.'classes/user.php');
require_once(JPATH_COMPONENT.DS.'classes/helper.php');



/**
 * Discussions Message Model
 */
class DiscussionsModelMessage extends JModel {


	/**
	 * id
	 *
	 * @var integer
	 */
	var $_id = 0;


	/**
	 * user_id
	 *
	 * @var integer
	 */
	var $_user_id = 0;


	/**
	 * user_from_id
	 *
	 * @var integer
	 */
	var $_user_to_id = 0;


	/**
	 * receiver_userid
	 *
	 * @var Integer
	 */
	var $_receiver_userid = 0;


	/**
	 * receiver_username
	 *
	 * @var String
	 */
	var $_receiver_username = null;


	/**
	 * msg_date
	 *
	 * @var String
	 */
	var $_msg_date = null;


	/**
	 * msg_time
	 *
	 * @var String
	 */
	var $_msg_time = null;


	/**
	 * subject
	 *
	 * @var String
	 */
	var $_subject = null;


	/**
	 * message
	 *
	 * @var String
	 */
	var $_message = null;


	/**
	 * flag_read
	 *
	 * @var integer
	 */
	var $_flag_read = 0;


	/**
	 * flag_answered
	 *
	 * @var integer
	 */
	var $_flag_answered = 0;


	/**
	 * flag_deleted
	 *
	 * @var integer
	 */
	var $_flag_deleted = 0;


	/**
	 * task
	 *
	 * @var String
	 */
	var $_task = null;


	/**
	 * type
	 *
	 * @var String
	 */
	var $_type = null;




	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct() {

		parent::__construct();

        $app = JFactory::getApplication();

		$user =& JFactory::getUser();

        $redirectLink = JRoute::_( "index.php?option=com_discussions");

		if ( $user->guest) { // user is not logged in
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_NOT_LOGGED_IN' ), "notice");
		}

        $params         = JComponentHelper::getParams('com_discussions');
        $_useMessages   = $params->get( 'useMessages', 1);  // 0 no, 1 yes

        if ( $_useMessages != 1) { // messages feature is disabled
            $app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_FEATURE_NOT_ENABLED' ), "notice");
        }


     	$this->_type   				= JRequest::getString( 'type', '');
     	$this->_task   				= JRequest::getString( 'task', '');
     	$this->_id 					= JRequest::getInt( 'id', 0);
		$this->_receiver_username	= JRequest::getString( 'username', '');
		$this->_receiver_userid		= JRequest::getInt( 'userid', 0);
				
		switch ( $this->_task) {
		
			case "msg_new": {
				//$this->_headline = "New Thread";
				break;
			}
			
			case "msg_reply": {
				break;
			}
			
			case "msg_quote": {
				break;
			}

			case "msg_idelete": {
 				$this->deleteInboxMessage();
				break;
			}

			case "msg_odelete": {
 				$this->deleteOutboxMessage();
				break;
			}
						
			case "save": {     			
 				$this->sendMessage();
				break;
			}
								
			default: {
				break;
			}
					
		}		
		

	}



	/**
	 * Method to get the id of this message
	 *
	 * @access public
	 * @return Integer
	 */
	function getId() {
		
		if ( empty( $this->_id)) {
		
            $this->_id  = JRequest::getInt( 'id', 0);
                        
		}

		return $this->_id;
			
	}


	/**
	 * Method to get the user_id of this message
	 *
	 * @access public
	 * @return Integer
	 */
	function getUserId() {
		
		$_id 	= JRequest::getInt('id', '0');
       	$_type  = JRequest::getString( 'type', '');
		
		
		if ( $_id <> 0) {
		
        	$db =& $this->getDBO();

        	switch ( $_type) {
        	
        		case "outbox": { 
					$db->setQuery( "SELECT user_id FROM ".$db->quoteName( '#__discussions_messages_outbox')." WHERE id=" . $db->Quote($_id));
					break;
				}
				
				default: { // inbox
					$db->setQuery( "SELECT user_id FROM ".$db->quoteName( '#__discussions_messages_inbox')." WHERE id=" . $db->Quote($_id));
					break;
				}
			
			}
						
			$_user_id = $db->loadResult();
		
		}
		else {
			$_user_id = "";
		}		

		return $_user_id;
			
	}


	/**
	 * Method to get the user_from_id of this message
	 *
	 * @access public
	 * @return Integer
	 */
	function getUserFromId() {
		
		$_id = JRequest::getInt('id', '0');
		
		if ( $_id <> 0) {
		
        	$db =& $this->getDBO();
			$db->setQuery( "SELECT user_from_id FROM ".$db->quoteName( '#__discussions_messages_inbox')." WHERE id=" . $db->Quote($_id));
			$_user_from_id = $db->loadResult();
		
		}
		else {
			$_user_from_id = "";
		}		

		return $_user_from_id;
			
	}


	/**
	 * Method to get the user_from_id of this message
	 *
	 * @access public
	 * @return Integer
	 */
	function getUserToId() {
		
		$_id = JRequest::getInt('id', '0');
		
		if ( $_id <> 0) {
		
        	$db =& $this->getDBO();
			$db->setQuery( "SELECT user_to_id FROM ".$db->quoteName( '#__discussions_messages_outbox')." WHERE id=" . $db->Quote($_id));
			$_user_to_id = $db->loadResult();
		
		}
		else {
			$_user_to_id = "";
		}		

		return $_user_to_id;
			
	}




	/**
	 * Method to get the subject of this message
	 *
	 * @access public
	 * @return String
	 */
	function getMessageSubject() {
		
		$_id = JRequest::getInt('id', '0');
		$_type  = JRequest::getString( 'type', '');		
		
		if ( $_id <> 0) {

        	$db =& $this->getDBO();
		
	    	switch ( $_type) {
	    	
	    		case "outbox": { 
					$db->setQuery( "SELECT subject FROM ".$db->quoteName( '#__discussions_messages_outbox')." WHERE id=" . $db->Quote($_id));
					break;
				}
				
				default: { // inbox
					$db->setQuery( "SELECT subject FROM ".$db->quoteName( '#__discussions_messages_inbox')." WHERE id=" . $db->Quote($_id));
					break;
				}
			
			}
				
			$_subject = $db->loadResult();
		
		}
		else {
			$_subject = "";
		}		

		return $_subject;
			
	}


	/**
	 * Method to get the message text
	 *
	 * @access public
	 * @return String
	 */
	function getMessageText() {		
	
		$_id = JRequest::getInt('id', '0');
		$_type  = JRequest::getString( 'type', '');		

		if ( $_id <> 0) {
		
        	$db =& $this->getDBO();

	    	switch ( $_type) {
	    	
	    		case "outbox": { 
					$db->setQuery( "SELECT message FROM ".$db->quoteName( '#__discussions_messages_outbox')." WHERE id=" . $db->Quote($_id));
					break;
				}
				
				default: { // inbox
					$db->setQuery( "SELECT message FROM ".$db->quoteName( '#__discussions_messages_inbox')." WHERE id=" . $db->Quote($_id));
					break;
				}
			
			}

			$_message = $db->loadResult();
		
		}
		else {
			$_message = "";
		}		

		return $_message;
		
	}





	/**
     * save message
     *
     * @return int
     */
     function sendMessage() {

        $app = JFactory::getApplication();

		$user =& JFactory::getUser();
				
		$cHelper = new CofiHelper();

		// redirect	link
		$redirectLink = JRoute::_( "index.php?option=com_discussions&view=inbox&task=inbox");



     	$this->_dbmode = JRequest::getString( 'dbmode', '');


		$_postReceiver  	= JRequest::getString('postReceiver', '');	// username !
		$_postReceiverId 	= $cHelper->getIdByUsername( $_postReceiver);

		// check if Id exists
		if ( $_postReceiverId == 0) { // this user does not exist or is blocked
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_USER_NOT_EXISTS' ), "notice");
		}								
				
		$_postSubject   = JRequest::getString('postSubject', '');				
		
		$_postText      = JRequest::getString('postText', '', 'POST');
		$_postText 		= strip_tags($_postText);

		        
        
        // check if user is logged in - maybe session has timed out
		if ($user->guest) { 
			// if user is not logged in, kick him back into category
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_NOT_BEEN_SENT_SESSION' ), "message");
    		
		} 
        
        
                        
		// 1. check if subject >= 3 chars
		// todo make minimum subject length configurable
		if ( strlen( $_postSubject) < 3) {
			$isSubjectTooShort = true;
		}
		else {
			$isSubjectTooShort = false;
		}
                


			if ( !$isSubjectTooShort) { // check if subject and text have minimum length

				$_receiver_id = $_postReceiverId;
				$_user_from_id = $user->id;
				$_subject = $_postSubject;
				$_message = $_postText;


				// get the receiving user object
				$receivingUser 	= new CofiUser( $_postReceiverId);


        		$db =& $this->getDBO();


				// 1. put message in receiver inbox        		
        		$inbox_sql = "INSERT INTO ".$db->quoteName( '#__discussions_messages_inbox') .
            					" ( user_id, user_from_id, msg_date, msg_time, subject, message) " .
            					" VALUES ( " .
                                $db->Quote($_receiver_id) . ", " .
                                $db->Quote($_user_from_id) . ", " .
            					"CURRENT_DATE(), " . 
            					"CURRENT_TIME(), " .
            					$db->Quote( $_subject) . ", " . 
            					$db->Quote( $_message) .
            					" )";

        		$db->setQuery( $inbox_sql);
        		$inbox_result = $db->query();


				// 2. put message in sender outbox        		
        		$outbox_sql = "INSERT INTO ".$db->quoteName( '#__discussions_messages_outbox') .
            					" ( user_id, user_to_id, msg_date, msg_time, subject, message) " .
            					" VALUES ( " .
                                $db->Quote($_user_from_id) . ", " .
                                $db->Quote($_receiver_id) . ", " .
            					"CURRENT_DATE(), " . 
            					"CURRENT_TIME(), " .
            					$db->Quote( $_subject) . ", " . 
            					$db->Quote( $_message) .
            					" )";

        		$db->setQuery( $outbox_sql);
        		$outbox_result = $db->query();





			
				if ( $inbox_result) { // insert in receiver inbox went fine
				
					// send email if receiver wants notification					
					if ( $receivingUser->getMessagesEmailNotifications() == 1) {
					
						// get data of this message					
						$cHelper->sendNotificationEmailToReceiver( $_receiver_id, $_user_from_id, $_subject, $_message );
					}					
				
					$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_BEEN_SENT' ), "notice");

				}
				else {
				
					$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_NOT_BEEN_SENT_ERROR' ), "message");
					
				}
						
			}
		


		
		if ( $isSubjectTooShort) {
		
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_NOT_BEEN_SENT_SUBJECT' ), "message");
			
		}	

		$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_BEEN_SENT' ), "notice");

		
        return 0; // save OK
     }




	/**
	 * delete inbox message
	 *
	 * @return int
	 */
	 function deleteInboxMessage() {
	
        $app = JFactory::getApplication();
	
		$user =& JFactory::getUser();
			
				
		// redirect	link
		$redirectLink = JRoute::_( "index.php?option=com_discussions&view=inbox&task=inbox");
		        
	    
	    // check if user is logged in - maybe session has timed out
		if ($user->guest) { 
			// if user is not logged in, kick him back to inbox
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_NOT_BEEN_DELETED_SESSION' ), "message");
		} 
	    
	                   		
		$_id 	= JRequest::getInt('id', '0');
		
		$user_id 	= $user->id;
	
	
		$db =& $this->getDBO();
	
		$sql = "SELECT user_id FROM ".$db->quoteName('#__discussions_messages_inbox')." WHERE id=" . $db->Quote($_id);
				
	    $db->setQuery( $sql);
	    $message_user_id = $db->loadResult();
	
	
		if ( ($message_user_id == $user_id) ) { // this is the owner
	
		}
		else {
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_NOT_BEEN_DELETED_OWNER' ), "message");
		}
	
	
		$sql = "DELETE FROM " . $db->quoteName( '#__discussions_messages_inbox') . " WHERE id=" . $db->Quote($_id);
	
		$db->setQuery( $sql);
		$result = $db->query();
	
	
		if ( $result) { // delete went fine
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_BEEN_DELETED' ), "notice");
		}
		else {
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_NOT_BEEN_DELETED_ERROR' ), "message");
		}
	
	   	return 0; // delete OK
	
	}


	/**
	 * delete outbox message
	 *
	 * @return int
	 */
	 function deleteOutboxMessage() {
	
        $app = JFactory::getApplication();
	
		$user =& JFactory::getUser();
			
				
		// redirect	link
		$redirectLink = JRoute::_( "index.php?option=com_discussions&view=outbox&task=outbox");
		        
	    
	    // check if user is logged in - maybe session has timed out
		if ($user->guest) { 
			// if user is not logged in, kick him back to outbox
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_NOT_BEEN_DELETED_SESSION' ), "message");
		} 
	    
	                   		
		$_id 	= JRequest::getInt('id', '0');
		
		$user_id 	= $user->id;
	
	
		$db =& $this->getDBO();
	
		$sql = "SELECT user_id FROM ".$db->quoteName('#__discussions_messages_outbox')." WHERE id=" . $db->Quote($_id);
				
	    $db->setQuery( $sql);
	    $message_user_id = $db->loadResult();
	
	
		if ( ($message_user_id == $user_id) ) { // this is the owner
	
		}
		else {
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_NOT_BEEN_DELETED_OWNER' ), "message");
		}
	
	
		$sql = "DELETE FROM " . $db->quoteName( '#__discussions_messages_outbox') . " WHERE id=" . $db->Quote($_id);
	
		$db->setQuery( $sql);
		$result = $db->query();
	
	
		if ( $result) { // delete went fine
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_BEEN_DELETED' ), "notice");
		}
		else {
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_NOT_BEEN_DELETED_ERROR' ), "message");
		}
	
	   	return 0; // delete OK
	
	}




	/**
	 * Method to get the task
	 *
	 * @access public
	 * @return String
	 */
	function getTask() {
		return $this->_task;
	}


	/**
	 * Method to get the task
	 *
	 * @access public
	 * @return String
	 */
	function getType() {
		return $this->_type;
	}


	/**
	 * Method to get the receiver_userid of this message
	 *
	 * @access public
	 * @return Integer
	 */
	function getReceiverUserId() {
		
		return $this->_receiver_userid;
			
	}

	/**
	 * Method to get the receiver_username of this message
	 *
	 * @access public
	 * @return String
	 */
	function getReceiverUsername() {
		
		return $this->_receiver_username;
			
	}




	/**
	 * Method to get the message date
	 *
	 * @access public
	 * @return String
	 */
	function getMessageDate() {		
	
		$_id = JRequest::getInt('id', '0');
		$_type  = JRequest::getString( 'type', '');		

		if ( $_id <> 0) {

	        $params = JComponentHelper::getParams('com_discussions');
            $_dateformat	= substr( $params->get( 'dateformat', '%d.%m.%Y'), 0, 10); // max 10 chars

        	$db =& $this->getDBO();

	    	switch ( $_type) {
	    	
	    		case "outbox": { 
					$db->setQuery( "SELECT DATE_FORMAT( msg_date, '" . $_dateformat . "') AS msg_date FROM ".$db->quoteName( '#__discussions_messages_outbox')." WHERE id=" . $db->Quote($_id));
					break;
				}
				
				default: { // inbox
					$db->setQuery( "SELECT DATE_FORMAT( msg_date, '" . $_dateformat . "') AS msg_date FROM ".$db->quoteName( '#__discussions_messages_inbox')." WHERE id=" . $db->Quote($_id));
					break;
				}
			
			}

			$_date = $db->loadResult();
		
		}
		else {
			$_date = "";
		}		

		return $_date;
		
	}



	/**
	 * Method to get the message time
	 *
	 * @access public
	 * @return String
	 */
	function getMessageTime() {		
	
		$_id = JRequest::getInt('id', '0');
		$_type  = JRequest::getString( 'type', '');		

		if ( $_id <> 0) {
		
	        $params = JComponentHelper::getParams('com_discussions');
			$_timeformat	= $params->get( 'timeformat', '%H:%i');        		        	        		        		
		
        	$db =& $this->getDBO();

	    	switch ( $_type) {
	    	
	    		case "outbox": { 
					$db->setQuery( "SELECT DATE_FORMAT( msg_time, '" . $_timeformat . "') AS msg_time FROM ".$db->quoteName( '#__discussions_messages_outbox')." WHERE id=" . $db->Quote($_id));
					break;
				}
				
				default: { // inbox
					$db->setQuery( "SELECT DATE_FORMAT( msg_time, '" . $_timeformat . "') AS msg_time FROM ".$db->quoteName( '#__discussions_messages_inbox')." WHERE id=" . $db->Quote($_id));
					break;
				}
			
			}

			$_time = $db->loadResult();
		
		}
		else {
			$_time = "";
		}		

		return $_time;
		
	}



}


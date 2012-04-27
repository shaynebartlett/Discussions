<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2012 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.model');

require_once(JPATH_COMPONENT.DS.'classes/user.php');
require_once(JPATH_COMPONENT.DS.'classes/helper.php');



/**
 * Discussions Comment Model
 */
class DiscussionsModelComment extends JModel {


	/**
	 * id
	 *
	 * @var integer
	 */
	var $_id = 0;


	/**
	 * parent_id
	 *
	 * @var integer
	 */
	var $_parent_id = 0;


	/**
	 * cat_id
	 *
	 * @var integer
	 */
	var $_cat_id = 0;


	/**
	 * context_id
	 *
	 * @var Integer
	 */
	var $_context_id = 0;


	/**
	 * user_id
	 *
	 * @var Integer
	 */
	var $_user_id = 0;


	/**
	 * comment
	 *
	 * @var String
	 */
	var $_comment = null;


	/**
	 * published
	 *
	 * @var Integer
	 */
	var $_published = 0;


    /**
   	 * wfm
   	 *
   	 * @var Integer
   	 */
   	var $_wfm = 0;



	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct() {

		parent::__construct();

        $app = JFactory::getApplication();

		$user =& JFactory::getUser();

        $redirectLink = JRoute::_( "index.php");

		if ( $user->guest) { // user is not logged in
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_NOT_LOGGED_IN' ), "notice");
		}


        $this->_cat_id 		    = JRequest::getInt( 'cat_id', 0, 'POST');
        $this->_parent_id 		= JRequest::getInt( 'parent_id', 0, 'POST');
        $this->_context_id 		= JRequest::getInt( 'context_id', 0, 'POST');
        $this->_user_id 		= JRequest::getInt( 'user_id', 0, 'POST');
     	$this->_comment   		= JRequest::getString( 'comment', '', 'POST');
        $this->_published   	= JRequest::getInt( 'published', '', 'POST');
        $this->_wfm   		    = JRequest::getInt( 'wfm', '', 'POST');
     	//$this->_task   			= JRequest::getString( 'task', '', 'POST');


		switch ( $this->_task) {

			case "update": {
				// maybe later
				break;
			}

			case "submit": {
 				$this->submitComment();
				break;
			}

			default: {
                $this->submitComment();
				break;
			}

		}

	}



	/**
     * submit comment
     *
     * @return int
     */
     function submitComment() {

        $app = JFactory::getApplication();

		$user =& JFactory::getUser();

		$cHelper = new CofiHelper();

		// redirect	link
		$redirectLink = JRoute::_( "index.php");

        $this->_comment = strip_tags($this->_comment);



        // check if user is logged in - maybe session has timed out
		if ($user->guest) {
			// if user is not logged in, kick him back into category
			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_NOT_BEEN_SENT_SESSION' ), "message");

		}



		// 1. check if comment >= 5 chars
		if ( strlen( $this->_comment) < 5) {
			$isCommentTooShort = true;
		}
		else {
			$isCommentTooShort = false;
		}


			if ( !$isCommentTooShort) { // check if comment text has minimum length

        		$db =& $this->getDBO();


				// 1. save comment in discussions comments table
        		$sql = "INSERT INTO ".$db->nameQuote( '#__discussions_comments') .
            					" ( parent_id, cat_id, context_id, user_id, comment, published, wfm) " .
            					" VALUES ( " .
                                $db->Quote( $this->_parent_id) . ", " .
                                $db->Quote( $this->_cat_id) . ", " .
                                $db->Quote( $this->_context_id) . ", " .
                                $db->Quote( $user->id) . ", " .
            					$db->Quote( $this->_comment) . ", " .
                                $db->Quote( $this->_published) . ", " .
            					$db->Quote( $this->_wfm) .
            					" )";

        		$db->setQuery( $sql);
        		$result = $db->query();


				if ( $result) { // insert in discussions comments table went fine

					$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_BEEN_SENT' ), "notice");

				}
				else {

					$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_NOT_BEEN_SENT_ERROR' ), "message");

				}

			}




		if ( $isCommentTooShort) {

			$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_NOT_BEEN_SENT_SUBJECT' ), "message");

		}

		$app->redirect( $redirectLink, JText::_( 'COFI_MESSAGES_MESSAGE_HAS_BEEN_SENT' ), "notice");


        return 0; // save OK
     }






}


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
   	 * wdycf
   	 *
   	 * @var String
   	 */
   	var $_wdycf = null;

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
	 * latitude
	 *
	 * @var float
	 */
	var $_latitude = 0;

    /**
	 * longitude
	 *
	 * @var float
	 */
	var $_longitude = 0;



	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct() {

		parent::__construct();

        $app = JFactory::getApplication();

		$user =& JFactory::getUser();



        $this->_cat_id 		    = JRequest::getInt( 'cat_id', 0, 'POST');
        $this->_parent_id 		= JRequest::getInt( 'parent_id', 0, 'POST');
        $this->_context_id 		= JRequest::getInt( 'context_id', 0, 'POST');
        $this->_user_id 		= JRequest::getInt( 'user_id', 0, 'POST');
     	$this->_comment   		= JRequest::getString( 'comment', '', 'POST');
        $this->_wdycf   		= JRequest::getString( 'wdycf', '', 'POST');
        $this->_published   	= JRequest::getInt( 'published', '', 'POST');
        $this->_wfm   		    = JRequest::getInt( 'wfm', '', 'POST');

        $this->_latitude        = JRequest::getString('latitude', '');
        $this->_longitude       = JRequest::getString('longitude', '');

        //$redirectLink = JRoute::_( "index.php");
        $redirectLink = $this->_wdycf;


		if ( $user->guest) { // user is not logged in

            $app->redirect( $redirectLink, JText::_( 'COFI_NOT_LOGGED_IN' ), "notice");

		}



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
		$redirectLink = $this->_wdycf;

        $this->_comment = strip_tags($this->_comment);


        // check if user is logged in - maybe session has timed out
		if ($user->guest) {

            $app->redirect( $redirectLink, JText::_( 'COFI_NOT_LOGGED_IN' ), "message");

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
            $sql = "INSERT INTO ".$db->quoteName( '#__discussions_comments') .
                            " ( parent_id, cat_id, context_id, user_id, comment, published, wfm, latitude, longitude) " .
                            " VALUES ( " .
                            $db->Quote( $this->_parent_id) . ", " .
                            $db->Quote( $this->_cat_id) . ", " .
                            $db->Quote( $this->_context_id) . ", " .
                            $db->Quote( $user->id) . ", " .
                            $db->Quote( $this->_comment) . ", " .
                            $db->Quote( $this->_published) . ", " .
                            $db->Quote( $this->_wfm) . ", " .
                            $db->Quote( $this->_latitude) . ", " .
                            $db->Quote( $this->_longitude) .
                            " )";

            $db->setQuery( $sql);
            $result = $db->query();


            if ( $result) { // insert in discussions comments table went fine

                $_user_id = $user->id;
                $_content = $this->_parent_id; // get title
                $_comment = $this->_comment;

                // get article author id
                $_receiver_user_id = $cHelper->getAuthorIdByContentId( $_content);

                // send notification email to article author
                $cHelper->sendCommentNotificationEmail( $_receiver_user_id, $_user_id, $_comment );

                $app->redirect( $redirectLink, JText::_( 'COFI_COMMENTS_COMMENT_HAS_BEEN_SAVED' ), "notice");

            }
            else {

                $app->redirect( $redirectLink, JText::_( 'COFI_COMMENTS_COMMENT_HAS_NOT_BEEN_SAVED_ERROR' ), "message");

            }

        }


		if ( $isCommentTooShort) {

			$app->redirect( $redirectLink, JText::_( 'COFI_COMMENTS_COMMENT_TOO_SHORT' ), "message");

		}

		$app->redirect( $redirectLink, JText::_( 'COFI_COMMENTS_COMMENT_HAS_BEEN_SAVED' ), "notice");


        return 0; // save OK
     }



}


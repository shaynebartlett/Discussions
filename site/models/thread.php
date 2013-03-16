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



/**
 * Discussions Category Model
 */
class DiscussionsModelThread extends JModel {



	/**
	 * thread List array
	 *
	 * @var array
	 */
	var $_data = null;


	/**
	 * category total
	 *
	 * @var integer
	 */
	var $_total = null;


	/**
	 * category id
	 *
	 * @var integer
	 */
	var $_categoryId = 0;


	/**
	 * category name
	 *
	 * @var String
	 */
	var $_categoryName = null;


	/**
	 * category slug
	 *
	 * @var String
	 */
	var $_categorySlug = null;


	/**
	 * category description
	 *
	 * @var String
	 */
	var $_categoryDescription = null;


	/**
	 * category image
	 *
	 * @var String
	 */
	var $_categoryImage = null;


	/**
	 * forum banner top
	 *
	 * @var String
	 */
	var $_forumBannerTop = null;

	/**
	 * forum banner bottom
	 *
	 * @var String
	 */
	var $_forumBannerBottom = null;


	/**
	 * subject
	 *
	 * @var String
	 */
	var $_subject = null;


	/**
	 * thread id
	 *
	 * @var integer
	 */
	var $_thread = 0;


	/**
	 * thread id
	 *
	 * @var integer
	 */
	var $_threadId = 0;


	/**
	 * thread alias
	 *
	 * @var String
	 */
	var $_threadAlias = null;


	/**
	 * private status
	 *
	 * @var integer
	 */
	var $_privateStatus = null;


	/**
	 * exist status
	 *
	 * @var integer
	 */
	var $_existStatus = null;


	/**
	 * meta description
	 *
	 * @var String
	 */
	var $_metaDescription = null;


	/**
	 * meta keywords
	 *
	 * @var String
	 */
	var $_metaKeywords = null;



	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct() {

		parent::__construct();
		
		// get parameters
		$params = JComponentHelper::getParams('com_discussions');
		
		$_threadListLength = $params->get('threadListLength', '20');	
				
		$this->setState('limit', $_threadListLength, 'int');		
		
		$this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));
	}



	/**
     * Gets Threads data
     *
     * @return array
     */
     function getPostings() {

        $app = JFactory::getApplication();

     	if ( $this->getExistStatus() != null ) { // check if this category exists
     	
     		// 1. check if this is a private (moderator only) forum
    	 	if ( $this->getPrivateStatus() == 1 ) {
     	
     			// 2. if it is private -> check if this user is a moderator
				$user =& JFactory::getUser();
				$logUser = new CofiUser( $user->id);
     	
				if ( $logUser->isModerator() == 0) {	// user is not moderator -> kick him out of here
					$redirectLink = JRoute::_( "index.php?option=com_discussions");
					$app->redirect( $redirectLink, JText::_( 'COFI_NO_ACCESS_TO_FORUM' ), "notice");
     			}
     	
     		}


        $db =& $this->getDBO();

		// Load the postings if they doesn't exist
		if (empty($this->_data)) {
			$selectQuery = $this->_buildSelectQuery();

            $limitstart = $this->getState('limitstart');
            $limit = $this->getState('limit');

			$this->_data = $this->_getList( $selectQuery, $limitstart, $limit);
		}

        // return the post list data
        return $this->_data;
        
        }
        else { // category does not exist
			$redirectLink = JRoute::_( "index.php?option=com_discussions");
			$app->redirect( $redirectLink, JText::_( 'COFI_FORUM_NOT_EXISTS' ), "notice");
        }
        
        
     }



	/**
	 * Method to get the total number of threads in this category
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
     	$_catid  = JRequest::getInt('catid', 0);
     	$_thread = JRequest::getInt('thread', 0);

        $params = JComponentHelper::getParams('com_discussions');        
        $_dateformat	= substr( $params->get( 'dateformat', '%d.%m.%Y'), 0, 10); // max 10 chars
      	$_timeformat	= substr( $params->get( 'timeformat', '%H:%i'), 0, 10); // max 10 chars

        $db =& $this->getDBO();

		$selectQuery = "SELECT id, parent_id, cat_id, thread, user_id, type, subject, message,
                    counter_replies, DATE_FORMAT( date, '" . $_dateformat . " " . $_timeformat . "') AS date, hits, sticky, 
                    image1, image1_description, 
                    image2, image2_description,
                    image3, image3_description, 
                    image4, image4_description,
                    image5, image5_description,
                    published, apikey_id, latitude, longitude
					FROM ".$db->quoteName('#__discussions_messages')."
					WHERE cat_id=" . $db->Quote($_catid) . " AND thread=" . $db->Quote($_thread) . " AND published='1'
					ORDER BY id ASC";

        return $selectQuery;
	}



	function _buildCountQuery() {
     	$_catid  = JRequest::getInt('catid', 0);
     	$_thread = JRequest::getInt('thread', 0);

        $db =& $this->getDBO();

		$countQuery = "SELECT * FROM ".$db->quoteName('#__discussions_messages')." WHERE cat_id=" . $db->Quote($_catid) . " AND thread=" . $db->Quote($_thread) . " AND published='1'";
		return $countQuery;
	}



	/**
	 * Method to get the category id of this thread
	 *
	 * @access public
	 * @return integer
	 */
	function getCategoryId() {
     	$this->_categoryId = JRequest::getInt('catid', 0);

		return $this->_categoryId;
	}


	/**
	 * Method to get the category slug of this thread
	 *
	 * @access public
	 * @return string
	 */
	function getCategorySlug() {
     	$this->_categoryId = JRequest::getVar('catid', 0);
     	
		return $this->_categoryId;
	}



	/**
	 * Method to get the name of this category
	 *
	 * @access public
	 * @return String
	 */
	function getCategoryName() {
		if ( empty( $this->_categoryName)) {
            $_catid = JRequest::getInt('catid', 0);

            $db =& $this->getDBO();

            $categoryNameQuery = "SELECT name FROM ".$db->quoteName( '#__discussions_categories')." WHERE id=" . $db->Quote($_catid);

            $db->setQuery( $categoryNameQuery);
            $this->_categoryName = $db->loadResult();
		}
		return $this->_categoryName;
	}


	/**
	 * Method to get the description of this category
	 *
	 * @access public
	 * @return String
	 */
	function getCategoryDescription() {
		if ( empty( $this->_categoryDescription)) {
            $_catid = JRequest::getInt('catid', 0);

            $db =& $this->getDBO();

            $categoryDescriptionQuery = "SELECT description FROM ".$db->quoteName( '#__discussions_categories')." WHERE id=" . $db->Quote($_catid);

            $db->setQuery( $categoryDescriptionQuery);
            $this->_categoryDescription = $db->loadResult();
		}
		return $this->_categoryDescription;
	}


	/**
	 * Method to get the image of this category
	 *
	 * @access public
	 * @return String
	 */
	function getCategoryImage() {
		if ( empty( $this->_categoryImage)) {
            $_catid = JRequest::getInt('catid', 0);

            $db =& $this->getDBO();

            $categoryImageQuery = "SELECT image FROM ".$db->quoteName( '#__discussions_categories')." WHERE id=".$db->Quote($_catid);

            $db->setQuery( $categoryImageQuery);
            $this->_categoryImage = $db->loadResult();
		}
		return $this->_categoryImage;
	}


	/**
	 * Method to get the top banner of this forum
	 *
	 * @access public
	 * @return String
	 */
	function getForumBannerTop() {
		if ( empty( $this->_forumBannerTop)) {
            $_catid = JRequest::getInt('catid', 0);

            $db =& $this->getDBO();

            $forumBannerTopQuery = "SELECT banner_top FROM ".$db->quoteName( '#__discussions_categories')." WHERE id=" . $db->Quote($_catid);

            $db->setQuery( $forumBannerTopQuery);
            $this->_forumBannerTop = $db->loadResult();
		}
		return $this->_forumBannerTop;
	}

	/**
	 * Method to get the bottom banner of this forum
	 *
	 * @access public
	 * @return String
	 */
	function getForumBannerBottom() {
		if ( empty( $this->_forumBannerBottom)) {
            $_catid = JRequest::getInt('catid', 0);

            $db =& $this->getDBO();

            $forumBannerBottomQuery = "SELECT banner_bottom FROM ".$db->quoteName( '#__discussions_categories')." WHERE id=" . $db->Quote($_catid);

            $db->setQuery( $forumBannerBottomQuery);
            $this->_forumBannerBottom = $db->loadResult();
		}
		return $this->_forumBannerBottom;
	}





	/**
	 * Method to get the subject of this thread
	 *
	 * @access public
	 * @return String
	 */
	function getSubject() {
		if ( empty( $this->_subject)) {
            $_catid  = JRequest::getInt('catid', 0);
            $_thread = JRequest::getInt('thread', 0);

            $db =& $this->getDBO();

            $subjectQuery = "SELECT subject FROM ".$db->quoteName( '#__discussions_messages')."
                                WHERE cat_id=" . $db->Quote($_catid) . " AND thread=" . $db->Quote($_thread) . " AND parent_id='0' AND published='1' ";


            $db->setQuery( $subjectQuery);
            $this->_subject = $db->loadResult();
		}

		return $this->_subject;
	}


	/**
	 * Method to get the id of this thread
	 *
	 * @access public
	 * @return integer
	 */
	function getThread() {
		if ( empty( $this->_threadId)) {
            $this->_thread = JRequest::getInt('thread', 0);
		}

		return $this->_thread;
	}


	/**
	 * Method to get the id of this thread
	 *
	 * @access public
	 * @return integer
	 */
	function getThreadId() {
     	$this->_threadId = JRequest::getInt('thread', 0);

		return $this->_threadId;
	}



	/**
	 * Method to get the thread slug of this thread
	 *
	 * @access public
	 * @return string
	 */
	function getThreadSlug() {
     	$this->_threadId = JRequest::getVar('thread', 0);
     	
		return $this->_threadId;
	}



	/**
	 * Method to get the sticky status of this thread
	 *
	 * @access public
	 * @return integer
	 */
	function getStickyStatus() {
	
    	$_catid  = JRequest::getInt('catid', 0);
        $_thread = JRequest::getInt('thread', 0);

        $db =& $this->getDBO();

        $sql = "SELECT sticky FROM ".$db->quoteName( '#__discussions_messages')."
                                WHERE cat_id=" . $db->Quote($_catid) . " AND thread=" . $db->Quote($_thread) . " AND parent_id='0' ";


        $db->setQuery( $sql);
        $_stickyStatus = $db->loadResult();

		return $_stickyStatus;
	}


	/**
	 * Method to get the locked status of this thread
	 *
	 * @access public
	 * @return integer
	 */
	function getLockedStatus() {
	
    	$_catid  = JRequest::getInt('catid', 0);
        $_thread = JRequest::getInt('thread', 0);

        $db =& $this->getDBO();

        $sql = "SELECT locked FROM ".$db->quoteName( '#__discussions_messages')."
                                WHERE cat_id=" . $db->Quote($_catid) . " AND thread=" . $db->Quote($_thread) . " AND parent_id='0' ";


        $db->setQuery( $sql);
        $_lockedStatus = $db->loadResult();

		return $_lockedStatus;
	}



	/**
	 * Method to get the private status of this category
	 *
	 * @access public
	 * @return integer
	 */
	function getPrivateStatus() {
		if ( empty( $this->_privateStatus)) {
            $_catid = JRequest::getInt('catid', 0);

            $db =& $this->getDBO();

            $sql = "SELECT private FROM ".$db->quoteName( '#__discussions_categories')." WHERE id=" . $db->Quote($_catid);

            $db->setQuery( $sql);
            $this->_privateStatus = $db->loadResult();
		}
		return $this->_privateStatus;
	}



	/**
	 * Method to check if this category exists
	 *
	 * @access public
	 * @return integer
	 */
	function getExistStatus() {
		if ( empty( $this->_existStatus)) {
            $_catid = JRequest::getInt('catid', 0);

            $db =& $this->getDBO();

            $sql = "SELECT parent_id FROM ".$db->quoteName( '#__discussions_categories')." WHERE id=" . $db->Quote($_catid) . " AND parent_id<>'0'";

            $db->setQuery( $sql);
            $this->_existStatus = $db->loadResult();
		}
		
		return $this->_existStatus;
	}



	/**
	 * Method to get the Meta Description of this thread
	 *
	 * @access public
	 * @return String
	 */
	function getMetaDescription() {
	
		if ( empty( $this->_metaDescription)) {
		
            $_catid  = JRequest::getInt('catid', 0);
            $_thread = JRequest::getInt('thread', 0);

            $db =& $this->getDBO();

            $query = "SELECT message FROM ".$db->quoteName( '#__discussions_messages')."
                                WHERE cat_id=" . $db->Quote($_catid) . " AND thread=" . $db->Quote($_thread) . " AND parent_id='0' AND published='1' ";


            $db->setQuery( $query);
            $this->_metaDescription = $db->loadResult();
            
		}

		return $this->_metaDescription;
		
	}



	/**
	 * Method to get the Meta Keywords of this thread (take the ones from the category)
	 *
	 * @access public
	 * @return String
	 */
	function getMetaKeywords() {
	
		if ( empty( $this->_metaKeywords)) {
		
 			$_catid = JRequest::getInt('catid', 0);

            $db =& $this->getDBO();

            $query = "SELECT meta_keywords FROM " . $db->quoteName( '#__discussions_categories') . " WHERE id=" . $db->Quote($_catid);

            $db->setQuery( $query);
            $this->_metaKeywords = $db->loadResult();
            
		}

		return $this->_metaKeywords;
		
	}


    /**
   	 * Method to get the HTML Box Top
   	 *
   	 * @access public
   	 * @return String
   	 */
   	function getHtmlBoxTop() {

   		if ( empty( $this->_htmlBoxTop)) {

               $db =& $this->getDBO();

               $sql = "SELECT html_box_thread_top FROM ".$db->quoteName( '#__discussions_configuration')." WHERE id='1'";

               $db->setQuery( $sql);
               $this->_htmlBoxTop = $db->loadResult();
   		}

   		return $this->_htmlBoxTop;

   	}

    /**
   	 * Method to get the HTML Box Bottom
   	 *
   	 * @access public
   	 * @return String
   	 */
   	function getHtmlBoxBottom() {

   		if ( empty( $this->_htmlBoxBottom)) {

               $db =& $this->getDBO();

               $sql = "SELECT html_box_thread_bottom FROM ".$db->quoteName( '#__discussions_configuration')." WHERE id='1'";

               $db->setQuery( $sql);
               $this->_htmlBoxBottom = $db->loadResult();
   		}

   		return $this->_htmlBoxBottom;

   	}


    /**
   	 * Method to get the Social Media Button 1
   	 *
   	 * @access public
   	 * @return String
   	 */
   	function getSocialMediaButton1() {

   		if ( empty( $this->_socialMediaButton1)) {

               $db =& $this->getDBO();

               $sql = "SELECT social_media_button_1 FROM ".$db->quoteName( '#__discussions_configuration')." WHERE id='1'";

               $db->setQuery( $sql);
               $this->_socialMediaButton1 = $db->loadResult();
   		}

   		return $this->_socialMediaButton1;

   	}


    /**
   	 * Method to get the Social Media Button 2
   	 *
   	 * @access public
   	 * @return String
   	 */
   	function getSocialMediaButton2() {

   		if ( empty( $this->_socialMediaButton2)) {

               $db =& $this->getDBO();

               $sql = "SELECT social_media_button_2 FROM ".$db->quoteName( '#__discussions_configuration')." WHERE id='1'";

               $db->setQuery( $sql);
               $this->_socialMediaButton2 = $db->loadResult();
   		}

   		return $this->_socialMediaButton2;

   	}


    /**
   	 * Method to get the Social Media Button 3
   	 *
   	 * @access public
   	 * @return String
   	 */
   	function getSocialMediaButton3() {

   		if ( empty( $this->_socialMediaButton3)) {

               $db =& $this->getDBO();

               $sql = "SELECT social_media_button_3 FROM ".$db->quoteName( '#__discussions_configuration')." WHERE id='1'";

               $db->setQuery( $sql);
               $this->_socialMediaButton3 = $db->loadResult();
   		}

   		return $this->_socialMediaButton3;

   	}


}



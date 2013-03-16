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

include( 'components/com_discussions/includes/imagehelper.php');


/** 
 * Discussions Category Model 
 */ 
class DiscussionsModelProfile extends JModel { 
	
     
	/**
	 * task
	 *
	 * @var String
	 */
	var $_task = "";

     
	/**
	 * headline
	 *
	 * @var String
	 */
	var $_headline = null;

     
	/**
	 * Signature
	 *
	 * @var String
	 */

	var $_signature = null;
	
	
	/**
	 * Avatar
	 *
	 * @var String
	 */

	var $_avatar = null;


	/**
	 * Zipcode
	 *
	 * @var String
	 */

	var $_zipcode = null;


	/**
	 * City
	 *
	 * @var String
	 */

	var $_city = null;


	/**
	 * Country
	 *
	 * @var String
	 */

	var $_country = null;


	/**
	 * Website
	 *
	 * @var String
	 */

	var $_website = null;


	/**
	 * Twitter
	 *
	 * @var String
	 */

	var $_twitter = null;


	/**
	 * Facebook
	 *
	 * @var String
	 */

	var $_facebook = null;


	/**
	 * Flickr
	 *
	 * @var String
	 */

	var $_flickr = null;


	/**
	 * YouTube
	 *
	 * @var String
	 */

	var $_youtube = null;

    /**
     * Google+
     *
     * @var String
     */
    var $_googleplus = null;

	/**
	 * Show online Status
	 *
	 * @var Integer
	 */
	var $_show_online_status = null;


	/**
	 * Checkbox delete Avatar
	 *
	 * @var Integer
	 */
	var $_delete_avatar = null;

    /**
     * Messages Email notifications
     *
     * @var String
     */
    var $_messages_email_notifications = null;

    /**
     * Messages use signature
     *
     * @var String
     */
    var $_messages_use_signature = null;

    /**
     * Messages use signature for replies
     *
     * @var String
     */
    var $_messages_use_signature_for_replies = null;

    /**
     * Messages signature
     *
     * @var String
     */
    var $_messages_signature = null;



	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct() {
	
		global $app;

		parent::__construct();
		
		$this->_headline = JText::_( 'COFI_HEADLINE_PROFILE' );
		
		
		$user =& JFactory::getUser();

		if ( $user->guest) { // user is not logged in
			$redirectLink = JRoute::_( "index.php?option=com_discussions");
			$app->redirect( $redirectLink, JText::_( 'COFI_NOT_LOGGED_IN' ), "notice");		
		}

     	$this->_task   = JRequest::getString( 'task', '');
		$this->_userid = $user->id;
     	
     	
		$this->_signature  = JRequest::getString( 'signature', '', 'POST');				
		// $this->_signature = strip_tags( $this->_signature);
		$this->_signature = substr( strip_tags( $this->_signature), 0, 250);
		

		$this->_zipcode  = JRequest::getString( 'zipcode', '', 'POST');				
		$this->_zipcode = strip_tags( $this->_zipcode);

		$this->_city  = JRequest::getString( 'city', '', 'POST');				
		$this->_city = strip_tags( $this->_city);
     	
		$this->_country = JRequest::getString( 'country', '', 'POST');				
		$this->_country = strip_tags( $this->_country);



		$this->_website = JRequest::getString( 'website', '', 'POST');				
		$this->_website = strtolower( $this->_website);
		$this->_website = strip_tags( $this->_website);
		$this->_website = str_replace( "http://", "", $this->_website);


		$this->_twitter = JRequest::getString( 'twitter', '', 'POST');				
		$this->_twitter = strtolower( $this->_twitter);
		$this->_twitter = strip_tags( $this->_twitter);
		$this->_twitter = str_replace( "http://", "", $this->_twitter);
		// check wether it's a twitter url, if not set to ""
		if ( strpos( $this->_twitter, "twitter") === false) {
			$this->_twitter = "";
		}


		$this->_facebook = JRequest::getString( 'facebook', '', 'POST');				
		$this->_facebook = strtolower( $this->_facebook);
		$this->_facebook = strip_tags( $this->_facebook);
		$this->_facebook = str_replace( "http://", "", $this->_facebook);
		// check wether it's a facebook url, if not set to ""
		if ( strpos( $this->_facebook, "facebook") === false) {
			$this->_facebook = "";
		}


		$this->_flickr = JRequest::getString( 'flickr', '', 'POST');				
		$this->_flickr = strtolower( $this->_flickr);
		$this->_flickr = strip_tags( $this->_flickr);
		$this->_flickr = str_replace( "http://", "", $this->_flickr);
		// check wether it's a flickr url, if not set to ""
		if ( strpos( $this->_flickr, "flickr") === false) {
			$this->_flickr = "";
		}


		$this->_youtube = JRequest::getString( 'youtube', '', 'POST');				
		$this->_youtube = strtolower( $this->_youtube);
		$this->_youtube = strip_tags( $this->_youtube);
		$this->_youtube = str_replace( "http://", "", $this->_youtube);
		// check wether it's a youtube url, if not set to ""
		if ( strpos( $this->_youtube, "youtube") === false) {
			$this->_youtube = "";
		}

        $this->_googleplus = JRequest::getString( 'googleplus', '', 'POST');
        $this->_googleplus = strtolower( $this->_googleplus);
        $this->_googleplus = strip_tags( $this->_googleplus);
        $this->_googleplus = str_replace( "http://", "", $this->_googleplus);
        // check wether it's a google+ url, if not set to ""
        if ( strpos( $this->_googleplus, "plus") === false) {
            $this->_googleplus = "";
        }


        $this->_messages_email_notifications = JRequest::getString( 'messages_email_notifications', '0', 'POST');
        $this->_messages_use_signature = JRequest::getString( 'messages_use_signature', '0', 'POST');
        $this->_messages_use_signature_for_replies = JRequest::getString( 'messages_use_signature_for_replies', '0', 'POST');
        $this->_messages_signature = JRequest::getString( 'messages_signature', '', 'POST');

		$this->_show_online_status = JRequest::getString( 'show_online_status', '', 'POST');

		$this->_delete_avatar = JRequest::getInt( 'cb_avatar', 0, 'POST');

     	     	
		switch ( JRequest::getString( 'submit', '')) {
			//case "Speichern":    			
			//case "Save": {     		
			case JText::_( 'COFI_SAVE' ): {	
     			$this->saveProfile();		
				break;
			}
						
			default: {
				$this->_headline = JText::_( 'COFI_PROFILE' );
				break;
			}
						
		}
		
	}




/**
 * save profile
 *
 * @return int
 */
 function saveProfile() {

	global $app;

	$user =& JFactory::getUser();
	$logUser = new CofiUser( $user->id);
	
	$this->_headline = JText::_( 'COFI_PROFILE_SAVED' );

			
	// redirect	link
	$redirectLink = JRoute::_( "index.php?option=com_discussions&view=profile");
	        
    
    // check if user is logged in - maybe session has timed out
	if ($user->guest) { 
		// if user is not logged in, kick him back to index page
		$app->redirect( $redirectLink, JText::_( 'COFI_PROFILE_NOT_SAVED' ), "message"); 
	} 
    
                    
	$db =& $this->getDBO();
	
	
	// delete Avatar
	if ( $this->_delete_avatar == 1) {
		del_image( $this->_userid, "avatar", JPATH_BASE, $db);
	}
		
		
	// avatar upload
	if (isset( $_FILES['avatar']) and !$_FILES['avatar']['error'] ) {
    	add_image( $this->_userid, "avatar", JPATH_BASE, $db);
	}

		
	$sql = "UPDATE ".$db->quoteName( '#__discussions_users')." SET" .
					" signature = " . $db->Quote( $this->_signature) . 
					", zipcode = " . $db->Quote( $this->_zipcode) . 
					", city = " . $db->Quote( $this->_city) . 
					", country = " . $db->Quote( $this->_country) . 					
					", website = " . $db->Quote( $this->_website) .
					", twitter = " . $db->Quote( $this->_twitter) .
					", facebook = " . $db->Quote( $this->_facebook) .
					", flickr = " . $db->Quote( $this->_flickr) .
					", youtube = " . $db->Quote( $this->_youtube) .
                    ", googleplus = " . $db->Quote( $this->_googleplus) .
                    ", messages_email_notifications = " . $db->Quote( $this->_messages_email_notifications) .
                    ", messages_use_signature = " . $db->Quote( $this->_messages_use_signature) .
                    ", messages_use_signature_for_replies = " . $db->Quote( $this->_messages_use_signature_for_replies) .
                    ", messages_signature = " . $db->Quote( $this->_messages_signature) .
					", show_online_status = " . $db->Quote( $this->_show_online_status) .
					" WHERE id = " . $db->Quote($user->id);

	$db->setQuery( $sql);
	$db->query();

	$app->redirect( $redirectLink, JText::_( 'COFI_PROFILE_HAS_BEEN_SAVED' ), "notice"); 

    return 0; // save OK
 }








	/**
	 * Method to get the signature of this user
	 *
	 * @access public
	 * @return String
	 */
	function getSignature() {
		
		if (empty($this->_signature)) {
			
        	$db =& $this->getDBO();

			$sql = "SELECT signature FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);
			
            $db->setQuery( $sql);
            $this->_signature = $db->loadResult();
			
		}

		return $this->_signature;
	}



	/**
	 * Method to get the zipcode of this user
	 *
	 * @access public
	 * @return String
	 */
	function getZipcode() {
		
		if (empty($this->_zipcode)) {
			
        	$db =& $this->getDBO();

			$sql = "SELECT zipcode FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);
			
            $db->setQuery( $sql);
            $this->_zipcode = $db->loadResult();
			
		}

		return $this->_zipcode;
	}


	/**
	 * Method to get the city of this user
	 *
	 * @access public
	 * @return String
	 */
	function getCity() {
		
		if (empty($this->_city)) {
			
        	$db =& $this->getDBO();

			$sql = "SELECT city FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);
			
            $db->setQuery( $sql);
            $this->_city = $db->loadResult();
			
		}

		return $this->_city;
	}


	/**
	 * Method to get the country of this user
	 *
	 * @access public
	 * @return String
	 */
	function getCountry() {
		
		if (empty($this->_country)) {
			
        	$db =& $this->getDBO();

			$sql = "SELECT country FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);
			
            $db->setQuery( $sql);
            $this->_country = $db->loadResult();
			
		}

		return $this->_country;
	}


	/**
	 * Method to get the website of this user
	 *
	 * @access public
	 * @return String
	 */
	function getWebsite() {
		
		if (empty($this->_website)) {
			
        	$db =& $this->getDBO();

			$sql = "SELECT website FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);
			
            $db->setQuery( $sql);
            $this->_website = $db->loadResult();
			
		}

		return $this->_website;
	}


	/**
	 * Method to get the twitter url of this user
	 *
	 * @access public
	 * @return String
	 */
	function getTwitter() {
		
		if (empty($this->_twitter)) {
			
        	$db =& $this->getDBO();

			$sql = "SELECT twitter FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);
			
            $db->setQuery( $sql);
            $this->_twitter = $db->loadResult();
			
		}

		return $this->_twitter;
	}


	/**
	 * Method to get the facebook url of this user
	 *
	 * @access public
	 * @return String
	 */
	function getFacebook() {
		
		if (empty($this->_facebook)) {
			
        	$db =& $this->getDBO();

			$sql = "SELECT facebook FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);
			
            $db->setQuery( $sql);
            $this->_facebook = $db->loadResult();
			
		}

		return $this->_facebook;
	}

	
	/**
	 * Method to get the flickr url of this user
	 *
	 * @access public
	 * @return String
	 */
	function getFlickr() {
		
		if (empty($this->_flickr)) {
			
        	$db =& $this->getDBO();

			$sql = "SELECT flickr FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);
			
            $db->setQuery( $sql);
            $this->_flickr = $db->loadResult();
			
		}

		return $this->_flickr;
	}
	

	/**
	 * Method to get the youtube url of this user
	 *
	 * @access public
	 * @return String
	 */
	function getYoutube() {
		
		if (empty($this->_youtube)) {
			
        	$db =& $this->getDBO();

			$sql = "SELECT youtube FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);
			
            $db->setQuery( $sql);
            $this->_youtube = $db->loadResult();
			
		}

		return $this->_youtube;
	}


    /**
     * Method to get the googleplus url of this user
     *
     * @access public
     * @return String
     */
    function getGoogleplus() {

        if (empty($this->_googleplus)) {

            $db =& $this->getDBO();

            $sql = "SELECT googleplus FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);

            $db->setQuery( $sql);
            $this->_googleplus = $db->loadResult();

        }

        return $this->_googleplus;
    }


	/**
	 * Method to get the show_online status of this user
	 *
	 * @access public
	 * @return String 0 = no, 1 = yes
	 */
	function getShowOnlineStatus() {
		
		if (empty($this->_show_online_status)) {
			
        	$db =& $this->getDBO();

			$sql = "SELECT show_online_status FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);
			
            $db->setQuery( $sql);
            $this->_show_online_status = $db->loadResult();
			
		}

		return $this->_show_online_status;
	}




	/**
	 * Method to get the headline
	 *
	 * @access public
	 * @return String
	 */
	function getHeadline() {
		return $this->_headline;
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

               $sql = "SELECT html_box_profile_top FROM ".$db->quoteName( '#__discussions_configuration')." WHERE id='1'";

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

               $sql = "SELECT html_box_profile_bottom FROM ".$db->quoteName( '#__discussions_configuration')." WHERE id='1'";

               $db->setQuery( $sql);
               $this->_htmlBoxBottom = $db->loadResult();
   		}

   		return $this->_htmlBoxBottom;

   	}


    /**
   	 * Method to get the messages_email_notifications status of this user
   	 *
   	 * @access public
   	 * @return String 0 = no, 1 = yes
   	 */
   	function getMessagesEmailNotifications() {

   		if (empty($this->_messages_email_notifications)) {

           	$db =& $this->getDBO();

   			$sql = "SELECT messages_email_notifications FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);

               $db->setQuery( $sql);
               $this->_messages_email_notifications = $db->loadResult();

   		}

   		return $this->_messages_email_notifications;
   	}

    /**
   	 * Method to get the messages_use_signature status of this user
   	 *
   	 * @access public
   	 * @return String 0 = no, 1 = yes
   	 */
   	function getMessagesUseSignature() {

   		if (empty($this->_messages_use_signature)) {

           	$db =& $this->getDBO();

   			$sql = "SELECT messages_use_signature FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);

               $db->setQuery( $sql);
               $this->_messages_use_signature = $db->loadResult();

   		}

   		return $this->_messages_use_signature;
   	}

    /**
   	 * Method to get the messages_use_signature_for_replies status of this user
   	 *
   	 * @access public
   	 * @return String 0 = no, 1 = yes
   	 */
   	function getMessagesUseSignatureForReplies() {

   		if (empty($this->_messages_use_signature_for_replies)) {

           	$db =& $this->getDBO();

   			$sql = "SELECT messages_use_signature_for_replies FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);

               $db->setQuery( $sql);
               $this->_messages_use_signature_for_replies = $db->loadResult();

   		}

   		return $this->_messages_use_signature_for_replies;
   	}

    /**
   	 * Method to get the messages_signature of this user
   	 *
   	 * @access public
   	 * @return String Signature
   	 */
   	function getMessagesSignature() {

   		if (empty($this->_messages_signature)) {

           	$db =& $this->getDBO();

   			$sql = "SELECT messages_signature FROM ".$db->quoteName('#__discussions_users')." WHERE id=" . $db->Quote($this->_userid);

               $db->setQuery( $sql);
               $this->_messages_signature = $db->loadResult();

   		}

   		return $this->_messages_signature;
   	}



} 

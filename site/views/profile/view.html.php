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

jimport( 'joomla.application.component.view');



/**
 * Posting View
 */
class DiscussionsViewProfile extends JView {


	/**
     * Renders the view
     *
     */
    function display() {

		$document 	=& JFactory::getDocument();
		$app 		= JFactory::getApplication();
		$pathway	= &$app->getPathway();


        $headline   		=& $this->get('Headline');
        $signature			=& $this->get('Signature');
        $task       		=& $this->get('Task');
        $zipcode			=& $this->get('Zipcode');
        $city	   			=& $this->get('City');
        $country			=& $this->get('Country');
        $website			=& $this->get('Website');
        $twitter			=& $this->get('Twitter');
        $facebook			=& $this->get('Facebook');
        $flickr				=& $this->get('Flickr');
        $youtube			=& $this->get('Youtube');
        $googleplus			=& $this->get('Googleplus');
        $show_online_status	=& $this->get('ShowOnlineStatus');
        $htmlBoxTop         =& $this->get('HtmlBoxTop');
        $htmlBoxBottom      =& $this->get('HtmlBoxBottom');

        $messages_email_notifications       =& $this->get('MessagesEmailNotifications');
        $messages_use_signature             =& $this->get('MessagesUseSignature');
        $messages_use_signature_for_replies =& $this->get('MessagesUseSignatureForReplies');
        $messages_signature                 =& $this->get('MessagesSignature');


		// get parameters
		$params = &$app->getParams();

		$menus	= &JSite::getMenu();
		$menu	= $menus->getActive();

		//set breadcrumbs
		if( is_object($menu) && $menu->query['view'] != 'profile') {
			$pathway->addItem( 'Profile', '');
		}


        $this->assignRef('htmlBoxTop',	$htmlBoxTop);
        $this->assignRef('htmlBoxBottom', $htmlBoxBottom);
		$this->assignRef('headline', $headline);
        $this->assignRef('signature', $signature);
		$this->assignRef('task', $task);
        $this->assignRef('zipcode', $zipcode);
        $this->assignRef('city', $city);
        $this->assignRef('country', $country);
        $this->assignRef('website', $website);
        $this->assignRef('twitter', $twitter);
        $this->assignRef('facebook', $facebook);
        $this->assignRef('flickr', $flickr);
        $this->assignRef('youtube', $youtube);
        $this->assignRef('googleplus', $googleplus);
        $this->assignRef('show_online_status', $show_online_status);

        $this->assignRef('messages_email_notifications', $messages_email_notifications);
        $this->assignRef('messages_use_signature', $messages_use_signature);
        $this->assignRef('messages_use_signature_for_replies', $messages_use_signature_for_replies);
        $this->assignRef('messages_signature', $messages_signature);

		$this->assignRef('params',		$params);


        // display the view
        parent::display();

    }


}

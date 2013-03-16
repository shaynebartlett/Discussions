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
 * Message View
 */
class DiscussionsViewMessage extends JView {


	/**
     * Renders the view
     *
     */
    function display() {

        $app = JFactory::getApplication();

		$document =& JFactory::getDocument();

		$pathway = &$app->getPathway();


        $id                 	=& $this->get('Id');
        $user_id                =& $this->get('UserId');
        $user_from_id           =& $this->get('UserFromId');
        $user_to_id           	=& $this->get('UserToId');
        $messageSubject         =& $this->get('MessageSubject');
        $messageText            =& $this->get('MessageText');
        $task                   =& $this->get('Task');
        $type                   =& $this->get('Type');
        $receiver_username      =& $this->get('ReceiverUsername');
        $receiver_userid     	=& $this->get('ReceiverUserId');
        
        $messageDate            =& $this->get('MessageDate');
        $messageTime            =& $this->get('MessageTime');


		// get parameters
		$params = &$app->getParams();

		$menus	= &JSite::getMenu();
		$menu	= $menus->getActive();

		$document->setTitle( $params->get( 'page_title' ) );

		//set breadcrumbs
		if( is_object($menu) && $menu->query['view'] != 'message') {
			$pathway->addItem( $messageSubject, '');
		}


		$this->assignRef('id', $id);
		
		$this->assignRef('user_id', $user_id);
		$this->assignRef('user_from_id', $user_from_id);
		$this->assignRef('user_to_id', $user_to_id);
		
		$this->assignRef('messageSubject', $messageSubject);		
		$this->assignRef('messageText', $messageText);
		$this->assignRef('task', $task);
		$this->assignRef('type', $type);
		$this->assignRef('receiver_username', $receiver_username);
		$this->assignRef('receiver_userid', $receiver_userid);

		$this->assignRef('messageDate', $messageDate);
		$this->assignRef('messageTime', $messageTime);

		$this->assignRef('params',		$params);


        // display the view
        parent::display();

    }



}

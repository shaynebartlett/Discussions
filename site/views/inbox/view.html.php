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

jimport( 'joomla.application.component.view');



/** 
 * Inbox View
 */ 
class DiscussionsViewInbox extends JView {


	/** 
     * Renders the view 
     * 
     */ 
    function display() { 
				
        $app = JFactory::getApplication();

		$document =& JFactory::getDocument();
		
		$pathway	= &$app->getPathway();

				
		$messages               =& $this->get('Messages');
		$pagination             =& $this->get('Pagination');


		// get parameters
		$params = &$app->getParams();

		$menus	= &JSite::getMenu();
		$menu	= $menus->getActive();


		$document->setTitle( $params->get( 'page_title' ) );

		//set breadcrumbs
		if( is_object($menu) && $menu->query['view'] != 'inbox') {
			$pathway->addItem( 'Inbox', '');
		}


        
		$this->assignRef('messages',	$messages);
		$this->assignRef('pagination', $pagination);
                
		$this->assignRef('params',		$params);
           
                
        // display the view 
        parent::display(); 

    }


}

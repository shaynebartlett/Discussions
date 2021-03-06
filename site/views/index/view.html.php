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
jimport( 'joomla.html.parameter');


/** 
 * Index View 
 */ 
class DiscussionsViewIndex extends JView { 


	/** 
     * Renders the view 
     * 
     */ 
    function display() { 

		$document =& JFactory::getDocument();
				
		$categories =& $this->get('Categories');

        $htmlBoxTop =& $this->get('HtmlBoxTop');
        $htmlBoxBottom =& $this->get('HtmlBoxBottom');

				
		// get parameters
	    $params =& JComponentHelper::getParams('com_discussions');

		$menus	= &JSite::getMenu();
		$menu	= $menus->getActive();


		if (is_object( $menu )) {
			
			$menu_params = new JParameter( $menu->params );			
			$pageTitle = $menu_params->get( 'page_title');
			
			if (!$menu_params->get( 'page_title')) {
				$params->set( 'page_title', JText::_( 'Forums' ) );
			}
			else {
				$params->set( 'page_title', $pageTitle );				
			}
		} else {
			$params->set( 'page_title', JText::_( 'Forums' ) );
		}

				
				
		// set Meta Tags
		
		// 1. Meta Title
		if ( JText::_( 'COFI_INDEX_META_TITLE') == "") {
			$document->setTitle( $params->get( 'page_title' ) );
		}
		else { // use the meta title configured for this index page
			$document->setTitle( JText::_( 'COFI_INDEX_META_TITLE'));
		}

		// 2. Meta Description
		if ( JText::_( 'COFI_INDEX_META_DESCRIPTION') == "") {
			// $document->setDescription( "");
		}
		else { // use the meta description configured for this index page
			$document->setDescription( JText::_( 'COFI_INDEX_META_DESCRIPTION'));
		}

		// 3. Meta Keywords
		if ( JText::_( 'COFI_INDEX_META_KEYWORDS') == "") {
			// $document->setMetaData( "keywords", "");
		}
		else { // use the meta keywords configured for this index page
			$document->setMetaData( "keywords", JText::_( 'COFI_INDEX_META_KEYWORDS'));
		}				

				

        $this->assignRef('htmlBoxTop',	$htmlBoxTop);
        $this->assignRef('htmlBoxBottom', $htmlBoxBottom);

		$this->assignRef('categories',	$categories);
		$this->assignRef('params',		$params);
                
                
        // display the view 
        parent::display();

    }


}

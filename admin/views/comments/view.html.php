<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');


class DiscussionsViewComments extends JView {

	function display($tpl = null) {

		$option = "com_discussions";

		$app = JFactory::getApplication();		

		JHTML::_('behavior.tooltip');

		$user 		= & JFactory::getUser();
		$db  		= & JFactory::getDBO();

		$search 			= $app->getUserStateFromRequest( $option.'.posts.search', 'search', '', 'string');
		$search 			= $db->getEscaped( trim( JString::strtolower( $search )));
		$filter_state		= $app->getUserStateFromRequest( $option.'.posts.filter_state', 'filter_state', '*', 'word');
		$filter_order		= $app->getUserStateFromRequest( $option.'.posts.filter_order', 'filter_order', 	'ordering', 'cmd' );
		$filter_order_Dir	= $app->getUserStateFromRequest( $option.'.posts.filter_order_Dir', 'filter_order_Dir', '', 'word' );


		$rows      	= & $this->get( 'Data');
				
		$pageNav 	= & $this->get( 'Pagination' );
		
		
		$lists['search']	= $search;
		$lists['state']		= JHTML::_('grid.state', $filter_state );
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] 	= $filter_order;
		
		
		
		
		$this->assignRef('lists'      	, $lists);
		$this->assignRef('user'			, $user);
		$this->assignRef('rows'      	, $rows);
		$this->assignRef('pageNav' 		, $pageNav);

		
		JToolBarHelper::title( "Discussions - " . JText::_('COFI_COMMENTS'), "discussions.png");
				

		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();

		JToolBarHelper::divider();

		JToolBarHelper::editListX();
        JToolBarHelper::deleteList();

		JToolBarHelper::divider();

        if (JFactory::getUser()->authorise('core.admin', 'com_discussions')) {
		    JToolBarHelper::preferences('com_discussions', '600', '800');
        }
				
		JSubMenuHelper::addEntry(JText::_('COFI_DASHBOARD'), 'index.php?option=com_discussions');
		JSubMenuHelper::addEntry(JText::_('COFI_FORUMS'), 'index.php?option=com_discussions&view=forums');
		JSubMenuHelper::addEntry(JText::_('COFI_POSTS'), 'index.php?option=com_discussions&view=posts');
		JSubMenuHelper::addEntry(JText::_('COFI_USERS'), 'index.php?option=com_discussions&view=users');
        JSubMenuHelper::addEntry(JText::_('COFI_MESSAGES'), 'index.php?option=com_discussions&view=messages');
        JSubMenuHelper::addEntry(JText::_('COFI_COMMENTS'), 'index.php?option=com_discussions&view=comments', true);
        JSubMenuHelper::addEntry(JText::_('COFI_CONFIGURATION'), 'index.php?option=com_discussions&view=configuration');

		
		parent::display($tpl);
	}

}

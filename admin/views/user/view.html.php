<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');


class DiscussionsViewUser extends JView {

	function display($tpl = null) {
	
		$model = &$this->getModel();
			
		$user = & JFactory::getUser();
			
		$edit = JRequest::getVar('edit',true);
		$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );


		JToolBarHelper::title(   "Discussions - " . JText::_('COFI_USER') . ': <small><small>[ ' . $text.' ]</small></small>', "discussions.png" );		
		
		
		JToolBarHelper::save();
		
		if ( !$edit) {
			JToolBarHelper::cancel();
		} 
		else {
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}		
		
		JToolBarHelper::divider();
		
		JToolBarHelper::preferences('com_discussions', '500', '600');
		
	
		JSubMenuHelper::addEntry(JText::_('COFI_DASHBOARD'), 'index.php?option=com_discussions');
		JSubMenuHelper::addEntry(JText::_('COFI_FORUMS'), 'index.php?option=com_discussions&view=forums');
		JSubMenuHelper::addEntry(JText::_('COFI_POSTS'), 'index.php?option=com_discussions&view=posts');
		JSubMenuHelper::addEntry(JText::_('COFI_USERS'), 'index.php?option=com_discussions&view=users', true);


		$user	=& $this->get('data');

					
		$this->assignRef( 'user', $user);

		
		parent::display( $tpl);
	}

}

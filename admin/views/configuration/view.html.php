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


class DiscussionsViewConfiguration extends JView {

	function display($tpl = null) {

        JToolBarHelper::title( "Discussions - " . JText::_('COFI_CONFIGURATION'), "discussions.png");

		//JToolBarHelper::save();
        JToolBarHelper::apply();


		JToolBarHelper::divider();
		
        if (JFactory::getUser()->authorise('core.admin', 'com_discussions')) {
		    JToolBarHelper::preferences('com_discussions', '600', '800');
        }

        JSubMenuHelper::addEntry(JText::_('COFI_DASHBOARD'), 'index.php?option=com_discussions');
      	JSubMenuHelper::addEntry(JText::_('COFI_FORUMS'), 'index.php?option=com_discussions&view=forums');
      	JSubMenuHelper::addEntry(JText::_('COFI_POSTS'), 'index.php?option=com_discussions&view=posts');
      	JSubMenuHelper::addEntry(JText::_('COFI_USERS'), 'index.php?option=com_discussions&view=users');
        JSubMenuHelper::addEntry(JText::_('COFI_MESSAGES'), 'index.php?option=com_discussions&view=messages');
        JSubMenuHelper::addEntry(JText::_('COFI_COMMENTS'), 'index.php?option=com_discussions&view=comments');
        JSubMenuHelper::addEntry(JText::_('COFI_CONFIGURATION'), 'index.php?option=com_discussions&view=configuration', true);

		$configuration	=& $this->get('data');

		$this->assignRef( 'configuration', $configuration);
		
		parent::display( $tpl);
	}

}

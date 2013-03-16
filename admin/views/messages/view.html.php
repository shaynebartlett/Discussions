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


class DiscussionsViewMessages extends JView {

	function display($tpl = null) {
	
		$model = &$this->getModel();
		
        $messagesInboxQuickStats = $model->getMessagesInboxQuickStats();
      	$this->assignRef('messagesInboxQuickStats',$messagesInboxQuickStats);

      	$messagesOutboxQuickStats = $model->getMessagesOutboxQuickStats();
      	$this->assignRef('messagesOutboxQuickStats',$messagesOutboxQuickStats);

        $messagesTotalInboxCount = $model->getMessagesTotalInboxCount();
        $this->assignRef('messagesTotalInboxCount',$messagesTotalInboxCount);

        $messagesTotalOutboxCount = $model->getMessagesTotalOutboxCount();
        $this->assignRef('messagesTotalOutboxCount',$messagesTotalOutboxCount);


        JToolBarHelper::title( "Discussions - " . JText::_('COFI_MESSAGES'), "discussions.png");

        if (JFactory::getUser()->authorise('core.admin', 'com_discussions')) {
		    JToolBarHelper::preferences('com_discussions', '600', '800');
        }

		JSubMenuHelper::addEntry(JText::_('COFI_DASHBOARD'), 'index.php?option=com_discussions');
		JSubMenuHelper::addEntry(JText::_('COFI_FORUMS'), 'index.php?option=com_discussions&view=forums');
		JSubMenuHelper::addEntry(JText::_('COFI_POSTS'), 'index.php?option=com_discussions&view=posts');
		JSubMenuHelper::addEntry(JText::_('COFI_USERS'), 'index.php?option=com_discussions&view=users');
        JSubMenuHelper::addEntry(JText::_('COFI_MESSAGES'), 'index.php?option=com_discussions&view=messages', true);
        JSubMenuHelper::addEntry(JText::_('COFI_COMMENTS'), 'index.php?option=com_discussions&view=comments');
        JSubMenuHelper::addEntry(JText::_('COFI_CONFIGURATION'), 'index.php?option=com_discussions&view=configuration');


		parent::display($tpl);
	}

}

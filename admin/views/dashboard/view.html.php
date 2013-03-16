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


class DiscussionsViewDashboard extends JView {

	function display($tpl = null) {
	
		$model = &$this->getModel();
		
		$latestEntries = $model->getLatestEntries();
		$this->assignRef('latestEntries',$latestEntries);

        // $latestComments = $model->getLatestComments();
        // $this->assignRef('latestComments',$latestComments);

        $numOfEntries = $model->countEntries();
		$this->assignRef('numOfItems',$numOfItems);
		
		$numOfCategories = $model->countCategories();
		$this->assignRef('numOfCategories',$numOfCategories);
	
		$user = & JFactory::getUser();
	
		JToolBarHelper::title( "Discussions - " . JText::_('COFI_DASHBOARD'), "discussions.png");

        if (JFactory::getUser()->authorise('core.admin', 'com_discussions')) {
		    JToolBarHelper::preferences('com_discussions', '600', '800');
        }

		JSubMenuHelper::addEntry(JText::_('COFI_DASHBOARD'), 'index.php?option=com_discussions', true);
		JSubMenuHelper::addEntry(JText::_('COFI_FORUMS'), 'index.php?option=com_discussions&view=forums');
		JSubMenuHelper::addEntry(JText::_('COFI_POSTS'), 'index.php?option=com_discussions&view=posts');
		JSubMenuHelper::addEntry(JText::_('COFI_USERS'), 'index.php?option=com_discussions&view=users');
        JSubMenuHelper::addEntry(JText::_('COFI_MESSAGES'), 'index.php?option=com_discussions&view=messages');
        JSubMenuHelper::addEntry(JText::_('COFI_COMMENTS'), 'index.php?option=com_discussions&view=comments');
        JSubMenuHelper::addEntry(JText::_('COFI_CONFIGURATION'), 'index.php?option=com_discussions&view=configuration');

			
			
		require_once ( JPATH_COMPONENT.DS.'models'.DS.'posts.php');
		$postsModel = new DiscussionsModelPosts;
		$latestPosts = $postsModel->latestPosts( 10);  // get 10 latest posts		
		$this->assignRef( 'latestPosts', $latestPosts);

        require_once ( JPATH_COMPONENT.DS.'models'.DS.'comments.php');
        $commentsModel = new DiscussionsModelComments;
        $latestComments = $commentsModel->latestComments( 10);  // get 10 latest comments
        $this->assignRef( 'latestComments', $latestComments);

			
		parent::display($tpl);
	}

}

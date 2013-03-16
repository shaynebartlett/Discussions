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


class DiscussionsViewComment extends JView {

	function display($tpl = null) {
	
		$edit = JRequest::getVar('edit',true);
		$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );

		JToolBarHelper::title(   "Discussions - " . JText::_('COFI_COMMENT') . ': <small><small>[ ' . $text.' ]</small></small>', "discussions.png" );
		
		
		JToolBarHelper::save();
		
		if ( !$edit) {
			JToolBarHelper::cancel();
		} 
		else {
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}		
		
		JToolBarHelper::divider();
		
        if (JFactory::getUser()->authorise('core.admin', 'com_discussions')) {
		    JToolBarHelper::preferences('com_discussions', '600', '800');
        }
	
		$comment =& $this->get('data');

		$lists = array();
										
		$lists['published'] = JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $comment->published );
		

		$this->assignRef( 'lists', $lists);
		$this->assignRef( 'comment', $comment);
		
		parent::display( $tpl);

	}

}

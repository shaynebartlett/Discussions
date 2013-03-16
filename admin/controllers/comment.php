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

jimport('joomla.application.component.controller');



class DiscussionsControllerComment extends JController {

    function display() {
    
		$task = JRequest::getCmd('task', 'cancel');

		switch( $this->getTask()) {
		
			case 'add' : {
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'view'  , 'comment');
				JRequest::setVar( 'edit', false );
				break;
			} 
			
			case 'edit' : {
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'view'  , 'comment');
				JRequest::setVar( 'edit', true );
				break;
			}

			case 'cancel' : {
				JRequest::setVar( 'view'  , 'comments');
				break;
			}
			
			default : {
					
				break;
			}
			
		}

        
        parent::display();
        
    }



	function save() {
	
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$post	= JRequest::get('post');
		
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		
		$post['id'] = (int) $cid[0];

		$model = $this->getModel('comment');

		if ( $model->store( $post)) {
		
			$msg = JText::_( 'COFI_COMMENT_SAVED' );
			
		} 
		else {
		
			$msg = JText::_( 'COFI_ERROR_SAVING_COMMENT' );
			
		}

		$link = 'index.php?option=com_discussions&view=comments';
		
		$this->setRedirect( $link, $msg);
		
	}



        
}

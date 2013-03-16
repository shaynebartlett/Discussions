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



class DiscussionsControllerComments extends JController {


    function display() {
    
        JRequest::setVar('view', 'comments');
        
        parent::display();
        
    }
        
                
	function publish() {

		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$cid 	= JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if ( !is_array( $cid ) || count( $cid ) < 1) {
		
			$msg = '';
			
			JError::raiseWarning(500, JText::_( 'SELECT ITEM PUBLISH' ) );
			
		} 
		else {

			$model = $this->getModel( 'comments');

			if( !$model->publish( $cid, 1)) {
				JError::raiseError( 500, $model->getError());
			}

			$msg 	= JText::_( 'COFI_COMMENT_PUBLISHED');
		
			$cache = &JFactory::getCache('com_discussions');
			$cache->clean();
			
		}

		$this->setRedirect( 'index.php?option=com_discussions&view=comments', $msg );
	}
        
        
	function unpublish() {

		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$cid 	= JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if ( !is_array( $cid ) || count( $cid ) < 1) {
		
			$msg = '';
			
			JError::raiseWarning(500, JText::_( 'SELECT ITEM UNPUBLISH' ) );
			
		} 
		else {

			$model = $this->getModel( 'comments');

			if( !$model->publish( $cid, 0)) {
				JError::raiseError( 500, $model->getError());
			}

			$msg 	= JText::_( 'COFI_COMMENT_UNPUBLISHED');
		
			$cache = &JFactory::getCache('com_discussions');
			$cache->clean();
			
		}

		$this->setRedirect( 'index.php?option=com_discussions&view=comments', $msg );
	}



	function edit() {	
	
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		JRequest::setVar( 'view', 'comment' );
		
		JRequest::setVar( 'hidemainmenu', 1 );

		$model 	= $this->getModel('comment');
		
		parent::display();
		
	}



	function add() {	
	
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		JRequest::setVar( 'view', 'comment' );
		
		JRequest::setVar( 'hidemainmenu', 1 );

		$model 	= $this->getModel('comment');
		
		parent::display();
		
	}



	function remove() {

		// todo recalculate stats
		
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		
		JArrayHelper::toInteger( $cid);

		if (count( $cid ) < 1) {
		
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
			
		}

		$model = $this->getModel('comment');
		
		if( !$model->delete( $cid)) {
		
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
			
		}

		$this->setRedirect( 'index.php?option=com_discussions&view=comments' );
		
	}




        
        
}

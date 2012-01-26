<?php 
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2012 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');



class DiscussionsControllerConfiguration extends JController {

    function display() {

        parent::display();
        
    }


    function apply() {

   		JRequest::checkToken() or jexit( 'Invalid Token' );

   		$post	= JRequest::get('post', JREQUEST_ALLOWHTML);

   		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );

   		$post['id'] = (int) $cid[0];


   		$model = $this->getModel('configuration');

   		if ( $model->store( $post)) {

   			$msg = JText::_( 'COFI_CONFIGURATION_SAVED' );

   		}
   		else {

   			$msg = JText::_( 'COFI_ERROR_SAVING_CONFIGURATION' );

   		}

   		$link = 'index.php?option=com_discussions&view=configuration';

   		$this->setRedirect( $link, $msg);

   	}


}

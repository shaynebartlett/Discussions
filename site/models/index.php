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

jimport('joomla.application.component.model');

require_once(JPATH_COMPONENT.DS.'classes/user.php');



/** 
 * Discussions Index Model 
 */ 
class DiscussionsModelIndex extends JModel { 

	
     
	/**
	 * Frontpage catList array
	 *
	 * @var array
	 */
	var $_data = null;
	
	/**
	 * Number of categories at this level
	 *
	 * @var integer
	 */
	var $_total = 0;



	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct() {
		parent::__construct();
	}


	/** 
     * Gets categories data 
     * 
     * @return array 
     */ 
	function getCategories() {

		static $items;
		
		if (isset($items)) {
			return $items;
		}

        $params         = JComponentHelper::getParams('com_discussions');
        $_dateformat	= substr( $params->get( 'dateformat', '%d.%m.%Y'), 0, 10); // max 10 chars
      	$_timeformat	= substr( $params->get( 'timeformat', '%H:%i'), 0, 10); // max 10 chars

		$db =& $this->getDBO();		

		$user =& JFactory::getUser();
		$logUser = new CofiUser( $user->id);

		if ( $logUser->isModerator()) {	// show me all categories
				$query = "SELECT c.id, c.parent_id, c.name, c.alias, c.description, c.image, c.show_image, c.published, 
						c.counter_posts, c.counter_threads, 
						DATE_FORMAT( c.last_entry_date, '" . $_dateformat . " " . $_timeformat . "') AS last_entry_date, c.last_entry_user_id, u.username, u.name AS realname,
						CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as slug
						FROM ".$db->quoteName('#__discussions_categories')."c LEFT JOIN  (".$db->quoteName('#__users')." u) ON u.id=c.last_entry_user_id
						WHERE c.published='1' ORDER by c.ordering ASC";
		}
		else { // only show the public forums (privates are hidden)
				$query = "SELECT c.id, c.parent_id, c.name, c.alias, c.description, c.image, c.show_image, c.published, 
						c.counter_posts, c.counter_threads, 
						DATE_FORMAT( c.last_entry_date, '" . $_dateformat . " " . $_timeformat . "') AS last_entry_date, c.last_entry_user_id, u.username, u.name AS realname,
						CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as slug
						FROM ".$db->quoteName('#__discussions_categories')."c LEFT JOIN  (".$db->quoteName('#__users')." u) ON u.id=c.last_entry_user_id
						WHERE c.private='0' AND c.published='1' ORDER by c.ordering ASC";			
		}

		$db->setQuery( $query );
		$rows = $db->loadObjectList();

		$children = array ();

		if( count( $rows)){
		
			foreach ( $rows as $row) {

				$pt = $row->parent_id;
				
				$list = @$children[$pt] ? $children[$pt] : array ();
				
				array_push( $list, $row);
				
				$children[$pt] = $list;
				
			}

		}

        $list = cofiTreeRecurse( 0, '', array (), $children, 10, 0, 1);

		$items = $list;

		return $items;
		
	}


	/** 
     * Gets RSS entries data 
     * 
     * @return array 
     */ 
     function getRSSEntries() { 

		// get parameters
		$params = JComponentHelper::getParams('com_discussions');
		$rssSize = $params->get('rssSize', 20);
                                       
    	$db =& $this->getDBO(); 

		$selectQuery = "SELECT m.id, m.parent_id, m.cat_id, m.thread, m.user_id, m.subject, m.message,
							CASE WHEN CHAR_LENGTH(m.alias) THEN CONCAT_WS(':', m.id, m.alias) ELSE m.id END as mslug,	
							CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as cslug,
							m.date, m.published, c.name	as category		 
						FROM " . $db->quoteName('#__discussions_messages') . " m, " . $db->quoteName('#__discussions_categories') . " c " .
                            " WHERE m.parent_id=0 AND m.cat_id=c.id AND m.published=1 AND c.private=0" .
						    " ORDER BY m.date DESC";
						    						    
		$this->_data = $this->_getList( $selectQuery, '0', $rssSize);
	
    	return $this->_data;    
                
     }    


    /**
   	 * Method to get the HTML Box Top
   	 *
   	 * @access public
   	 * @return String
   	 */
   	function getHtmlBoxTop() {

   		if ( empty( $this->_htmlBoxTop)) {

               $db =& $this->getDBO();

               $sql = "SELECT html_box_index_top FROM ".$db->quoteName( '#__discussions_configuration')." WHERE id='1'";

               $db->setQuery( $sql);
               $this->_htmlBoxTop = $db->loadResult();
   		}

   		return $this->_htmlBoxTop;

   	}

    /**
   	 * Method to get the HTML Box Bottom
   	 *
   	 * @access public
   	 * @return String
   	 */
   	function getHtmlBoxBottom() {

   		if ( empty( $this->_htmlBoxBottom)) {

               $db =& $this->getDBO();

               $sql = "SELECT html_box_index_bottom FROM ".$db->quoteName( '#__discussions_configuration')." WHERE id='1'";

               $db->setQuery( $sql);
               $this->_htmlBoxBottom = $db->loadResult();
   		}

   		return $this->_htmlBoxBottom;

   	}



} // end class



/**
 * Get recursive category array
 *
 * @return array
 */
function cofiTreeRecurse( $id, $indent, $list, &$children, $maxlevel=9999, $level=0, $type=1 ) {

    if (isset($children[$id]) && $level <= $maxlevel) {

        foreach ($children[$id] as $row) {

            $id = $row->id;
            if ( $row->parent_id == 0 ) {
                $txt = $row->name;
            } else {
                $txt = '- ' . $row->name;
            }

            $pt = $row->parent_id;
            $list[$id] = $row;
            $list[$id]->treename = $indent . $txt;
            $list[$id]->children = !empty($children[$id]) ? count( $children[$id] ) : 0;
            $list[$id]->section = ($row->parent_id==0);

            // recursive call
            $list = cofiTreeRecurse( $id, $indent . '- ', $list, $children, $maxlevel, $level+1, $type );

        }

    }

    return $list;

}


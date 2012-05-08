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

jimport('joomla.application.component.model');


class DiscussionsModelComments extends JModel {


	var $_data = null;

	var $_total = null;

	var $_pagination = null;

	var $_table = null;





	function __construct() {
	
		parent::__construct();

		$option = "com_discussions";
		
		$app 		= JFactory::getApplication();		

		$limit		= $app->getUserStateFromRequest( 'global.list.limit', 'limit', $app->getCfg('list_limit'), 'int' );

		$limitstart	= $app->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );

		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('limit', $limit);

		$this->setState('limitstart', $limitstart);

	}



	function getData() {

		if ( empty( $this->_data)) {
		
			$query = $this->_buildQuery();
			
			$this->_data = $this->_getList( $query, $this->getState('limitstart'), $this->getState('limit'));
			
		}

		return $this->_data;
	}



	function getTotal() {

		if ( empty( $this->_total)) {
		
			$sql = $this->_buildCountQuery();
			
			$db	=& JFactory::getDBO();

			$db->setQuery( $sql);

			$_counter = $db->loadResult();

			$this->_total = $_counter;

		}

		return $this->_total;
		
	}



	function getPagination() {

		if (empty($this->_pagination)) {
		
			jimport('joomla.html.pagination');
			
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
			
		}

		return $this->_pagination;
		
	}




	function _buildQuery() {

		$where		= $this->_buildContentWhere();
		
		$orderby	= $this->_buildContentOrderBy();

        $query = "SELECT c.id, c.parent_id, c.cat_id, c.context_id, c.user_id, c.comment, c.published, DATE_FORMAT( created_at, '%d.%m.%Y %k:%i') AS commentdate, a.title, u.username " .
      					" FROM #__discussions_comments c, #__content a, #__users u " . $where . $orderby;

		return $query;
		
	}

	function _buildCountQuery() {

		$where		= $this->_buildContentWhere();
				
		$query = "SELECT count(*) FROM #__discussions_comments " . $where;

		return $query;
		
	}



	function _buildContentOrderBy() {
	
		$option = "com_discussions";

		$app = JFactory::getApplication();		

		$filter_order		= $app->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'ordering',	'cmd' );
		
		$filter_order_Dir	= $app->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',	'word' );

		if ($filter_order == 'ordering'){
		
			$orderby 	= ' ORDER BY created_at DESC '.$filter_order_Dir;
			
		} 
		else {
		
			$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir.' , id ';
			
		}

		return $orderby;
		
	}



	function _buildContentWhere() {
	
		$option = "com_discussions";

		$app = JFactory::getApplication();		
		
		$db					=& JFactory::getDBO();
		
		$filter_state		= $app->getUserStateFromRequest( $option.'filter_state', 'filter_state',	'',	'word' );
		$search				= $app->getUserStateFromRequest( $option.'search', 'search', '', 'string' );
		$search				= JString::strtolower( $search );

		$where = array();

        // for getting article info
        $where[] = 'c.parent_id = a.id';

        // for getting user info
        $where[] = 'c.user_id = u.id';

		if ($search) {
			$where[] = 'LOWER(subject) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
		}
		
		if ( $filter_state ) {
		
			if ( $filter_state == 'P' ) {
			
				$where[] = 'published = 1';
				
			} else if ($filter_state == 'U' ) {
			
				$where[] = 'published = 0';
				
			}
			
		}

		$where = ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

		return $where;
		
	}



	function publish( $cid = array(), $publish = 1) {

		if (count( $cid )) {
		
			$cids = implode( ',', $cid );

			$query = 'UPDATE #__discussions_comments'
						. ' SET published = ' . (int) $publish
						. ' WHERE id IN ('. $cids .')';
				
			$this->_db->setQuery( $query );
			
			if ( !$this->_db->query()) {
			
				$this->setError( $this->_db->getErrorMsg());
				
				return false;
				
			}
			
		}
		
		return true;
		
	}



	function latestComments( $count = 10) {
	
		$db = & JFactory::getDBO();
		
		
		$query = "SELECT id, comment, published, DATE_FORMAT( created_at, \"%d.%m.%Y %k:%i\") AS commentdate FROM #__discussions_comments ORDER BY created_at DESC LIMIT " . $count;
						
		$db->setQuery($query);
		
		$rows = $db->loadObjectList();
		
				
		return $rows;
						
	}
	
	
	
}

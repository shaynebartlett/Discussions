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


class DiscussionsModelConfiguration extends JModel {

	var $_id = null;

	var $_data = null;



	function __construct() {

		parent::__construct();

	}


	function &getData() {

		if ( $this->_loadData()) {

			$user = &JFactory::getUser();

		}
		else  {
			$this->_initData();
		}

		return $this->_data;
	}



	function _loadData() {

		if (empty($this->_data)) {

			$query = 'SELECT * FROM #__discussions_configuration LIMIT 1';

			$this->_db->setQuery($query);

			$this->_data = $this->_db->loadObject();

			return (boolean) $this->_data;

		}

		return true;

	}



	function store( $data) {

        $row =& JTable::getInstance('discussionsconfiguration', 'Table');

		if ( !$row->bind($data)) {

			$this->setError($this->_db->getErrorMsg());

			return false;

		}

		if ( !$row->id) { // new entry

			$row->created  = gmdate('Y-m-d H:i:s');
			$row->modified = gmdate('Y-m-d H:i:s');

		}
		else { // edited entry

			$row->modified = gmdate('Y-m-d H:i:s');

		}

		if ( !$row->check()) {

			$this->setError( $this->_db->getErrorMsg());

			return false;

		}

		if ( !$row->store()) {

			$this->setError( $this->_db->getErrorMsg());

			return false;

		}

		return true;
	}



	function _initData() {

		if (empty($this->_data)) {

			$configuration = new stdClass();

			$configuration->id = 0;
			$configuration->socialMediaButton1	= "";
			$configuration->socialMediaButton2	= "";
			$configuration->socialMediaButton3	= "";

			$this->_data = $configuration;

			return (boolean) $this->_data;

		}

		return true;

	}



}
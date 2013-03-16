<?php

/**
 * @package		Codingfish Discussions
 * @subpackage	plg_discussions_smartsearch
 * @copyright	Copyright (C) 2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */

defined('JPATH_BASE') or die;

jimport('joomla.application.component.helper');

// Load the base adapter.
require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/adapter.php';

// jimport('joomla.log.log');



/**
 * Finder adapter for com_discussions
 *
 * @package     Joomla.Plugin
 * @subpackage  Finder.Discussions
 * @since       2.5
 */
class plgFinderDiscussions extends FinderIndexerAdapter {

	/**
	 * The plugin identifier.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $context = 'Discussions';

	/**
	 * The extension name.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $extension = 'com_discussions';

	/**
	 * The sublayout to use when rendering the results.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $layout = 'post';

	/**
	 * The type of content that the adapter indexes.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $type_title = 'Forum Post';

	/**
	 * The table name.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $table = '#__discussions_messages';


	/**
	 * The famous ItemId.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $item_id ='';



	/**
	 * Constructor
	 *
	 * @param   object  &$subject  The object to observe
	 * @param   array   $config    An array that holds the plugin configuration
	 *
	 * @since   2.5
	 */
	public function __construct(&$subject, $config) {
	
		parent::__construct($subject, $config);
		$this->loadLanguage();

        // Add the logger.
        /*
        JLog::addLogger(
            array(
                'text_file' => 'discussions_finder_plugin.log.php'
                // 'text_file_path' => '/logs'
            )
        );
        */

    }



	/**
	 * Method to setup the indexer to be run.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   2.5
	 */
	protected function setup() {
	
		// Load dependent classes
		include_once JPATH_SITE . '/components/com_discussions/classes/helper.php';

		// get Discussions Itemid	
		$db		  =& JFactory::getDBO();
		$sqlitemid = "SELECT id FROM ".$db->quoteName( '#__menu')." WHERE link LIKE '%com_discussions%' AND level = '1' AND published = '1'";
		$db->setQuery( $sqlitemid);
		$this->item_id = $db->loadResult();	

		return true;
		
	}


	/**
	 * Method to get the URL for the item.
	 *
	 * @param   integer  $id         The id of the item.
	 * @param   string   $extension  The extension the item is in.
	 * @param   string   $view       The view for the URL.
	 *
	 * @return  string  The URL of the item.
	 *
	 * @since   2.0
	 */
	protected function getURL( $id, $extension, $view) {

		return 'index.php?option=' . $extension . '&view=' . $view . '&id=' . $id;
		
	}


	/**
	 * Method to index an item. The item must be a FinderIndexerResult object.
	 *
	 * @param   FinderIndexerResult  $item    The item to index as an FinderIndexerResult object.
	 * @param   string               $format  The item format
	 *
	 * @return  void
	 *
	 * @since   2.5
	 * @throws  Exception on database error.
	 */
	protected function index(FinderIndexerResult $item, $format = 'html') {
	
		// Check if the extension is enabled
		if (JComponentHelper::isEnabled($this->extension) == false)
		{
			return;
		}

        // logging...
        // JLog::add('Finder: index');


        // Initialize the item parameters.
		$registry = new JRegistry;
		$registry->loadString($item->params);
		$item->params = JComponentHelper::getParams('com_discussions', true);
		$item->params->merge($registry);

		$registry = new JRegistry;
		$registry->loadString($item->metadata);
		$item->metadata = $registry;


		// Trigger the onContentPrepare event.
		$item->summary = FinderIndexerHelper::prepareContent($item->summary, $item->params);

		// Build the necessary route and path information.		
		//$item->url = $this->getURL( $item->cat_id, $item->thread, $item->id, $this->extension, $this->layout);
        $item->url = $this->getUrl( $item->id, $this->extension, $this->layout);
		
		// check if thread starter (OP) or reply				
		if ( $item->id == $item->thread) { // op
		
		  $item->route = 	'index.php?option=' . $this->extension . '&view=' . $this->layout . 
							'&catid=' . $item->catslug . '&thread=' . $item->slug . '&Itemid=' . $this->item_id . "#p" . $item->id;
							
		}
		else {	// reply, remove re- from slug and compute jump point to post
		
			$_slug 			= str_replace( ":re-", ":", $item->slug);
		
			$CofiHelper 	= new CofiHelper();
		
			$_jumppoint 	= $CofiHelper->getPostingJumpPointByThreadIdAndPostingId( $item->thread, $item->id);
			
			$item->route 	= 'index.php?option=' . $this->extension . '&view=' . $this->layout . 
								'&catid=' . $item->catslug . '&thread=' . $_slug . '&Itemid=' . $this->item_id . $_jumppoint;
								
		}
		
		$item->path = FinderIndexerHelper::getContentPath($item->route);

		// Add the meta-author.
		$item->metaauthor = $item->metadata->get('author');

		// Add the meta-data processing instructions.
		/*
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metakey');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metadesc');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metaauthor');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'author');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'created_by_alias');
		*/

		// Translate the state. Articles should only be published if the category is published.
		$item->state = $this->translateState($item->state, $item->cat_state);

		// Add the type taxonomy data.
		$item->addTaxonomy('Type', 'Forum Posts');
				
		// Add the category taxonomy data.
		$item->addTaxonomy('Category', $item->category, $item->cat_state, $item->cat_access);

		// Get content extras.
		FinderIndexerHelper::getContentExtras($item);

		// Index the item.
		FinderIndexer::index($item);
		
	}



	/**
	 * Method to get the SQL query used to retrieve the list of content items.
	 *
	 * @param   mixed  $sql  A JDatabaseQuery object or null.
	 *
	 * @return  JDatabaseQuery  A database object.
	 *
	 * @since   2.5
	 */
	protected function getListQuery($sql = null) {
	
		$db = JFactory::getDbo();

        // Check if we can use the supplied SQL query.
		$sql = $sql instanceof JDatabaseQuery ? $sql : $db->getQuery(true);

		$sql->select('a.id, a.thread, a.subject AS title, a.alias, a.message as summary');
		$sql->select('a.published AS state, a.cat_id, a.date AS start_date, a.user_id, 1 AS access');
		$sql->select('c.name AS category, c.alias AS cat_alias, c.published AS cat_state, 1 AS cat_access');

		// Handle the alias CASE WHEN portion of the query
		$case_when_item_alias = ' CASE WHEN ';
		$case_when_item_alias .= $sql->charLength('a.alias');
		$case_when_item_alias .= ' THEN ';
		$a_id = $sql->castAsChar('a.thread');							
		$case_when_item_alias .= $sql->concatenate(array($a_id, 'a.alias'), ':');						
		$case_when_item_alias .= ' ELSE ';
		$case_when_item_alias .= $a_id.' END as slug';
		$sql->select($case_when_item_alias);
		$case_when_category_alias = ' CASE WHEN ';
		$case_when_category_alias .= $sql->charLength('c.alias');
		$case_when_category_alias .= ' THEN ';
		$c_id = $sql->castAsChar('c.id');
		$case_when_category_alias .= $sql->concatenate(array($c_id, 'c.alias'), ':');
		$case_when_category_alias .= ' ELSE ';
		$case_when_category_alias .= $c_id.' END as catslug';
		$sql->select($case_when_category_alias);

		$sql->select('u.name AS author');
		$sql->from('#__discussions_messages AS a');
		$sql->join('LEFT', '#__discussions_categories AS c ON c.id = a.cat_id');
		$sql->join('LEFT', '#__users AS u ON u.id = a.user_id');

        $sql->where($db->quoteName('a.published') . ' = 1');
        $sql->where($db->quoteName('c.published') . ' = 1');
        $sql->where($db->quoteName('c.private') . ' = 0');

		return $sql;
		
	}



/**
	 * Method to remove the forum post that has been deleted.
	 *
	 * @param   string  $context    The context of the action being performed.
	 * @param   int     $id         The id of the post to be deleted
	 *
	 * @return  boolean  True on success.
	 *
  	 * @since   2.5
	 */
	public function onFinderAfterDelete($context, $id) {

		if ($context == 'com_discussions.post') {

            return $this->remove($id);

		}
		else {

			return true;

		}

	}

    /**
     * Method to add a forum post to the index.
     *
     * @param   string  $context    The context of the action being performed.
     *
     * @return  boolean  True on success.
     *
     * @since   2.5
     */
    public function onFinderAfterSave($context) {

    }


    protected function remove($id) {

        // Get the item's URL
        $url = $this->db->quote($this->getUrl($id, $this->extension, $this->layout));

        // Get the link id for the content item
        $query = $this->db->getQuery(true);
        $query->select($this->db->quoteName('link_id'));
        $query->from($this->db->quoteName('#__finder_links'));
        $query->where($this->db->quoteName('url') . ' = ' . $url);
        $this->db->setQuery($query);

        $item = $this->db->loadColumn();

        if ($this->db->getErrorNum()) {

            throw new Exception($this->db->getErrorMsg(), 500);

        }

        if (empty($item)) {
            return true;
        }

        FinderIndexer::remove( $item[0]);

        return true;

    }


}


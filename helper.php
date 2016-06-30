<?php
/**
 * @package        Module ETD Contact - ETD Solutions
 *
 * @version        1.0
 * @copyright      Copyright (C) 2016 ETD Solutions. Tous droits réservés.
 * @license        http://etd-solutions.com/licence
 * @author         ETD Solutions http://etd-solutions.com
 */

defined('_JEXEC') or die;

class ModContactHelper {

    public static function getContact(&$params) {
        
        $app = JFactory::getApplication();

        // Get database
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        // Changes for sqlsrv
        $case_when = ' CASE WHEN ';
        $case_when .= $query->charLength('a.alias', '!=', '0');
        $case_when .= ' THEN ';
        $a_id = $query->castAsChar('a.id');
        $case_when .= $query->concatenate([$a_id, 'a.alias'], ':');
        $case_when .= ' ELSE ';
        $case_when .= $a_id . ' END as slug';

        $case_when1 = ' CASE WHEN ';
        $case_when1 .= $query->charLength('c.alias', '!=', '0');
        $case_when1 .= ' THEN ';
        $c_id = $query->castAsChar('c.id');
        $case_when1 .= $query->concatenate([$c_id, 'c.alias'], ':');
        $case_when1 .= ' ELSE ';
        $case_when1 .= $c_id . ' END as catslug';

        $query->select('a.*' . ',' . $case_when . ',' . $case_when1)
              ->from('#__contact_details AS a')// Join on category table.
              ->select('c.title AS category_title, c.alias AS category_alias, c.access AS category_access')
              ->join('LEFT', '#__categories AS c on c.id = a.catid')// Join over the categories to get parent category titles
              ->select('parent.title as parent_title, parent.id as parent_id, parent.path as parent_route, parent.alias as parent_alias')
              ->join('LEFT', '#__categories as parent ON parent.id = c.parent_id')
              ->where('a.id = ' . (int)$params->get('id'));

        // Filter by language
        if ($app->getLanguageFilter()) {
            $query->where('language in (' . $db->quote(JFactory::getLanguage()->getTag()) . ',' . $db->quote('*') . ')');
        }

        $db->setQuery($query);
        
        $data = null;

        try {
            $data = $db->loadObject();
        } catch (RuntimeException $e) {
            $app->enqueueMessage(JText::_('JERROR_AN_ERROR_HAS_OCCURRED'), 'error');
        }

        return $data;
    }
}

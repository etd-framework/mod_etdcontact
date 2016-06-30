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

jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldContacts extends JFormFieldList {

    protected $type = 'contacts';

    /**
     * Method to get the contacts options.
     *
     * @return  array  The contacts option objects.
     *
     * @since   3.4
     */
    public function getOptions() {

        $options = array();

        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query->select('a.name AS text, a.id AS value')
              ->from($db->quoteName('#__contact_details') . ' AS a');

        $db->setQuery($query);

        $options = $db->loadObjectList();

        $options = array_merge(parent::getOptions(), $options);

        return $options;
    }

    /**
     * Method to get the field input markup for the list of contacts.
     *
     * @return  string  The field input markup.
     *
     * @since   3.4
     */
    protected function getInput() {

        $html = array();

        // Get the field options.
        $options = (array)$this->getOptions();

        // Create a regular list.
        $html[] = JHtml::_('select.genericlist', $options, $this->name, '', 'value', 'text', $this->value, $this->id);

        return implode($html);
    }
}

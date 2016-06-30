<?php
/**
 * @package		Module ETD Contact - ETD Solutions
 *
 * @version		1.0
 * @copyright	Copyright (C) 2016 ETD Solutions. Tous droits réservés.
 * @license		http://etd-solutions.com/licence
 * @author		ETD Solutions http://etd-solutions.com
 */

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$contact         = (object) ModContactHelper::getContact($params);

require JModuleHelper::getLayoutPath('mod_etdcontact', $params->get('layout', 'default'));

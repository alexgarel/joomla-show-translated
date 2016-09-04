<?php
 /**
  * Show translated : show site languages to switch language
  * but also put a special class on the language for which current content is associated
  *
  * This is a copy of the mod_language file, with call to our function
  **/

defined('_JEXEC') or die;

require_once JPATH_BASE . '/modules/mod_languages/helper.php';
require_once __DIR__ . '/helper.php';

$headerText	= $params->get('header_text');
$footerText	= $params->get('footer_text');

$list = ModLanguagesHelper::getList($params);
ModShowTranslatedHelper::markAssociated($list);

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_show_translated', $params->get('layout', 'default'));

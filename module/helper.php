<?php

defined('_JEXEC') or die;

 /**
  * Helpers for show translated
  *
  * Note that we do not re-implement what is already available in ModLanguagesHelper,
  * just to complete the information
  */
class ModShowTranslatedHelper
{
    /**
     * return list of languages that have an associated content
     **/
    public static function markAssociated(&$languages) {

		$app       = JFactory::getApplication();
		$menu      = $app->getMenu();
        $multilang = JLanguageMultilang::isEnabled();

        if (!$multilang)
        {
            // no change
            return ;
        }

        // this association loading code is copied from ModLanguagesHelper
		// Load associations
		$assoc = JLanguageAssociations::isEnabled();

		if ($assoc)
		{
			$active = $menu->getActive();

			if ($active)
			{
				$associations = MenusHelper::getAssociations($active->id);
			}

			// Load component associations
			$class = str_replace('com_', '', $app->input->get('option')) . 'HelperAssociation';
			JLoader::register($class, JPATH_COMPONENT_SITE . '/helpers/association.php');

			if (class_exists($class) && is_callable(array($class, 'getAssociations')))
			{
				$cassociations = call_user_func(array($class, 'getAssociations'));
			}
		}

        // now we mark the languages with association
        foreach ($languages as &$language)
        {
            // compute associated value
            $language->associated = (
                // this is not the active one and
                !$language->active && (
                    // there is a content association
                    isset($cassociations[$language->lang_code]) ||
                    // or a working menu association
                    isset($associations[$language->lang_code]) &&
                    $menu->getItem($associations[$language->lang_code])));
        }

    }
}

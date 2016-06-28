<?php
/**
 * @link      http://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   http://craftcms.com/license
 */

namespace craft\app\elements\actions;

use Craft;
use craft\app\base\ElementAction;
use craft\app\helpers\Json;

/**
 * NewChild represents a New Child element action.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  3.0
 */
class NewChild extends ElementAction
{
    // Properties
    // =========================================================================

    /**
     * @var string The trigger label
     */
    public $label;

    /**
     * @var integer The maximum number of levels that the structure is allowed to have
     */
    public $maxLevels;

    /**
     * @var string The URL that the user should be taken to after clicking on this element action
     */
    public $newChildUrl;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->label === null) {
            $this->label = Craft::t('app', 'New child');
        }
    }

    /**
     * @inheritdoc
     */
    public function getTriggerLabel()
    {
        return $this->label;
    }

    /**
     * @inheritdoc
     */
    public function getTriggerHtml()
    {
        $type = Json::encode(static::className());
        $maxLevels = Json::encode($this->maxLevels);
        $newChildUrl = Json::encode($this->newChildUrl);

        $js = <<<EOT
(function()
{
	var trigger = new Craft.ElementActionTrigger({
		type: {$type},
		batch: false,
		validateSelection: function(\$selectedItems)
		{
			return (!$maxLevels || $maxLevels > \$selectedItems.find('.element').data('level'));
		},
		activate: function(\$selectedItems)
		{
			Craft.redirectTo(Craft.getUrl($newChildUrl, 'parentId='+\$selectedItems.find('.element').data('id')));
		}
	});

	if (Craft.elementIndex.view.structureTableSort)
	{
		Craft.elementIndex.view.structureTableSort.on('positionChange', $.proxy(trigger, 'updateTrigger'));
	}
})();
EOT;

        Craft::$app->getView()->registerJs($js);
    }
}

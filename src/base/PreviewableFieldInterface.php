<?php
/**
 * @link      http://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   http://craftcms.com/license
 */

namespace craft\app\base;

/**
 * PreviewableFieldInterface defines the common interface to be implemented by field classes
 * that wish to be previewable on element indexes in the Control Panel.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  3.0
 */
interface PreviewableFieldInterface
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the HTML that should be shown for this field in Table View.
     *
     * @param mixed                    $value   The field’s value
     * @param ElementInterface|Element $element The element the field is associated with
     *
     * @return string|null The HTML that should be shown for this field in Table View
     */
    public function getTableAttributeHtml($value, $element);
}

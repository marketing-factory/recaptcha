<?php
namespace Evoweb\Recaptcha\Adapter;

/**
 * This file is developed by evoweb.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

class TypoScriptAdapter
{
    public function render(): string
    {
        $captcha = \Evoweb\Recaptcha\Services\CaptchaService::getInstance();

        if ($captcha !== null) {
            $output = $captcha->getReCaptcha();

            $status = $captcha->validateReCaptcha();
            if ($status == false || $status['error'] !== '') {
                $output .= '<span class="error">' .
                    \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate(
                        'error_recaptcha_' . $status['error'],
                        'Recaptcha'
                    ) .
                    '</span>';
            }
        } else {
            $output = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate(
                'error_captcha.notinstalled',
                'Recaptcha'
            );
        }

        return $output;
    }
}

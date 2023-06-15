<?php
/**
 * Verifies that control statements conform to their coding standards.
 *
 * @package DWS
 * @subpackage Sniffs
 */

namespace DWS\Sniffs\ControlStructures;

use PHP_CodeSniffer\Sniffs\AbstractPatternSniff;

/**
 * Verifies that control statements conform to their coding standards.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class ControlSignatureSniff extends AbstractPatternSniff
{
    /**
     * Initialze the parent AbstractPatternSniff to ignore comments
     */
    public function __construct()
    {
        parent::__construct(true);
    }

    /**
     * Returns the patterns that this test wishes to verify.
     *
     * @return array(string)
     */
    protected function getPatterns()
    {
        return [
            'do {EOL...} while (...);EOL',
            'while (...) {EOL',
            'for (...) {EOL',
            'if (...) {EOL',
            'foreach (...) {EOL',
            '} elseif (...) {EOL',
            '} else {EOL',
            'try {EOL...} catch (...) {EOL',
        ];
    }
}

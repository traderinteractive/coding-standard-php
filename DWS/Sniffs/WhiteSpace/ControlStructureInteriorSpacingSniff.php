<?php
/**
 * Verifies that there are no blank lines at the beginning or end of control structures.
 *
 * @package DWS
 * @subpackage Sniffs
 */

namespace DWS\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

/**
 * Verifies that there are no blank lines at the beginning or end of control structures.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class ControlStructureInteriorSpacingSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_IF, T_WHILE, T_FOREACH, T_FOR, T_SWITCH, T_DO, T_ELSE, T_ELSEIF, T_TRY, T_CATCH];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int $stackPtr The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $token = $tokens[$stackPtr];

        if (!array_key_exists('scope_opener', $token) || !array_key_exists('scope_closer', $token)) {
            return;
        }

        $scopeOpener = $token['scope_opener'];
        $firstContent = $phpcsFile->findNext(T_WHITESPACE, $scopeOpener + 1, null, true);

        if ($tokens[$firstContent]['line'] !== $tokens[$scopeOpener]['line'] + 1) {
            $phpcsFile->addError('Blank line found at start of control structure', $scopeOpener, 'SpacingBeforeOpen');
        }

        $scopeCloser = $token['scope_closer'];
        $lastContent = $phpcsFile->findPrevious(T_WHITESPACE, $scopeCloser - 1, null, true);

        if ($tokens[$lastContent]['line'] !== $tokens[$scopeCloser]['line'] - 1) {
            $phpcsFile->addError('Blank line found at end of control structure', $lastContent + 2, 'SpacingAfterClose');
        }
    }
}

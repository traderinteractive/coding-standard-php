<?php
/**
 * A test to ensure that arrays conform to the array coding standard.
 *
 * @package DWS
 * @subpackage Sniffs
 */

namespace DWS\Sniffs\Arrays;

use DWS\Helpers\Bracket;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

/**
 * A test to ensure that arrays conform to the array coding standard.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class ArrayDeclarationSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_ARRAY, T_OPEN_SHORT_ARRAY];
    }

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer\Files\File $phpcsFile The current file being checked.
     * @param int $stackPtr The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $arrayStart = Bracket::bracketStart($phpcsFile, $stackPtr);
        $arrayEnd = Bracket::bracketEnd($phpcsFile, $stackPtr);

        if (!in_array($arrayStart, [$stackPtr, $stackPtr + 1])) {
            $phpcsFile->addError('No whitespace allowed between the array keyword and the opening parenthesis', $stackPtr, 'SpaceAfterKeyword');
        }

        $firstMember = $phpcsFile->findNext(T_WHITESPACE, $arrayStart + 1, $arrayEnd, true);
        if ($firstMember === false && $arrayEnd - $arrayStart !== 1) {
            $phpcsFile->addError('Empty array declaration must have no space between the brackets', $stackPtr, 'SpaceInEmptyArray');
        }
    }
}

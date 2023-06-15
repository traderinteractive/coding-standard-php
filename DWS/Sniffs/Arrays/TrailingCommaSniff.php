<?php
/**
 * A test to ensure that trailing commas are included for multi-line arrays only.
 *
 * @package DWS
 * @subpackage Sniffs
 */

namespace DWS\Sniffs\Arrays;

use DWS\Helpers;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;

/**
 * A test to ensure that trailing commas are included for multi-line arrays only.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class TrailingCommaSniff implements Sniff
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
        $arrayStart = Helpers\Bracket::bracketStart($phpcsFile, $stackPtr);
        $arrayEnd = Helpers\Bracket::bracketEnd($phpcsFile, $stackPtr);

        $isSingleLine = $tokens[$arrayStart]['line'] === $tokens[$arrayEnd]['line'];

        $commas = Helpers\Arrays::commaPositions($phpcsFile, $arrayStart);

        $lastComma = array_pop($commas);
        $trailingComma = $phpcsFile->findNext(Tokens::$emptyTokens, $lastComma + 1, $arrayEnd, true) === false;

        if ($isSingleLine) {
            if ($trailingComma) {
                $phpcsFile->addError('No trailing comma allowed on single-line arrays', $lastComma, 'SingleLineTrailingComma');
            }
        } elseif (!$trailingComma) {
            $previousItem = $phpcsFile->findPrevious(Tokens::$emptyTokens, $arrayEnd - 1, $arrayStart, true);
            $phpcsFile->addError('Trailing comma required for multi-line arrays', $previousItem, 'MultiLineTrailingComma');
        }
    }
}

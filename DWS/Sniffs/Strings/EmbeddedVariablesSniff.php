<?php
/**
 * Makes sure that all variables embedded in strings are enclosed in braces.
 *
 * @package DWS
 * @subpackage Sniffs
 */

namespace DWS\Sniffs\Strings;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

/**
 * Makes sure that all variables embedded in strings are enclosed in braces.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class EmbeddedVariablesSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_DOUBLE_QUOTED_STRING];
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

        // We are only interested in the first token in a multi-line string.
        if ($tokens[$stackPtr]['code'] === $tokens[$stackPtr - 1]['code']) {
            return;
        }

        $workingString = $tokens[$stackPtr]['content'];
        for ($i = $stackPtr + 1; $tokens[$i]['code'] === $tokens[$stackPtr]['code']; ++$i) {
            $workingString .= $tokens[$i]['content'];
        }

        // The use of variables in double quoted strings is allowed.
        if ($tokens[$stackPtr]['code'] === T_DOUBLE_QUOTED_STRING) {
            $openBraces = 0;
            foreach (token_get_all("<?php {$workingString}") as $token) {
                if (is_array($token) === true) {
                    if ($token[0] == T_CURLY_OPEN) {
                        ++$openBraces;
                    } elseif ($token[0] == T_VARIABLE && $openBraces < 1) {
                        $phpcsFile->addError(
                            "String {$workingString} has a variable embedded without being delimited by braces",
                            $stackPtr,
                            'ContainsNonDelimitedVariable',
                            [$token[1]]
                        );
                    }
                } elseif ($token == '}') {
                    --$openBraces;
                }
            }
        }
    }
}

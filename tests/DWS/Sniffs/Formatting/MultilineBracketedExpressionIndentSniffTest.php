<?php

final class DWS_Sniffs_Formatting_MultilineBracketedExpressionIndentSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return [7 => 1, 8 => 1, 16 => 1, 17 => 1, 18 => 1, 28 => 1, 31 => 1, 32 => 1, 39 => 1, 57 => 1, 58 => 1, 59 => 1, 65 => 1];
    }

    public function getWarningList()
    {
        return [];
    }

    protected function _getSniffName()
    {
        return '/DWS/Sniffs/Formatting/MultilineBracketedExpressionIndentSniff.php';
    }
}

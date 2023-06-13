<?php

final class DWS_Sniffs_Arrays_ArrayDeclarationSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return [5 => 1, 7 => 1, 8 => 1];
    }

    public function getWarningList()
    {
        return [];
    }

    protected function _getSniffName()
    {
        return 'DWS.Arrays.ArrayDeclaration';
    }
}

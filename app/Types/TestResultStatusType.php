<?php 

namespace App\Types;

class TestResultStatusType {

    const UNTESTED = 'untested';
    const PASSED = 'passed';
    const FAILED = 'failed';

    public static function getList() {
        return array(
            "UNTESTED" => self::UNTESTED,
            "PASSED" => self::PASSED,
            "FAILED" => self::FAILED
        );
    }

}
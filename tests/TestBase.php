<?php
namespace SombeMerchant;

use PHPUnit\Framework\TestCase;

class TestBase extends TestCase
{
    const testToken = 'zrDmJQ-0WZA-NiI4VY-LUCQ';
    const encKey = 'cKLHbW9pBsgu2SGVx12gFDwkyz415I2H';

    public static function getConfigurations() {
        return [
            'auth_token' => Self::testToken,
            'user_agent' => Self::encKey
        ];
    }
}

?>
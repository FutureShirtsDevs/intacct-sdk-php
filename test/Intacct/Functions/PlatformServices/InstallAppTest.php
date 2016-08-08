<?php
/**
 * Copyright 2016 Intacct Corporation.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"). You may not
 * use this file except in compliance with the License. You may obtain a copy
 * of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * or in the "LICENSE" file accompanying this file. This file is distributed on
 * an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace Intacct\Functions\PlatformServices;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

class InstallAppTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Intacct\Functions\PlatformServices\InstallApp::writeXml
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage XML Filename is required for install
     */
    public function testRequiredXmlFilename()
    {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $app = new InstallApp('unittest');
        //$app->setXmlFilename('app.xml');

        $app->writeXml($xml);
    }
}

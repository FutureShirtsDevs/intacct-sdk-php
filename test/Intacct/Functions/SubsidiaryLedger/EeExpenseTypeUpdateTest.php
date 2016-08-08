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

namespace Intacct\Functions\SubsidiaryLedger;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

class EeExpenseTypeUpdateTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Intacct\Functions\SubsidiaryLedger\EeExpenseTypeUpdate::writeXml
     */
    public function testConstruct()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <update>
        <EEACCOUNTLABEL>
            <ACCOUNTLABEL>Travel</ACCOUNTLABEL>
            <DESCRIPTION>hello world</DESCRIPTION>
            <GLACCOUNTNO>7000</GLACCOUNTNO>
        </EEACCOUNTLABEL>
    </update>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $label = new EeExpenseTypeUpdate('unittest');
        $label->setExpenseType('Travel');
        $label->setDescription('hello world');
        $label->setGlAccountNo('7000');

        $label->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    /**
     * @covers Intacct\Functions\SubsidiaryLedger\EeExpenseTypeUpdate::writeXml
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Expense Type is required for update
     */
    public function testRequiredAccountLabel()
    {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $label = new EeExpenseTypeUpdate('unittest');
        //$label->setExpenseType('Travel');
        $label->setDescription('hello world');
        $label->setGlAccountNo('7000');

        $label->writeXml($xml);
    }
}

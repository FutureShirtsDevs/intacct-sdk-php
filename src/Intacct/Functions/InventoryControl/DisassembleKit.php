<?php

/**
 * Copyright 2021 Sage Intacct, Inc.
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

namespace Intacct\Functions\InventoryControl;

use Intacct\Xml\XMLWriter;

/**
 * Create a new item record
 */
class DisassembleKit extends AbstractInventoryTransaction
{
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * @param AbstractInventoryTransactionLine[] $lines
     */
    public function setLines($lines)
    {
        $this->lines = $lines;
    }
    /**
     * Write the function block XML
     *
     * @param XMLWriter $xml
     */
    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement("function");
        $xml->writeAttribute("controlid", $this->getControlId());

        $xml->startElement("create_stkittransaction");

        $xml->writeElement("transactiontype", "Disassemble Kits", true);

        $xml->startElement("datecreated");
        $xml->writeDateSplitElements($this->getTransactionDate(), true);
        $xml->endElement(); //datecreated

        $xml->writeElement("createdfrom", $this->getCreatedFrom());
        $xml->writeElement("referenceno", $this->getReferenceNumber(), true);
        $xml->writeElement("message", $this->getMessage(), true);

        $this->writeXmlExplicitCustomFields($xml);

        $xml->endElement(); //create_ictransaction

        $xml->endElement(); //function
    }
}


<?php

/*
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

namespace Intacct\Xml\Request\Operation\Content;

use Intacct\Xml\Request\Operation\Content\FunctionInterface;
use InvalidArgumentException;
use XMLWriter;

class ReadByName implements FunctionInterface
{
    
    /**
     * @var array
     */
    const RETURN_FORMATS = ['xml', 'json', 'csv'];
    
    /**
     * @var string
     */
    const DEFAULT_RETURN_FORMAT = 'xml';
    
    /**
     * @var int
     */
    const MAX_NAME_COUNT = 100;
    
    /**
     *
     * @var string
     */
    private $controlId;
    
    /**
     *
     * @var string
     */
    private $objectName;
    
    /**
     *
     * @var array
     */
    private $fields;
    
    /**
     *
     * @var array
     */
    private $names;
    
    /**
     *
     * @var string
     */
    private $returnFormat;

    /**
     * 
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $defaults = [
            'control_id' => 'readByName',
            'object' => null,
            'fields' => [],
            'names' => [],
            'return_format' => static::DEFAULT_RETURN_FORMAT,
        ];
        $config = array_merge($defaults, $params);
        
        if (!$config['object']) {
            throw new InvalidArgumentException(
                'Required "object" key not supplied in params'
            );
        }
        
        $this->controlId = $config['control_id'];
        $this->objectName = $config['object'];
        $this->setFields($config['fields']);
        $this->setNames($config['names']);
        $this->setReturnFormat($config['return_format']);
    }
    
    /**
     * 
     * @param string $format
     * @throws InvalidArgumentException
     */
    private function setReturnFormat($format)
    {
        if (!in_array($format, static::RETURN_FORMATS)) {
            throw new InvalidArgumentException('return_format is not a valid format');
        }
        $this->returnFormat = $format;
    }
    
    /**
     * 
     * @param array $fields
     */
    private function setFields(array $fields)
    {
        $this->fields = $fields;
    }
    
    /**
     * 
     * @return string
     */
    private function getFields()
    {
        if (count($this->fields) > 0) {
            $fields = implode(',', $this->fields);
        } else {
            $fields = '*';
        }
        
        return $fields;
    }
    
    /**
     * 
     * @param array $names
     */
    private function setNames(array $names)
    {
        $this->names = $names;
    }
    
    /**
     * 
     * @return string
     * @throws InvalidArgumentException
     */
    private function getNames()
    {
        if (count($this->names) > static::MAX_NAME_COUNT) {
            throw new InvalidArgumentException('names count cannot exceed ' . static::MAX_NAME_COUNT);
        } else if (count($this->names) > 0) {
            $names = implode(',', $this->names);
        } else {
            $names = '';
        }
        
        return $names;
    }
    
    /**
     * 
     * @param XMLWriter $xml
     */
    public function getXml(XMLWriter &$xml)
    {
        $xml->startElement('function');
        $xml->writeAttribute('controlid', $this->controlId);
        
        $xml->startElement('readByName');
        
        $xml->writeElement('object', $this->objectName);
        $xml->writeElement('fields', $this->getFields());
        $xml->writeElement('keys', $this->getNames());
        $xml->writeElement('returnFormat', $this->returnFormat);
        
        $xml->endElement(); //readByName
        
        $xml->endElement(); //function
    }
    
}
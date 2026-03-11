<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPotato\GV100AD;

class GV100ADReader
{
    private $text_reader;

    /**
     * Initializes a new instance of the GV100ADReader class for the specified stream.
     *
     * @param resource $text_reader The stream to be read.
     */
    public function __construct($text_reader)
    {
        $this->text_reader = $text_reader;
    }

    /**
     * Iterates over the internal GV100AD stream and returns GV100AD records.
     *
     * @return \Iterator An iterator of BaseRecord-based instances.
     */
    public function read(): \Iterator
    {
        while (($line = fgets($this->text_reader)) !== false) {
            yield $this->create_record(trim($line));
        }
    }

    /**
     * Creates the appropriate BaseRecord-based instance by parsing the first 2 characters (Satzart)
     * of the given text line.
     *
     * @param string $line The text line to be parsed.
     *
     * @return BaseRecord A new BaseRecord-based instance.
     */
    private function create_record(string $line): BaseRecord
    {
        switch (substr($line, 0, 2)) {
            case '10':
                return new FederalState($line);
            case '20':
                return new GovernmentRegion($line);
            case '30':
                return new Region($line);
            case '40':
                return new District($line);
            case '50':
                return new MunicipalAssociation($line);
            case '60':
                return new Municipality($line);
            default:
                throw new \InvalidArgumentException("Record type {$line[0]}{$line[1]} is not supported.");
        }
    }
}

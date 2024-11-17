<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPotato\GV100AD;

class Region extends BaseRecord
{
    /**
     * Verwaltungssitz der Region (EF6)
     * 
     * @var string
     */
    public string $administrative_headquarters;

    /**
     * Initializes a new instance of the Region class.
     *
     * @param string $line A text row with Satzart 30.
     */
    public function __construct(string $line)
    {
        // Call parent constructor
        parent::__construct($line);
        
        // Extract relevant data from the line string
        $this->regional_code = rtrim(mb_substr($line, 10, 5, "UTF-8"));
        $this->administrative_headquarters = rtrim(mb_substr($line, 72, 50, "UTF-8"));
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "Region(Name=%s, RegionalCode=%s, AdministrativeHeadquarters=%s, TimeStamp=%s)",
            $this->name,
            $this->regional_code,
            $this->administrative_headquarters,
            $this->timestamp->format('Y-m-d')
        );
    }
}

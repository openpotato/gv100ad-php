<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPotato\GV100AD;

class GovernmentRegion extends BaseRecord
{
    /**
     * Verwaltungssitz des Regierungsbezirks (EF6)
     * 
     * @var string
     */
    public $administrative_headquarters;

    /**
     * Initializes a new instance of the GovernmentRegion class.
     *
     * @param string $line A text row with Satzart 20.
     */
    public function __construct($line)
    {
        // Call parent constructor
        parent::__construct($line);
        
        // Extract relevant data from the line string
        $this->regional_code = mb_substr($line, 10, 3, "UTF-8");
        $this->administrative_headquarters = rtrim(mb_substr($line, 72, 50, "UTF-8"));
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            "GovernmentRegion(Name=%s, RegionalCode=%s, AdministrativeHeadquarters=%s, TimeStamp=%s)",
            $this->name,
            $this->regional_code,
            $this->administrative_headquarters,
            $this->timestamp
        );
    }
}

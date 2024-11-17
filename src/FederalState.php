<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPotato\GV100AD;

class FederalState extends BaseRecord
{
    /**
     * Sitz der Landesregierung (EF6)
     * 
     * @var string
     */
    public string $seat_of_government;

    /**
     * Initializes a new instance of the FederalState class.
     *
     * @param string $line A text row with Satzart 10.
     */
    public function __construct(string $line)
    {
        // Call parent constructor
        parent::__construct($line);
        
        // Extract relevant data from the line string
        $this->regional_code = mb_substr($line, 10, 2, "UTF-8");
        $this->seat_of_government = rtrim(mb_substr($line, 72, 50, "UTF-8"));
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "FederalState(Name=%s, RegionalCode=%s, SeatOfGovernment=%s, TimeStamp=%s)",
            $this->name,
            $this->regional_code,
            $this->seat_of_government,
            $this->timestamp->format('Y-m-d')
        );
    }
}

<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPotato\GV100AD;

class MunicipalAssociation extends BaseRecord
{
    /**
     * Gemeindeverband (EF4)
     * 
     * @var string
     */
    public string $association;
    
    /**
     * Verwaltungssitz des Gemeindeverbandes (EF6)
     * 
     * @var string
     */
    public string $administrative_headquarters;
    
    /**
     * Kennzeichen (EF7)
     * 
     * @var MunicipalAssociationType
     */
    public MunicipalAssociationType $type;

    /**
     * Initializes a new instance of the MunicipalAssociation class.
     *
     * @param string $line A text row with Satzart 50.
     */
    public function __construct(string $line)
    {
        // Call parent constructor
        parent::__construct($line);

        // Extract relevant data from the line string
        $this->regional_code = mb_substr($line, 10, 5, "UTF-8");
        $this->association = mb_substr($line, 18, 4, "UTF-8");
        $this->administrative_headquarters = rtrim(mb_substr($line, 72, 50, "UTF-8"));
        $this->type = MunicipalAssociationType::tryFrom((int) trim(mb_substr($line, 122, 2, "UTF-8"))) ?? MunicipalAssociationType::NONE;
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "MunicipalAssociation(Name=%s, RegionalCode=%s, Association=%s, AdministrativeHeadquarters=%s, Type=%s, TimeStamp=%s)",
            $this->name,
            $this->regional_code,
            $this->association,
            $this->administrative_headquarters,
            $this->type->name,
            $this->timestamp->format('Y-m-d')
        );
    }
}

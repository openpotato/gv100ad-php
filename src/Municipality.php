<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPotato\GV100AD;

class Municipality extends BaseRecord
{
    /**
     * Gemeindeverband (EF4)
     * 
     * @var string
     */
    public string $association;

    /**
     * Kennzeichen (EF7)
     * 
     * @var MunicipalityType
     */
    public MunicipalityType $type;
    
    /**
     * Area in hectares (EF8)
     * 
     * @var int
     */
    public int $area;
    
    /**
     * Total population (EF9)
     * 
     * @var int
     */
    public int $inhabitants;

    /**
     * Male population (EF10)
     * 
     * @var int
     */
    public int $inhabitants_male;

    /**
     * Postalcode (if there are multiple postcodes > postalcode of the Verwaltungssitz) (EF12U1)
     * 
     * @var string
     */
    public string $postal_code;

    /**
     * Multiple postcodes available? (EF12U2)
     * 
     * @var bool
     */
    public bool $multiple_postal_codes;
    
    /**
     * Finanzamtsbezirk (EF14)
     * 
     * @var string
     */
    public $tax_office_district;

    /**
     * Oberlandesgerichtsbezirk (EF15U1)
     * 
     * @var string
     */
    public string $higher_regional_court_district;
    
    /**
     * Landgerichtsbezirk (EF15U2)
     * 
     * @var string
     */
    public string $regional_court_district;
    
    /**
     * Amtsgerichtsbezirk (EF15U3)
     * 
     * @var string
     */
    public string $local_court_district;
    
    /**
     * Arbeitsagenturbezirk (EF16)
     * 
     * @var string
     */
    public string $employment_agency_district;

    /**
     * Initializes a new instance of the Municipality class.
     *
     * @param string $line A text row with Satzart 60.
     */
    public function __construct(string $line)
    {
        // Call parent constructor
        parent::__construct($line);
        
        // Extract relevant data from the line string
        $this->regional_code = mb_substr($line, 10, 8, "UTF-8");
        $this->association = mb_substr($line, 18, 4, "UTF-8");
        $this->area = (int) trim(mb_substr($line, 128, 11, "UTF-8"));
        $this->inhabitants = (int) trim(mb_substr($line, 139, 11, "UTF-8"));
        $this->inhabitants_male = (int) trim(mb_substr($line, 150, 11, "UTF-8"));
        $this->postal_code = trim(mb_substr($line, 165, 5, "UTF-8"));
        $this->multiple_postal_codes = (bool) trim(mb_substr($line, 170, 5, "UTF-8"));
        $this->tax_office_district = trim(mb_substr($line, 177, 4, "UTF-8"));
        $this->higher_regional_court_district = trim(mb_substr($line, 181, 1, "UTF-8"));
        $this->regional_court_district = trim(mb_substr($line, 182, 1, "UTF-8"));
        $this->local_court_district = trim(mb_substr($line, 183, 2, "UTF-8"));
        $this->employment_agency_district = trim(mb_substr($line, 185, 5, "UTF-8"));
        $this->type = MunicipalityType::tryFrom((int) trim(mb_substr($line, 122, 2, "UTF-8"))) ?? MunicipalityType::NONE;
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "Municipality(Name=%s, RegionalCode=%s, Association=%s, Type=%s, Area=%d, Inhabitants=%d, InhabitantsMale=%d, PostalCode=%s, MultiplePostalCodes=%s, TaxOfficeDistrict=%s, HigherRegionalCourtDistrict=%s, RegionalCourtDistrict=%s, LocalCourtDistrict=%s, EmploymentAgencyDistrict=%s, TimeStamp=%s)",
            $this->name,
            $this->regional_code,
            $this->association,
            $this->type->name,
            $this->area,
            $this->inhabitants,
            $this->inhabitants_male,
            $this->postal_code,
            $this->multiple_postal_codes ? 'true' : 'false',
            $this->tax_office_district,
            $this->higher_regional_court_district,
            $this->regional_court_district,
            $this->local_court_district,
            $this->employment_agency_district,
            $this->timestamp->format('Y-m-d')
        );
    }
}

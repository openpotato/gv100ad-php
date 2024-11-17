<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPotato\GV100AD;

class BaseRecord
{
    /**
     * Gebietsstand (EF2)
     * 
     * @var DateTime
     */
    public \DateTime $timestamp;

    /**
     * Regionalschlüssel (EF3)
     * 
     * @var string
     */
    public string $regional_code;

    /**
     * Bezeichnung (EF5)
     * 
     * @var string
     */
    public string $name;

    /**
     * Initializes a new instance of the BaseRecord class.
     *
     * @param string $line A text row from a GV100AD file.
     */
    public function __construct(string $line)
    {
        $this->timestamp = \DateTime::createFromFormat('Ymd', mb_substr($line, 2, 8, "UTF-8"));
        $this->timestamp->SetTime(0, 0, 0, 0);
        $this->name = rtrim(mb_substr($line, 22, 50, "UTF-8"));
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf("BaseRecord(Name=%s, TimeStamp=%s)", $this->name, $this->timestamp);
    }
}

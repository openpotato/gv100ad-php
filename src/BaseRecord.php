<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPotato\GV100AD;

abstract class BaseRecord
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
        $this->timestamp = $this->parseDateOnly(mb_substr($line, 2, 8, "UTF-8"));
        $this->name = rtrim(mb_substr($line, 22, 50, "UTF-8"));
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "BaseRecord(Name=%s, TimeStamp=%s)", 
            $this->name, 
            $this->timestamp->format('Y-m-d')
        );
    }

    /**
     * Parses the raw record date and validates it.
     *
     * @param string $rawDate The raw date from EF2.
     *
     * @return \DateTime A normalized timestamp.
     */
    private function parseDateOnly(string $rawDate): \DateTime
    {
        $timestamp = \DateTime::createFromFormat('Ymd', $rawDate);
        $dateErrors = \DateTime::getLastErrors();

        if (!$timestamp || ($dateErrors !== false && ($dateErrors['warning_count'] > 0 || $dateErrors['error_count'] > 0))) {
            throw new \InvalidArgumentException("Invalid record date '{$rawDate}'.");
        }

        $timestamp->setTime(0, 0, 0, 0);

        return $timestamp;
    }
}

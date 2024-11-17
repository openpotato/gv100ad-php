<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPotato\GV100AD;

use \DateTime;
use PHPUnit\Framework\TestCase;

class GV100ADReaderTest extends TestCase
{
    public function testDistrict()
    {
        $text_line = "402022013108221       Heidelberg, Stadtkreis                            Heidelberg                                        42                                                                                                ";
        $str_stream = fopen('php://memory', 'r+');
        fwrite($str_stream, $text_line);
        rewind($str_stream);

        $gv_reader = new GV100ADReader($str_stream);
        $records = iterator_to_array($gv_reader->read());
        $record = $records[0];

        $this->assertEquals(new DateTime('2022-01-31'), $record->timestamp);
        $this->assertEquals('08221', $record->regional_code);
        $this->assertEquals('Heidelberg, Stadtkreis', $record->name);
        $this->assertEquals('Heidelberg', $record->administrative_headquarters);
        $this->assertEquals(DistrictType::STADTKREIS, $record->type);

        $this->assertCount(1, $records); 
    }

    public function testFederalState()
    {
        $text_line = "102022013101          Schleswig-Holstein                                Kiel                                                                                                                                                ";
        $str_stream = fopen('php://memory', 'r+');
        fwrite($str_stream, $text_line);
        rewind($str_stream);

        $gv_reader = new GV100ADReader($str_stream);
        $records = iterator_to_array($gv_reader->read());
        $record = $records[0];

        $this->assertEquals(new DateTime('2022-01-31'), $record->timestamp);
        $this->assertEquals('01', $record->regional_code);
        $this->assertEquals('Schleswig-Holstein', $record->name);
        $this->assertEquals('Kiel', $record->seat_of_government);

        $this->assertCount(1, $records);
    }

    public function testGovernmentRegion()
    {
        $text_line = "2020220131051         Reg.-Bez. Düsseldorf                              Düsseldorf                                                                                                                                          ";
        $str_stream = fopen('php://memory', 'r+');
        fwrite($str_stream, $text_line);
        rewind($str_stream);

        $gv_reader = new GV100ADReader($str_stream);
        $records = iterator_to_array($gv_reader->read());
        $record = $records[0];

        $this->assertEquals(new DateTime('2022-01-31'), $record->timestamp);
        $this->assertEquals('051', $record->regional_code);
        $this->assertEquals('Reg.-Bez. Düsseldorf', $record->name);
        $this->assertEquals('Düsseldorf', $record->administrative_headquarters);

        $this->assertCount(1, $records);
    }

    public function testMunicipalAssociation()
    {
        $text_line = "502022013108221   0000Heidelberg, Stadt                                                                                   50                                                                                                ";
        $str_stream = fopen('php://memory', 'r+');
        fwrite($str_stream, $text_line);
        rewind($str_stream);

        $gv_reader = new GV100ADReader($str_stream);
        $records = iterator_to_array($gv_reader->read());
        $record = $records[0];

        $this->assertEquals(new DateTime('2022-01-31'), $record->timestamp);
        $this->assertEquals('08221', $record->regional_code);
        $this->assertEquals('0000', $record->association);
        $this->assertEquals('Heidelberg, Stadt', $record->name);
        $this->assertEquals('', $record->administrative_headquarters);
        $this->assertEquals(MunicipalAssociationType::VERBANDSFREIE_GEMEINDE, $record->type);

        $this->assertCount(1, $records);
    }

    public function testMunicipality()
    {
        $text_line = "6020220131082260135001Eberbach, Stadt                                                                                     63    000000081150000001426700000006914    69412*****  2840130262405277                           ";
        $str_stream = fopen('php://memory', 'r+');
        fwrite($str_stream, $text_line);
        rewind($str_stream);

        $gv_reader = new GV100ADReader($str_stream);
        $records = iterator_to_array($gv_reader->read());
        $record = $records[0];

        $this->assertEquals(new DateTime('2022-01-31'), $record->timestamp);
        $this->assertEquals('08226013', $record->regional_code);
        $this->assertEquals('5001', $record->association);
        $this->assertEquals('Eberbach, Stadt', $record->name);
        $this->assertEquals(MunicipalityType::STADT, $record->type);
        $this->assertEquals('69412', $record->postal_code);
        $this->assertTrue($record->multiple_postal_codes);
        $this->assertEquals('2840', $record->tax_office_district);
        $this->assertEquals('1', $record->higher_regional_court_district);
        $this->assertEquals('3', $record->regional_court_district);
        $this->assertEquals('02', $record->local_court_district);
        $this->assertEquals('62405', $record->employment_agency_district);

        $this->assertCount(1, $records);
    }

    public function testRegion()
    {
        $text_line = "30202201310822        Region Rhein-Neckar                               Mannheim                                                                                                                                            ";
        $str_stream = fopen('php://memory', 'r+');
        fwrite($str_stream, $text_line);
        rewind($str_stream);

        $gv_reader = new GV100ADReader($str_stream);
        $records = iterator_to_array($gv_reader->read());
        $record = $records[0];

        $this->assertEquals(new DateTime('2022-01-31'), $record->timestamp);
        $this->assertEquals('0822', $record->regional_code);
        $this->assertEquals('Region Rhein-Neckar', $record->name);
        $this->assertEquals('Mannheim', $record->administrative_headquarters);

        $this->assertCount(1, $records);
    }
}

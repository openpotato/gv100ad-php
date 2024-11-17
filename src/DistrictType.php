<?php
namespace OpenPotato\GV100AD;

/**
 * District type (Kreiskennzeichen)
 */
enum DistrictType: int
{
    case NONE = 0;
    case KREISFREIE_STADT = 41;
    case STADTKREIS = 42;
    case KREIS = 43;
    case LANDKREIS = 44;
    case REGIONALVERBAND = 45;
}

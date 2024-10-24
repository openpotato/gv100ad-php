<?php
namespace OpenPotato\GV100AD;

/**
 * Municipality type (Gemeindekennzeichen)
 */
enum MunicipalityType: int
{
    case NONE = 0;
    case MARKT = 60;
    case KREISFREIE_STADT = 61;
    case STADTKREIS = 62;
    case STADT = 63;
    case KREISANGEHOERIGE_GEMEINDE = 64;
    case GEMEINDEFREIES_GEBIET_BEWOHNT = 65;
    case GEMEINDEFREIES_GEBIET_UNBEWOHNT = 66;
    case GROSSE_KREISSTADT = 67;
}

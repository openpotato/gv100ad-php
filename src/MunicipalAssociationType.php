<?php
namespace OpenPotato\GV100AD;

/**
 * Municipal association type (Gemeindeverbandskennzeichen) 
 */
enum MunicipalAssociationType: int
{
    case NONE = 0;
    case VERBANDSFREIE_GEMEINDE = 50;
    case AMT = 51;
    case SAMTGEMEINDE = 52;
    case VERBANDSGEMEINDE = 53;
    case VERWALTUNGSGEMEINSCHAFT = 54;
    case KIRCHSPIELSLANDGEMEINDE = 55;
    case VERWALTUNGSVERBAND = 56;
    case VG_TRAEGERMODELL = 57;
    case ERFUELLENDE_GEMEINDE = 58;
}

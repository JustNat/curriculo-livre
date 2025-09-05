<?php

namespace App\Enums;

enum EducationLevel: string
{
    case MIDDLE_SCHOOL = 'MIDDLE_SCHOOL';
    case HIGH_SCHOOL = 'HIGH_SCHOOL';
    case UNDERGRADUATE = 'UNDERGRADUATE';
    case POSTGRADUATE = 'POSTGRADUATE';
    case MASTER = 'MASTER';
    case PHD = 'PHD';
}
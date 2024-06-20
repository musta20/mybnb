<?php

namespace App\Enums;

enum Cities: string
{
    case Cairo = 'Cairo';
    case Alexandria = 'Alexandria';
    case Giza = 'Giza';
    case Luxor = 'Luxor';
    case Aswan = 'Aswan';
    case SharmElSheikh = 'SharmElSheikh';
    case PortSaid = 'PortSaid';
    case Suez = 'Suez';

    public static function getByString(string $value): ?self
    {
        return self::tryFrom($value);
    }

    public function getPosition(): array
    {
        return match ($this) {
            self::Cairo => ['lat' => 30.044455655220776, 'lng' => 31.23442786432751],
            self::Alexandria => ['lat' => 31.20141913746063,  'lng' => 29.9184104460691],
            self::Giza => ['lat' => 30.013065866466217, 'lng' => 31.209383407220187],
            self::Luxor => ['lat' => 25.69677111175633, 'lng' => 32.64432180860359],
            self::Aswan => ['lat' => 24.08872889157391,  'lng' => 32.8992476836013],
            self::SharmElSheikh => ['lat' => 27.964747965795897, 'lng' => 34.36162693867904],
            self::PortSaid => ['lat' => 31.2655271140274,  'lng' => 32.304394731795405],
            self::Suez => ['lat' => 29.968134591594616, 'lng' => 32.551319536889324],
        };
    }
}

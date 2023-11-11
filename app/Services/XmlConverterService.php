<?php
namespace App\Services;

use Spatie\ArrayToXml\ArrayToXml;

class XmlConverterService
{
    public function convertToXml(array $data): string
    {
        return ArrayToXml::convert($data);
    }
}

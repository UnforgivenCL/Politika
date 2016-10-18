<?php

namespace App\Support\CongressApi\Endpoints;

class Delegate extends AbstractEndpoint
{
    public function getDelegates()
    {
        return $this->setHttpMethod('GET')
            ->setUriGenerator(function ($params) {
                return implode('', [
                    'getDiputados_Vigentes',
                ]);
            });
    }
}

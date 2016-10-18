<?php

namespace App\Support\CongressApi\Endpoints;

class Votation extends AbstractEndpoint
{
    public function number($number)
    {
        return $this->setParam('number', $number);
    }

    public function getVotation()
    {
        return $this->setHttpMethod('GET')
            ->setUriGenerator(function ($params) {
                return implode('', [
                    'votaciones.php?',
                    'boletin='.array_get($params, 'number'),
                ]);
            });
    }
}

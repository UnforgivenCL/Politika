<?php

namespace App\Support\CongressApi\Endpoints;

class LawProject extends AbstractEndpoint
{
    public function number($number)
    {
        return $this->setParam('number', $number);
    }

    public function getLawProject()
    {
        return $this->setHttpMethod('GET')
            ->setUriGenerator(function ($params) {
                return implode('', [
                    'tramitacion.php?',
                    'boletin='.array_get($params, 'number'),
                ]);
            });
    }
}

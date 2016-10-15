<?php

namespace App\Support\CongressApi\Endpoints;

class Law extends AbstractEndpoint
{
    public function paginate($pages)
    {
        return $this->setParam('pages', $pages);
    }

    public function getLatest()
    {
        return $this->setHttpMethod('GET')
            ->setUriGenerator(function ($params) {
                return implode('', [
                    'opt=3',
                    '&cantidad='.array_get($params, 'pages'),
                ]);
            });
    }
}

<?php

namespace App\Support\CongressApi\Endpoints;

class Law extends AbstractEndpoint
{
    public function paginate($pages)
    {
        return $this->setParam('pages', $pages);
    }

    public function content($content)
    {
        return $this->setParam('content', $content);
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

    public function getByContent()
    {
        return $this->setHttpMethod('GET')
            ->setUriGenerator(function ($params) {
                return implode('', [
                    'opt=61',
                    '&cadena='.array_get($params, 'content'),
                    '&cantidad='.array_get($params, 'pages'),
                ]);
            });
    }
}

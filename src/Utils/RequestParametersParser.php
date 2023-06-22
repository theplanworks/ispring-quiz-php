<?php

namespace ThePLAN\IspringQuizPhp\Utils;

class RequestParametersParser
{
    public static function getRequestParameters($postParameters, $rawRequest)
    {
        $result = $postParameters;
        if (! $result) {
            $result = [];
            if ($rawRequest) {
                parse_str($rawRequest, $result);
            }
        }

        return $result;
    }
}

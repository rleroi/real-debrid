<?php

namespace RealDebrid\Response\Handlers;

use Psr\Http\Message\ResponseInterface;
use RealDebrid\Auth\Token;

/**
 * AbstractResponseHandler
 *
 * Parent response handler
 * @package RealDebrid\Response\Handlers
 * @author Valentin GOT
 */
class AbstractResponseHandler {

    protected function getJson(ResponseInterface $response) {
        return json_decode($response->getBody());
    }
}
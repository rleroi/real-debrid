<?php

namespace RealDebrid\Request\Torrents;

use RealDebrid\Auth\Token;
use RealDebrid\Request\AbstractRequest;
use RealDebrid\Request\RequestType;

/**
 * GET /torrents/info/{id}
 *
 * Get all information on the asked torrent
 * @package RealDebrid\Request\Torrents
 * @author Valentin GOT
 */
class InstantAvailabilityRequest extends AbstractRequest {
    private $hash;

    /**
     * Get all information on the asked torrent
     *
     * @param Token $token Access token
     * @param string $hash Torrent SHA1 hash
     */
    public function __construct(Token $token, $hash) {
        parent::__construct();

        $this->setToken($token);
        $this->hash = $hash;
    }

    public function getHash() {
        return $this->hash;
    }

    public function getRequestType() {
        return RequestType::GET;
    }

    public function getUri() {
        return "torrents/instantAvailability/:hash";
    }
}
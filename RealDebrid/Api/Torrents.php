<?php

namespace RealDebrid\Api;

use RealDebrid\Request\Torrents\AddMagnetRequest;
use RealDebrid\Request\Torrents\AddTorrentRequest;
use RealDebrid\Request\Torrents\AvailableHostsRequest;
use RealDebrid\Request\Torrents\DeleteRequest;
use RealDebrid\Request\Torrents\InfoRequest;
use RealDebrid\Request\Torrents\SelectFilesRequest;
use RealDebrid\Request\Torrents\TorrentsRequest;

/**
 * /torrents namespace
 *
 * Provides a set of methods for torrents downloading
 * @package RealDebrid\Api
 * @author Valentin GOT
 * @license MIT
 * @api
 */
class Torrents extends EndPoint {

    /**
     * Get user torrents list
     *
     * Warning: You can not use both offset and page at the same time, page is prioritized in case it happens.
     * @param bool|false $filter TRUE to list only active torrents; FALSE otherwise
     * @param int $page Pagination system
     * @param int $limit Entries returned per page / request (must be within 0 and 100, default: 50)
     * @param int|null $offset Starting offset (must be within 0 and X-Total-Count HTTP header)
     * @return array User torrents list
     */
    public function get($filter = false, $page = 1, $limit = 50, $offset = null) {
        return $this->request(new TorrentsRequest($this->token, $filter, $page, $limit, $offset));
    }

    /**
     * Get all information on the asked torrent
     *
     * @param string $id Torrent ID
     * @return \stdClass Torrent information
     */
    public function torrent($id) {
        return $this->request(new InfoRequest($this->token, $id));
    }

    /**
     * Get all information on the asked torrent
     *
     * @param string $hash Torrent SHA1 hash
     * @return \stdClass Torrent information
     */
    public function instantAvailability($hash) {
        return $this->request(new InfoRequest($this->token, $hash));
    }

    /**
     * Get available hosts to upload the torrent to
     *
     * @return array Available hosts
     */
    public function availableHosts() {
        return $this->request(new AvailableHostsRequest($this->token));
    }

    /**
     * Add a torrent file to download
     *
     * The files must be selected with the selectFiles method to start the torrent
     * @param string $path Path to the torrent file
     * @param int|null $host Hoster domain (retrieved from /torrents/availableHosts)
     * @param int|null $split Split size (under max_split_size of concerned hoster retrieved from /torrents/availableHosts)
     * @return \stdClass Torrent information
     */
    public function addTorrent($path, $host = null, $split = null) {
        return $this->request(new AddTorrentRequest($this->token, $path, $host, $split));
    }

    /**
     * Add a magnet link to download
     *
     * The files must be selected with the selectFiles method to start the torrent
     * @param string $magnet Magnet link
     * @param int|null $host Hoster domain (retrieved from /torrents/availableHosts)
     * @param int|null $split Split size (under max_split_size of concerned hoster retrieved from /torrents/availableHosts)
     * @return \stdClass Magnet information
     */
    public function addMagnet($magnet, $host = null, $split = null) {
        return $this->request(new AddMagnetRequest($this->token, $magnet, $host, $split));
    }

    /**
     * Select files of a torrent to start it
     *
     * Warning: To get file IDs, use /torrents/info/{id}
     * @param string $id Torrent ID
     * @param array $files Array of selected files IDs
     */
    public function selectFiles($id, array $files = array()) {
        $this->request(new SelectFilesRequest($this->token, $id, $files));
    }

    /**
     * Delete a torrent from torrents list
     *
     * @param string $id Torrent ID
     */
    public function delete($id) {
        $this->request(new DeleteRequest($this->token, $id));
    }
}
<?php

namespace SevenShores\Hubspot\Resources;

class HubDB extends Resource
{
    /**
     * Get all tables
     *
     * @param int $portalId Hub/Portal ID
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function tables($portalId) {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables';

        $queryString = build_query_string(['portalId' => $portalId]);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get details about a table
     *
     * @param int $portalId Hub ID
     * @param int $tableId Table ID
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function tableInfo($portalId, $tableId) {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId;

        $queryString = build_query_string(['portalId' => $portalId]);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get table rows
     *
     * @param int $portalId Hub/Portal ID
     * @param int $tableId table ID
     * @param array $params key-value array to filter and sort rows
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function rows($portalId, $tableId, array $params)
    {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId.'/rows';

        $queryString = build_query_string(array_merge(['portalId' => $portalId], $params));

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param int $tableId table ID
     * @param array $values
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function addRow($tableId, array $values) {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId.'/rows';
        $options['json'] = ['values' => $values];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * update database table row
     *
     * @param int   $tableId
     * @param int $rowId
     * @param array $values
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function updateRow($tableId, $rowId, array $values) {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId.'/rows/'.$rowId;
        $options['json'] = ['values' => $values];

        return $this->client->request('post', $endpoint, $options);
    }
}
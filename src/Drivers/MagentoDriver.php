<?php

namespace SourceBroker\DeployerExtendedMagento\Drivers;


/**
 * Class MagentoDriver
 * @package SourceBroker\DeployerExtended\Drivers
 */
class MagentoDriver
{
    /**
     * @param null $params
     * @return array
     * @throws \Exception
     */
    public function getDatabaseConfig($params = null)
    {
        $filename = $params['file'];

        if (file_exists($filename)) {
            $xml = simplexml_load_file($filename);
            $dbConfig['user'] = $xml->global[0]->resources[0]->default_setup[0]->connection[0]->username[0]->__toString();
            $dbConfig['password'] = $xml->global[0]->resources[0]->default_setup[0]->connection[0]->password[0]->__toString();
            $dbConfig['dbname'] = $xml->global[0]->resources[0]->default_setup[0]->connection[0]->dbname[0]->__toString();
            $dbConfig['host'] = $xml->global[0]->resources[0]->default_setup[0]->connection[0]->host[0]->__toString();
            if ($xml->global[0]->resources[0]->default_setup[0]->connection[0]->port[0]) {
                $dbConfig['port'] = $xml->global[0]->resources[0]->default_setup[0]->connection[0]->port[0]->__toString();
            }
        } else {
            throw new \Exception('Missing file with database parameters. Looking for file: "' . $filename . '"');
        }

        return [$params['database_code'] => $dbConfig];
    }

    /**
     * @param null $params
     * @return string
     * @throws \Exception
     */
    public function getInstanceName($params = null)
    {
        $filename = $params['file'];
        if (file_exists($filename)) {
            $xml = simplexml_load_file($filename);
            if ($xml->instance) {
                return strtolower($xml->instance[0]->__toString());
            } else {
                throw new \Exception('Missing <instance>[instance name]</instance> node in file: "' . $filename . '"');
            }
        } else {
            throw new \Exception('Missing file with instance name. Looking for file: "' . $filename . '"');
        }
    }

}

<?php

namespace SourceBroker\DeployerExtendedMagento\Drivers;


/**
 * Class MagentoDriver
 * @package SourceBroker\DeployerExtended\Drivers
 */
class MagentoDriver
{
    /**
     * @param null $absolutePathWithConfig
     * @return array
     * @throws \Exception
     */
    public function getDatabaseConfig($absolutePathWithConfig = null)
    {
        if (null === $absolutePathWithConfig) {
            $absolutePathWithConfig = getcwd() . '/app/etc/local.xml';
        }
        if (file_exists($absolutePathWithConfig)) {
            $xml = simplexml_load_file($absolutePathWithConfig);
            $dbSettings['user'] = $xml->global[0]->resources[0]->default_setup[0]->connection[0]->username[0]->__toString();
            $dbSettings['password'] = $xml->global[0]->resources[0]->default_setup[0]->connection[0]->password[0]->__toString();
            $dbSettings['dbname'] = $xml->global[0]->resources[0]->default_setup[0]->connection[0]->dbname[0]->__toString();
            $dbSettings['host'] = $xml->global[0]->resources[0]->default_setup[0]->connection[0]->host[0]->__toString();
            if ($xml->global[0]->resources[0]->default_setup[0]->connection[0]->port[0]) {
                $dbSettings['port'] = $xml->global[0]->resources[0]->default_setup[0]->connection[0]->port[0]->__toString();
            }
        } else {
            throw new \Exception('Missing file with database parameters. Looking for file: "' . $absolutePathWithConfig . '"');
        }
        return $dbSettings;
    }

    /**
     * @param null $absolutePathWithConfig
     * @return string
     * @throws \Exception
     */
    public function getInstanceName($absolutePathWithConfig = null)
    {
        if (null === $absolutePathWithConfig) {
            $absolutePathWithConfig = getcwd() . '/app/etc/local.xml';
        }
        if (file_exists($absolutePathWithConfig)) {
            $xml = simplexml_load_file($absolutePathWithConfig);
            if ($xml->instance) {
                return strtolower($xml->instance[0]->__toString());
            } else {
                throw new \Exception('Missing <instance>[instance name]</instance> node in file: "' . $absolutePathWithConfig . '"');
            }
        } else {
            throw new \Exception('Missing file with instance name. Looking for file: "' . $absolutePathWithConfig . '"');
        }
    }

}

<?php
namespace Education\Resolvers;

class EntityResolver
{
    const BASE_ENTITY_CONFIG = 'entities';

    static public function getConfigKey($entityClass, $key)
    {
        return config(self::BASE_ENTITY_CONFIG . '.' . $entityClass . '.' . $key);
    }
}
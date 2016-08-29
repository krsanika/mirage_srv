<?php

namespace Mirage\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\DBAL\Types\Type;

class MirageUserBundle extends Bundle
{
//    public function boot() {
//        Type::addType('tinyint','Doctrine\DBAL\Types\TinyIntType');
//        $em = $this->get('doctrine')->getManager('user1_admin');
//        $conn = $em->getConnection();
//        $conn->getDatabasePlatform()->registerDoctrineTypeMapping('TINYINT','tinyint');
//    }
//    public function boot()
//    {
//        $em = Doctrine\ORM\EntityManager::create($conn, $config, $evm);
//        Doctrine\DBAL\Types\Type::addType('tinyint', 'Doctrine\DBAL\Types\TinyIntType');
//        $em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('TINYINT', 'tinyint');
//    }
}

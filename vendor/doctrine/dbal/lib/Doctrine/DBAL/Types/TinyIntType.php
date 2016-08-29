<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 2016-08-04
 * Time: 오후 11:19
 */

namespace Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Type that maps a database TINYINT to a PHP integer.
 *
 * @author robo
 */
class TinyIntType extends Type
{
    const TINYINT = 'tinyint';
    /**
    * {@inheritdoc}
    */
    public function getName()
    {
        return self::TINYINT;
    }

    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getTinyIntTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return (null === $value) ? null : (int) $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getBindingType()
    {
        return \PDO::PARAM_INT;
    }

}
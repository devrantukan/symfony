<?php

namespace Festival\GuestBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'guest' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Festival.GuestBundle.Model.map
 */
class GuestTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Festival.GuestBundle.Model.map.GuestTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('guest');
        $this->setPhpName('Guest');
        $this->setClassname('Festival\\GuestBundle\\Model\\Guest');
        $this->setPackage('src.Festival.GuestBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', false, 100, null);
        $this->getColumn('NAME', false)->setPrimaryString(true);
        $this->addColumn('SURNAME', 'Surname', 'VARCHAR', false, 100, null);
        $this->getColumn('SURNAME', false)->setPrimaryString(true);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // GuestTableMap

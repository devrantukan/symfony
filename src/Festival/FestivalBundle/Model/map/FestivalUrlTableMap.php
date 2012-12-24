<?php

namespace Festival\FestivalBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'festival_url' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Festival.FestivalBundle.Model.map
 */
class FestivalUrlTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Festival.FestivalBundle.Model.map.FestivalUrlTableMap';

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
        $this->setName('festival_url');
        $this->setPhpName('FestivalUrl');
        $this->setClassname('Festival\\FestivalBundle\\Model\\FestivalUrl');
        $this->setPackage('src.Festival.FestivalBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('URL', 'Url', 'VARCHAR', true, 90, null);
        $this->addForeignKey('FESTIVAL_URL_TYPE_ID', 'FestivalUrlTypeId', 'INTEGER', 'festival_url_type', 'ID', true, null, null);
        $this->addColumn('FESTIVAL_ID', 'FestivalId', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('FestivalUrlType', 'Festival\\FestivalBundle\\Model\\FestivalUrlType', RelationMap::MANY_TO_ONE, array('festival_url_type_id' => 'id', ), null, null);
        $this->addRelation('Festival', 'Festival\\FestivalBundle\\Model\\Festival', RelationMap::ONE_TO_MANY, array('id' => 'festival_url_id', ), null, null, 'Festivals');
    } // buildRelations()

} // FestivalUrlTableMap

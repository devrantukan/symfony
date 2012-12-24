<?php

namespace Festival\FestivalBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'festival' table.
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
class FestivalTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Festival.FestivalBundle.Model.map.FestivalTableMap';

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
        $this->setName('festival');
        $this->setPhpName('Festival');
        $this->setClassname('Festival\\FestivalBundle\\Model\\Festival');
        $this->setPackage('src.Festival.FestivalBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('TYPE_ID', 'TypeId', 'INTEGER', 'festival_type', 'ID', false, null, null);
        $this->addColumn('FESTIVAL_CONTENT_TITLE', 'FestivalContentTitle', 'VARCHAR', true, 45, null);
        $this->addColumn('START_DATE', 'StartDate', 'TIMESTAMP', true, null, null);
        $this->addColumn('END_DATE', 'EndDate', 'TIMESTAMP', true, null, null);
        $this->addForeignKey('FESTIVAL_LOCATION_ID', 'FestivalLocationId', 'INTEGER', 'festival_location', 'ID', false, null, null);
        $this->addForeignKey('FESTIVAL_CONTENT_ID', 'FestivalContentId', 'INTEGER', 'festival_content', 'ID', false, null, null);
        $this->addForeignKey('FESTIVAL_URL_ID', 'FestivalUrlId', 'INTEGER', 'festival_url', 'ID', false, null, null);
        $this->addColumn('SLUG', 'Slug', 'VARCHAR', false, 45, null);
        $this->addColumn('LANG', 'Lang', 'VARCHAR', false, 2, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('FestivalType', 'Festival\\FestivalBundle\\Model\\FestivalType', RelationMap::MANY_TO_ONE, array('type_id' => 'id', ), null, null);
        $this->addRelation('FestivalLocation', 'Festival\\FestivalBundle\\Model\\FestivalLocation', RelationMap::MANY_TO_ONE, array('festival_location_id' => 'id', ), null, null);
        $this->addRelation('FestivalContent', 'Festival\\FestivalBundle\\Model\\FestivalContent', RelationMap::MANY_TO_ONE, array('festival_content_id' => 'id', ), null, null);
        $this->addRelation('FestivalUrl', 'Festival\\FestivalBundle\\Model\\FestivalUrl', RelationMap::MANY_TO_ONE, array('festival_url_id' => 'id', ), null, null);
    } // buildRelations()

} // FestivalTableMap

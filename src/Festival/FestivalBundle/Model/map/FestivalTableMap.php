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
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('festival_type_id', 'FestivalTypeId', 'INTEGER', 'festival_type', 'id', false, null, null);
        $this->addColumn('festival_content_title', 'FestivalContentTitle', 'VARCHAR', true, 45, null);
        $this->addColumn('start_date', 'StartDate', 'TIMESTAMP', true, null, null);
        $this->addColumn('end_date', 'EndDate', 'TIMESTAMP', true, null, null);
        $this->addForeignKey('festival_location_id', 'FestivalLocationId', 'INTEGER', 'festival_location', 'id', false, null, null);
        $this->addForeignKey('festival_content_id', 'FestivalContentId', 'INTEGER', 'festival_content', 'id', false, null, null);
        $this->addForeignKey('festival_url_id', 'FestivalUrlId', 'INTEGER', 'festival_url', 'id', false, null, null);
        $this->addColumn('slug', 'Slug', 'VARCHAR', false, 45, null);
        $this->addColumn('lang', 'Lang', 'VARCHAR', false, 2, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('FestivalType', 'Festival\\FestivalBundle\\Model\\FestivalType', RelationMap::MANY_TO_ONE, array('festival_type_id' => 'id', ), null, null);
        $this->addRelation('FestivalLocation', 'Festival\\FestivalBundle\\Model\\FestivalLocation', RelationMap::MANY_TO_ONE, array('festival_location_id' => 'id', ), null, null);
        $this->addRelation('FestivalContent', 'Festival\\FestivalBundle\\Model\\FestivalContent', RelationMap::MANY_TO_ONE, array('festival_content_id' => 'id', ), null, null);
        $this->addRelation('FestivalUrl', 'Festival\\FestivalBundle\\Model\\FestivalUrl', RelationMap::MANY_TO_ONE, array('festival_url_id' => 'id', ), null, null);
    } // buildRelations()

} // FestivalTableMap

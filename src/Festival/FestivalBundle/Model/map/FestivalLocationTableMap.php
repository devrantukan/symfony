<?php

namespace Festival\FestivalBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'festival_location' table.
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
class FestivalLocationTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Festival.FestivalBundle.Model.map.FestivalLocationTableMap';

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
        $this->setName('festival_location');
        $this->setPhpName('FestivalLocation');
        $this->setClassname('Festival\\FestivalBundle\\Model\\FestivalLocation');
        $this->setPackage('src.Festival.FestivalBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', true, 45, null);
        $this->addColumn('COUNTRY', 'Country', 'VARCHAR', true, 45, null);
        $this->addColumn('STATE', 'State', 'VARCHAR', false, 45, null);
        $this->addColumn('CITY', 'City', 'VARCHAR', true, 45, null);
        $this->addColumn('LATITUDE', 'Latitude', 'VARCHAR', true, 45, null);
        $this->addColumn('LONGTITUDE', 'Longtitude', 'VARCHAR', true, 45, null);
        $this->addForeignKey('FESTIVAL_LOCATION_CONTENT_ID', 'FestivalLocationContentId', 'INTEGER', 'festival_location_content', 'ID', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('FestivalLocationContent', 'Festival\\FestivalBundle\\Model\\FestivalLocationContent', RelationMap::MANY_TO_ONE, array('festival_location_content_id' => 'id', ), null, null);
        $this->addRelation('Festival', 'Festival\\FestivalBundle\\Model\\Festival', RelationMap::ONE_TO_MANY, array('id' => 'festival_location_id', ), null, null, 'Festivals');
    } // buildRelations()

} // FestivalLocationTableMap

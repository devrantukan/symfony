<?php

namespace Festival\FestivalBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'festival_location_content' table.
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
class FestivalLocationContentTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Festival.FestivalBundle.Model.map.FestivalLocationContentTableMap';

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
        $this->setName('festival_location_content');
        $this->setPhpName('FestivalLocationContent');
        $this->setClassname('Festival\\FestivalBundle\\Model\\FestivalLocationContent');
        $this->setPackage('src.Festival.FestivalBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 45, null);
        $this->addColumn('subtitle', 'Subtitle', 'VARCHAR', false, 90, null);
        $this->addColumn('content', 'Content', 'LONGVARCHAR', false, null, null);
        $this->addColumn('user_id', 'UserId', 'INTEGER', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('FestivalLocation', 'Festival\\FestivalBundle\\Model\\FestivalLocation', RelationMap::ONE_TO_MANY, array('id' => 'festival_location_content_id', ), null, null, 'FestivalLocations');
    } // buildRelations()

} // FestivalLocationContentTableMap

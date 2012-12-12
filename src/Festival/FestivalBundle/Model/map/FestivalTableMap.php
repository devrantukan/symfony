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
        $this->addColumn('TITLE', 'Title', 'VARCHAR', false, 100, null);
        $this->getColumn('TITLE', false)->setPrimaryString(true);
        $this->addColumn('SLUG', 'Slug', 'VARCHAR', false, 100, null);
        $this->getColumn('SLUG', false)->setPrimaryString(true);
        $this->addColumn('DESC', 'Desc', 'LONGVARCHAR', false, null, null);
        $this->addColumn('LANG', 'Lang', 'VARCHAR', false, 2, null);
        $this->getColumn('LANG', false)->setPrimaryString(true);
        $this->addColumn('START', 'Start', 'DATE', false, null, null);
        $this->addColumn('END', 'End', 'DATE', false, null, null);
        $this->addColumn('LAT', 'Lat', 'DECIMAL', false, null, null);
        $this->addColumn('LON', 'Lon', 'DECIMAL', false, null, null);
        $this->addColumn('OFFICIAL_SITE_URL', 'OfficialSiteUrl', 'VARCHAR', false, 100, null);
        $this->getColumn('OFFICIAL_SITE_URL', false)->setPrimaryString(true);
        $this->addColumn('FACEBOOK_URL', 'FacebookUrl', 'VARCHAR', false, 100, null);
        $this->getColumn('FACEBOOK_URL', false)->setPrimaryString(true);
        $this->addColumn('TWITTER_URL', 'TwitterUrl', 'VARCHAR', false, 100, null);
        $this->getColumn('TWITTER_URL', false)->setPrimaryString(true);
        $this->addColumn('YOUTUBE_URL', 'YoutubeUrl', 'VARCHAR', false, 100, null);
        $this->getColumn('YOUTUBE_URL', false)->setPrimaryString(true);
        $this->addColumn('WIKIPEDIA_URL', 'WikipediaUrl', 'VARCHAR', false, 100, null);
        $this->getColumn('WIKIPEDIA_URL', false)->setPrimaryString(true);
        $this->addColumn('RSS_URL', 'RssUrl', 'VARCHAR', false, 100, null);
        $this->getColumn('RSS_URL', false)->setPrimaryString(true);
        $this->addColumn('COUNTRY', 'Country', 'VARCHAR', false, 100, null);
        $this->getColumn('COUNTRY', false)->setPrimaryString(true);
        $this->addColumn('LOCATION', 'Location', 'VARCHAR', false, 100, null);
        $this->getColumn('LOCATION', false)->setPrimaryString(true);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // FestivalTableMap

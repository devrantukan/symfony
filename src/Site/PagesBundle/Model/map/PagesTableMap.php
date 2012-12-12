<?php

namespace Site\PagesBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'pages' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Site.PagesBundle.Model.map
 */
class PagesTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Site.PagesBundle.Model.map.PagesTableMap';

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
        $this->setName('pages');
        $this->setPhpName('Pages');
        $this->setClassname('Site\\PagesBundle\\Model\\Pages');
        $this->setPackage('src.Site.PagesBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('MASTER_ID', 'MasterId', 'INTEGER', true, null, null);
        $this->addColumn('TITLE', 'Title', 'VARCHAR', false, 100, null);
        $this->getColumn('TITLE', false)->setPrimaryString(true);
        $this->addColumn('SLUG', 'Slug', 'VARCHAR', false, 100, null);
        $this->getColumn('SLUG', false)->setPrimaryString(true);
        $this->addColumn('CONTENT', 'Content', 'LONGVARCHAR', false, null, null);
        $this->addColumn('LANG', 'Lang', 'VARCHAR', false, 2, null);
        $this->getColumn('LANG', false)->setPrimaryString(true);
        $this->addColumn('IMAGES', 'Images', 'LONGVARCHAR', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // PagesTableMap

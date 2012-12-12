<?php

namespace Festival\FestivalBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Festival\FestivalBundle\Model\Festival;
use Festival\FestivalBundle\Model\FestivalPeer;
use Festival\FestivalBundle\Model\map\FestivalTableMap;

abstract class BaseFestivalPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'festival';

    /** the related Propel class for this table */
    const OM_CLASS = 'Festival\\FestivalBundle\\Model\\Festival';

    /** the related TableMap class for this table */
    const TM_CLASS = 'FestivalTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 17;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 17;

    /** the column name for the ID field */
    const ID = 'festival.ID';

    /** the column name for the TITLE field */
    const TITLE = 'festival.TITLE';

    /** the column name for the SLUG field */
    const SLUG = 'festival.SLUG';

    /** the column name for the DESC field */
    const DESC = 'festival.DESC';

    /** the column name for the LANG field */
    const LANG = 'festival.LANG';

    /** the column name for the START field */
    const START = 'festival.START';

    /** the column name for the END field */
    const END = 'festival.END';

    /** the column name for the LAT field */
    const LAT = 'festival.LAT';

    /** the column name for the LON field */
    const LON = 'festival.LON';

    /** the column name for the OFFICIAL_SITE_URL field */
    const OFFICIAL_SITE_URL = 'festival.OFFICIAL_SITE_URL';

    /** the column name for the FACEBOOK_URL field */
    const FACEBOOK_URL = 'festival.FACEBOOK_URL';

    /** the column name for the TWITTER_URL field */
    const TWITTER_URL = 'festival.TWITTER_URL';

    /** the column name for the YOUTUBE_URL field */
    const YOUTUBE_URL = 'festival.YOUTUBE_URL';

    /** the column name for the WIKIPEDIA_URL field */
    const WIKIPEDIA_URL = 'festival.WIKIPEDIA_URL';

    /** the column name for the RSS_URL field */
    const RSS_URL = 'festival.RSS_URL';

    /** the column name for the COUNTRY field */
    const COUNTRY = 'festival.COUNTRY';

    /** the column name for the LOCATION field */
    const LOCATION = 'festival.LOCATION';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Festival objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Festival[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. FestivalPeer::$fieldNames[FestivalPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Title', 'Slug', 'Desc', 'Lang', 'Start', 'End', 'Lat', 'Lon', 'OfficialSiteUrl', 'FacebookUrl', 'TwitterUrl', 'YoutubeUrl', 'WikipediaUrl', 'RssUrl', 'Country', 'Location', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'title', 'slug', 'desc', 'lang', 'start', 'end', 'lat', 'lon', 'officialSiteUrl', 'facebookUrl', 'twitterUrl', 'youtubeUrl', 'wikipediaUrl', 'rssUrl', 'country', 'location', ),
        BasePeer::TYPE_COLNAME => array (FestivalPeer::ID, FestivalPeer::TITLE, FestivalPeer::SLUG, FestivalPeer::DESC, FestivalPeer::LANG, FestivalPeer::START, FestivalPeer::END, FestivalPeer::LAT, FestivalPeer::LON, FestivalPeer::OFFICIAL_SITE_URL, FestivalPeer::FACEBOOK_URL, FestivalPeer::TWITTER_URL, FestivalPeer::YOUTUBE_URL, FestivalPeer::WIKIPEDIA_URL, FestivalPeer::RSS_URL, FestivalPeer::COUNTRY, FestivalPeer::LOCATION, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'TITLE', 'SLUG', 'DESC', 'LANG', 'START', 'END', 'LAT', 'LON', 'OFFICIAL_SITE_URL', 'FACEBOOK_URL', 'TWITTER_URL', 'YOUTUBE_URL', 'WIKIPEDIA_URL', 'RSS_URL', 'COUNTRY', 'LOCATION', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'title', 'slug', 'desc', 'lang', 'start', 'end', 'lat', 'lon', 'official_site_url', 'facebook_url', 'twitter_url', 'youtube_url', 'wikipedia_url', 'rss_url', 'country', 'location', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. FestivalPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Title' => 1, 'Slug' => 2, 'Desc' => 3, 'Lang' => 4, 'Start' => 5, 'End' => 6, 'Lat' => 7, 'Lon' => 8, 'OfficialSiteUrl' => 9, 'FacebookUrl' => 10, 'TwitterUrl' => 11, 'YoutubeUrl' => 12, 'WikipediaUrl' => 13, 'RssUrl' => 14, 'Country' => 15, 'Location' => 16, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'title' => 1, 'slug' => 2, 'desc' => 3, 'lang' => 4, 'start' => 5, 'end' => 6, 'lat' => 7, 'lon' => 8, 'officialSiteUrl' => 9, 'facebookUrl' => 10, 'twitterUrl' => 11, 'youtubeUrl' => 12, 'wikipediaUrl' => 13, 'rssUrl' => 14, 'country' => 15, 'location' => 16, ),
        BasePeer::TYPE_COLNAME => array (FestivalPeer::ID => 0, FestivalPeer::TITLE => 1, FestivalPeer::SLUG => 2, FestivalPeer::DESC => 3, FestivalPeer::LANG => 4, FestivalPeer::START => 5, FestivalPeer::END => 6, FestivalPeer::LAT => 7, FestivalPeer::LON => 8, FestivalPeer::OFFICIAL_SITE_URL => 9, FestivalPeer::FACEBOOK_URL => 10, FestivalPeer::TWITTER_URL => 11, FestivalPeer::YOUTUBE_URL => 12, FestivalPeer::WIKIPEDIA_URL => 13, FestivalPeer::RSS_URL => 14, FestivalPeer::COUNTRY => 15, FestivalPeer::LOCATION => 16, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'TITLE' => 1, 'SLUG' => 2, 'DESC' => 3, 'LANG' => 4, 'START' => 5, 'END' => 6, 'LAT' => 7, 'LON' => 8, 'OFFICIAL_SITE_URL' => 9, 'FACEBOOK_URL' => 10, 'TWITTER_URL' => 11, 'YOUTUBE_URL' => 12, 'WIKIPEDIA_URL' => 13, 'RSS_URL' => 14, 'COUNTRY' => 15, 'LOCATION' => 16, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'title' => 1, 'slug' => 2, 'desc' => 3, 'lang' => 4, 'start' => 5, 'end' => 6, 'lat' => 7, 'lon' => 8, 'official_site_url' => 9, 'facebook_url' => 10, 'twitter_url' => 11, 'youtube_url' => 12, 'wikipedia_url' => 13, 'rss_url' => 14, 'country' => 15, 'location' => 16, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = FestivalPeer::getFieldNames($toType);
        $key = isset(FestivalPeer::$fieldKeys[$fromType][$name]) ? FestivalPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(FestivalPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, FestivalPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return FestivalPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. FestivalPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(FestivalPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(FestivalPeer::ID);
            $criteria->addSelectColumn(FestivalPeer::TITLE);
            $criteria->addSelectColumn(FestivalPeer::SLUG);
            $criteria->addSelectColumn(FestivalPeer::DESC);
            $criteria->addSelectColumn(FestivalPeer::LANG);
            $criteria->addSelectColumn(FestivalPeer::START);
            $criteria->addSelectColumn(FestivalPeer::END);
            $criteria->addSelectColumn(FestivalPeer::LAT);
            $criteria->addSelectColumn(FestivalPeer::LON);
            $criteria->addSelectColumn(FestivalPeer::OFFICIAL_SITE_URL);
            $criteria->addSelectColumn(FestivalPeer::FACEBOOK_URL);
            $criteria->addSelectColumn(FestivalPeer::TWITTER_URL);
            $criteria->addSelectColumn(FestivalPeer::YOUTUBE_URL);
            $criteria->addSelectColumn(FestivalPeer::WIKIPEDIA_URL);
            $criteria->addSelectColumn(FestivalPeer::RSS_URL);
            $criteria->addSelectColumn(FestivalPeer::COUNTRY);
            $criteria->addSelectColumn(FestivalPeer::LOCATION);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.TITLE');
            $criteria->addSelectColumn($alias . '.SLUG');
            $criteria->addSelectColumn($alias . '.DESC');
            $criteria->addSelectColumn($alias . '.LANG');
            $criteria->addSelectColumn($alias . '.START');
            $criteria->addSelectColumn($alias . '.END');
            $criteria->addSelectColumn($alias . '.LAT');
            $criteria->addSelectColumn($alias . '.LON');
            $criteria->addSelectColumn($alias . '.OFFICIAL_SITE_URL');
            $criteria->addSelectColumn($alias . '.FACEBOOK_URL');
            $criteria->addSelectColumn($alias . '.TWITTER_URL');
            $criteria->addSelectColumn($alias . '.YOUTUBE_URL');
            $criteria->addSelectColumn($alias . '.WIKIPEDIA_URL');
            $criteria->addSelectColumn($alias . '.RSS_URL');
            $criteria->addSelectColumn($alias . '.COUNTRY');
            $criteria->addSelectColumn($alias . '.LOCATION');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(FestivalPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            FestivalPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(FestivalPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(FestivalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 Festival
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = FestivalPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return FestivalPeer::populateObjects(FestivalPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement durirectly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(FestivalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            FestivalPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(FestivalPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param      Festival $obj A Festival object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            FestivalPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A Festival object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Festival) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Festival object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(FestivalPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Festival Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(FestivalPeer::$instances[$key])) {
                return FestivalPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool()
    {
        FestivalPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to festival
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = FestivalPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = FestivalPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = FestivalPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FestivalPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (Festival object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = FestivalPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = FestivalPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + FestivalPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FestivalPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            FestivalPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(FestivalPeer::DATABASE_NAME)->getTable(FestivalPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseFestivalPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseFestivalPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new FestivalTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass()
    {
        return FestivalPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Festival or Criteria object.
     *
     * @param      mixed $values Criteria or Festival object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(FestivalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Festival object
        }

        if ($criteria->containsKey(FestivalPeer::ID) && $criteria->keyContainsValue(FestivalPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FestivalPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(FestivalPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a Festival or Criteria object.
     *
     * @param      mixed $values Criteria or Festival object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(FestivalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(FestivalPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(FestivalPeer::ID);
            $value = $criteria->remove(FestivalPeer::ID);
            if ($value) {
                $selectCriteria->add(FestivalPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(FestivalPeer::TABLE_NAME);
            }

        } else { // $values is Festival object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(FestivalPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the festival table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(FestivalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(FestivalPeer::TABLE_NAME, $con, FestivalPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FestivalPeer::clearInstancePool();
            FestivalPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Festival or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Festival object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(FestivalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            FestivalPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Festival) { // it's a model object
            // invalidate the cache for this single object
            FestivalPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FestivalPeer::DATABASE_NAME);
            $criteria->add(FestivalPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                FestivalPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(FestivalPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            FestivalPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Festival object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Festival $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(FestivalPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(FestivalPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(FestivalPeer::DATABASE_NAME, FestivalPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Festival
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = FestivalPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(FestivalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(FestivalPeer::DATABASE_NAME);
        $criteria->add(FestivalPeer::ID, $pk);

        $v = FestivalPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Festival[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(FestivalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(FestivalPeer::DATABASE_NAME);
            $criteria->add(FestivalPeer::ID, $pks, Criteria::IN);
            $objs = FestivalPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseFestivalPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseFestivalPeer::buildTableMap();


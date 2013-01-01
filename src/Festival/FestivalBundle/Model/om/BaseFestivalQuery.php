<?php

namespace Festival\FestivalBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Festival\FestivalBundle\Model\Festival;
use Festival\FestivalBundle\Model\FestivalContent;
use Festival\FestivalBundle\Model\FestivalLocation;
use Festival\FestivalBundle\Model\FestivalPeer;
use Festival\FestivalBundle\Model\FestivalQuery;
use Festival\FestivalBundle\Model\FestivalType;
use Festival\FestivalBundle\Model\FestivalUrl;

/**
 * @method FestivalQuery orderById($order = Criteria::ASC) Order by the id column
 * @method FestivalQuery orderByFestivalTypeId($order = Criteria::ASC) Order by the festival_type_id column
 * @method FestivalQuery orderByFestivalContentTitle($order = Criteria::ASC) Order by the festival_content_title column
 * @method FestivalQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method FestivalQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method FestivalQuery orderByFestivalLocationId($order = Criteria::ASC) Order by the festival_location_id column
 * @method FestivalQuery orderByFestivalContentId($order = Criteria::ASC) Order by the festival_content_id column
 * @method FestivalQuery orderByFestivalUrlId($order = Criteria::ASC) Order by the festival_url_id column
 * @method FestivalQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method FestivalQuery orderByLang($order = Criteria::ASC) Order by the lang column
 *
 * @method FestivalQuery groupById() Group by the id column
 * @method FestivalQuery groupByFestivalTypeId() Group by the festival_type_id column
 * @method FestivalQuery groupByFestivalContentTitle() Group by the festival_content_title column
 * @method FestivalQuery groupByStartDate() Group by the start_date column
 * @method FestivalQuery groupByEndDate() Group by the end_date column
 * @method FestivalQuery groupByFestivalLocationId() Group by the festival_location_id column
 * @method FestivalQuery groupByFestivalContentId() Group by the festival_content_id column
 * @method FestivalQuery groupByFestivalUrlId() Group by the festival_url_id column
 * @method FestivalQuery groupBySlug() Group by the slug column
 * @method FestivalQuery groupByLang() Group by the lang column
 *
 * @method FestivalQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method FestivalQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method FestivalQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method FestivalQuery leftJoinFestivalType($relationAlias = null) Adds a LEFT JOIN clause to the query using the FestivalType relation
 * @method FestivalQuery rightJoinFestivalType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FestivalType relation
 * @method FestivalQuery innerJoinFestivalType($relationAlias = null) Adds a INNER JOIN clause to the query using the FestivalType relation
 *
 * @method FestivalQuery leftJoinFestivalLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the FestivalLocation relation
 * @method FestivalQuery rightJoinFestivalLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FestivalLocation relation
 * @method FestivalQuery innerJoinFestivalLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the FestivalLocation relation
 *
 * @method FestivalQuery leftJoinFestivalContent($relationAlias = null) Adds a LEFT JOIN clause to the query using the FestivalContent relation
 * @method FestivalQuery rightJoinFestivalContent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FestivalContent relation
 * @method FestivalQuery innerJoinFestivalContent($relationAlias = null) Adds a INNER JOIN clause to the query using the FestivalContent relation
 *
 * @method FestivalQuery leftJoinFestivalUrl($relationAlias = null) Adds a LEFT JOIN clause to the query using the FestivalUrl relation
 * @method FestivalQuery rightJoinFestivalUrl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FestivalUrl relation
 * @method FestivalQuery innerJoinFestivalUrl($relationAlias = null) Adds a INNER JOIN clause to the query using the FestivalUrl relation
 *
 * @method Festival findOne(PropelPDO $con = null) Return the first Festival matching the query
 * @method Festival findOneOrCreate(PropelPDO $con = null) Return the first Festival matching the query, or a new Festival object populated from the query conditions when no match is found
 *
 * @method Festival findOneByFestivalTypeId(int $festival_type_id) Return the first Festival filtered by the festival_type_id column
 * @method Festival findOneByFestivalContentTitle(string $festival_content_title) Return the first Festival filtered by the festival_content_title column
 * @method Festival findOneByStartDate(string $start_date) Return the first Festival filtered by the start_date column
 * @method Festival findOneByEndDate(string $end_date) Return the first Festival filtered by the end_date column
 * @method Festival findOneByFestivalLocationId(int $festival_location_id) Return the first Festival filtered by the festival_location_id column
 * @method Festival findOneByFestivalContentId(int $festival_content_id) Return the first Festival filtered by the festival_content_id column
 * @method Festival findOneByFestivalUrlId(int $festival_url_id) Return the first Festival filtered by the festival_url_id column
 * @method Festival findOneBySlug(string $slug) Return the first Festival filtered by the slug column
 * @method Festival findOneByLang(string $lang) Return the first Festival filtered by the lang column
 *
 * @method array findById(int $id) Return Festival objects filtered by the id column
 * @method array findByFestivalTypeId(int $festival_type_id) Return Festival objects filtered by the festival_type_id column
 * @method array findByFestivalContentTitle(string $festival_content_title) Return Festival objects filtered by the festival_content_title column
 * @method array findByStartDate(string $start_date) Return Festival objects filtered by the start_date column
 * @method array findByEndDate(string $end_date) Return Festival objects filtered by the end_date column
 * @method array findByFestivalLocationId(int $festival_location_id) Return Festival objects filtered by the festival_location_id column
 * @method array findByFestivalContentId(int $festival_content_id) Return Festival objects filtered by the festival_content_id column
 * @method array findByFestivalUrlId(int $festival_url_id) Return Festival objects filtered by the festival_url_id column
 * @method array findBySlug(string $slug) Return Festival objects filtered by the slug column
 * @method array findByLang(string $lang) Return Festival objects filtered by the lang column
 */
abstract class BaseFestivalQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseFestivalQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Festival\\FestivalBundle\\Model\\Festival', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new FestivalQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     FestivalQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return FestivalQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof FestivalQuery) {
            return $criteria;
        }
        $query = new FestivalQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Festival|Festival[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = FestivalPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(FestivalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   Festival A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   Festival A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `festival_type_id`, `festival_content_title`, `start_date`, `end_date`, `festival_location_id`, `festival_content_id`, `festival_url_id`, `slug`, `lang` FROM `festival` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Festival();
            $obj->hydrate($row);
            FestivalPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Festival|Festival[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Festival[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FestivalPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FestivalPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(FestivalPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the festival_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFestivalTypeId(1234); // WHERE festival_type_id = 1234
     * $query->filterByFestivalTypeId(array(12, 34)); // WHERE festival_type_id IN (12, 34)
     * $query->filterByFestivalTypeId(array('min' => 12)); // WHERE festival_type_id > 12
     * </code>
     *
     * @see       filterByFestivalType()
     *
     * @param     mixed $festivalTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByFestivalTypeId($festivalTypeId = null, $comparison = null)
    {
        if (is_array($festivalTypeId)) {
            $useMinMax = false;
            if (isset($festivalTypeId['min'])) {
                $this->addUsingAlias(FestivalPeer::FESTIVAL_TYPE_ID, $festivalTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($festivalTypeId['max'])) {
                $this->addUsingAlias(FestivalPeer::FESTIVAL_TYPE_ID, $festivalTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalPeer::FESTIVAL_TYPE_ID, $festivalTypeId, $comparison);
    }

    /**
     * Filter the query on the festival_content_title column
     *
     * Example usage:
     * <code>
     * $query->filterByFestivalContentTitle('fooValue');   // WHERE festival_content_title = 'fooValue'
     * $query->filterByFestivalContentTitle('%fooValue%'); // WHERE festival_content_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $festivalContentTitle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByFestivalContentTitle($festivalContentTitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($festivalContentTitle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $festivalContentTitle)) {
                $festivalContentTitle = str_replace('*', '%', $festivalContentTitle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalPeer::FESTIVAL_CONTENT_TITLE, $festivalContentTitle, $comparison);
    }

    /**
     * Filter the query on the start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('2011-03-14'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate('now'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate(array('max' => 'yesterday')); // WHERE start_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $startDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(FestivalPeer::START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(FestivalPeer::START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalPeer::START_DATE, $startDate, $comparison);
    }

    /**
     * Filter the query on the end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('2011-03-14'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate('now'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate(array('max' => 'yesterday')); // WHERE end_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $endDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(FestivalPeer::END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(FestivalPeer::END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalPeer::END_DATE, $endDate, $comparison);
    }

    /**
     * Filter the query on the festival_location_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFestivalLocationId(1234); // WHERE festival_location_id = 1234
     * $query->filterByFestivalLocationId(array(12, 34)); // WHERE festival_location_id IN (12, 34)
     * $query->filterByFestivalLocationId(array('min' => 12)); // WHERE festival_location_id > 12
     * </code>
     *
     * @see       filterByFestivalLocation()
     *
     * @param     mixed $festivalLocationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByFestivalLocationId($festivalLocationId = null, $comparison = null)
    {
        if (is_array($festivalLocationId)) {
            $useMinMax = false;
            if (isset($festivalLocationId['min'])) {
                $this->addUsingAlias(FestivalPeer::FESTIVAL_LOCATION_ID, $festivalLocationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($festivalLocationId['max'])) {
                $this->addUsingAlias(FestivalPeer::FESTIVAL_LOCATION_ID, $festivalLocationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalPeer::FESTIVAL_LOCATION_ID, $festivalLocationId, $comparison);
    }

    /**
     * Filter the query on the festival_content_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFestivalContentId(1234); // WHERE festival_content_id = 1234
     * $query->filterByFestivalContentId(array(12, 34)); // WHERE festival_content_id IN (12, 34)
     * $query->filterByFestivalContentId(array('min' => 12)); // WHERE festival_content_id > 12
     * </code>
     *
     * @see       filterByFestivalContent()
     *
     * @param     mixed $festivalContentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByFestivalContentId($festivalContentId = null, $comparison = null)
    {
        if (is_array($festivalContentId)) {
            $useMinMax = false;
            if (isset($festivalContentId['min'])) {
                $this->addUsingAlias(FestivalPeer::FESTIVAL_CONTENT_ID, $festivalContentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($festivalContentId['max'])) {
                $this->addUsingAlias(FestivalPeer::FESTIVAL_CONTENT_ID, $festivalContentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalPeer::FESTIVAL_CONTENT_ID, $festivalContentId, $comparison);
    }

    /**
     * Filter the query on the festival_url_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFestivalUrlId(1234); // WHERE festival_url_id = 1234
     * $query->filterByFestivalUrlId(array(12, 34)); // WHERE festival_url_id IN (12, 34)
     * $query->filterByFestivalUrlId(array('min' => 12)); // WHERE festival_url_id > 12
     * </code>
     *
     * @see       filterByFestivalUrl()
     *
     * @param     mixed $festivalUrlId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByFestivalUrlId($festivalUrlId = null, $comparison = null)
    {
        if (is_array($festivalUrlId)) {
            $useMinMax = false;
            if (isset($festivalUrlId['min'])) {
                $this->addUsingAlias(FestivalPeer::FESTIVAL_URL_ID, $festivalUrlId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($festivalUrlId['max'])) {
                $this->addUsingAlias(FestivalPeer::FESTIVAL_URL_ID, $festivalUrlId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalPeer::FESTIVAL_URL_ID, $festivalUrlId, $comparison);
    }

    /**
     * Filter the query on the slug column
     *
     * Example usage:
     * <code>
     * $query->filterBySlug('fooValue');   // WHERE slug = 'fooValue'
     * $query->filterBySlug('%fooValue%'); // WHERE slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $slug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterBySlug($slug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($slug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $slug)) {
                $slug = str_replace('*', '%', $slug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalPeer::SLUG, $slug, $comparison);
    }

    /**
     * Filter the query on the lang column
     *
     * Example usage:
     * <code>
     * $query->filterByLang('fooValue');   // WHERE lang = 'fooValue'
     * $query->filterByLang('%fooValue%'); // WHERE lang LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lang The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByLang($lang = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lang)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lang)) {
                $lang = str_replace('*', '%', $lang);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalPeer::LANG, $lang, $comparison);
    }

    /**
     * Filter the query by a related FestivalType object
     *
     * @param   FestivalType|PropelObjectCollection $festivalType The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FestivalQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFestivalType($festivalType, $comparison = null)
    {
        if ($festivalType instanceof FestivalType) {
            return $this
                ->addUsingAlias(FestivalPeer::FESTIVAL_TYPE_ID, $festivalType->getId(), $comparison);
        } elseif ($festivalType instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FestivalPeer::FESTIVAL_TYPE_ID, $festivalType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFestivalType() only accepts arguments of type FestivalType or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FestivalType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function joinFestivalType($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FestivalType');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'FestivalType');
        }

        return $this;
    }

    /**
     * Use the FestivalType relation FestivalType object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Festival\FestivalBundle\Model\FestivalTypeQuery A secondary query class using the current class as primary query
     */
    public function useFestivalTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFestivalType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FestivalType', '\Festival\FestivalBundle\Model\FestivalTypeQuery');
    }

    /**
     * Filter the query by a related FestivalLocation object
     *
     * @param   FestivalLocation|PropelObjectCollection $festivalLocation The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FestivalQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFestivalLocation($festivalLocation, $comparison = null)
    {
        if ($festivalLocation instanceof FestivalLocation) {
            return $this
                ->addUsingAlias(FestivalPeer::FESTIVAL_LOCATION_ID, $festivalLocation->getId(), $comparison);
        } elseif ($festivalLocation instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FestivalPeer::FESTIVAL_LOCATION_ID, $festivalLocation->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFestivalLocation() only accepts arguments of type FestivalLocation or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FestivalLocation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function joinFestivalLocation($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FestivalLocation');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'FestivalLocation');
        }

        return $this;
    }

    /**
     * Use the FestivalLocation relation FestivalLocation object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Festival\FestivalBundle\Model\FestivalLocationQuery A secondary query class using the current class as primary query
     */
    public function useFestivalLocationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFestivalLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FestivalLocation', '\Festival\FestivalBundle\Model\FestivalLocationQuery');
    }

    /**
     * Filter the query by a related FestivalContent object
     *
     * @param   FestivalContent|PropelObjectCollection $festivalContent The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FestivalQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFestivalContent($festivalContent, $comparison = null)
    {
        if ($festivalContent instanceof FestivalContent) {
            return $this
                ->addUsingAlias(FestivalPeer::FESTIVAL_CONTENT_ID, $festivalContent->getId(), $comparison);
        } elseif ($festivalContent instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FestivalPeer::FESTIVAL_CONTENT_ID, $festivalContent->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFestivalContent() only accepts arguments of type FestivalContent or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FestivalContent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function joinFestivalContent($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FestivalContent');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'FestivalContent');
        }

        return $this;
    }

    /**
     * Use the FestivalContent relation FestivalContent object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Festival\FestivalBundle\Model\FestivalContentQuery A secondary query class using the current class as primary query
     */
    public function useFestivalContentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFestivalContent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FestivalContent', '\Festival\FestivalBundle\Model\FestivalContentQuery');
    }

    /**
     * Filter the query by a related FestivalUrl object
     *
     * @param   FestivalUrl|PropelObjectCollection $festivalUrl The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FestivalQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFestivalUrl($festivalUrl, $comparison = null)
    {
        if ($festivalUrl instanceof FestivalUrl) {
            return $this
                ->addUsingAlias(FestivalPeer::FESTIVAL_URL_ID, $festivalUrl->getId(), $comparison);
        } elseif ($festivalUrl instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FestivalPeer::FESTIVAL_URL_ID, $festivalUrl->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFestivalUrl() only accepts arguments of type FestivalUrl or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FestivalUrl relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function joinFestivalUrl($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FestivalUrl');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'FestivalUrl');
        }

        return $this;
    }

    /**
     * Use the FestivalUrl relation FestivalUrl object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Festival\FestivalBundle\Model\FestivalUrlQuery A secondary query class using the current class as primary query
     */
    public function useFestivalUrlQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFestivalUrl($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FestivalUrl', '\Festival\FestivalBundle\Model\FestivalUrlQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Festival $festival Object to remove from the list of results
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function prune($festival = null)
    {
        if ($festival) {
            $this->addUsingAlias(FestivalPeer::ID, $festival->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}

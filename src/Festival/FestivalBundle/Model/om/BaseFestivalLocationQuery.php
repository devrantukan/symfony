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
use Festival\FestivalBundle\Model\FestivalLocation;
use Festival\FestivalBundle\Model\FestivalLocationContent;
use Festival\FestivalBundle\Model\FestivalLocationPeer;
use Festival\FestivalBundle\Model\FestivalLocationQuery;

/**
 * @method FestivalLocationQuery orderById($order = Criteria::ASC) Order by the id column
 * @method FestivalLocationQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method FestivalLocationQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method FestivalLocationQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method FestivalLocationQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method FestivalLocationQuery orderByLatitude($order = Criteria::ASC) Order by the latitude column
 * @method FestivalLocationQuery orderByLongtitude($order = Criteria::ASC) Order by the longtitude column
 * @method FestivalLocationQuery orderByFestivalLocationContentId($order = Criteria::ASC) Order by the festival_location_content_id column
 *
 * @method FestivalLocationQuery groupById() Group by the id column
 * @method FestivalLocationQuery groupByName() Group by the name column
 * @method FestivalLocationQuery groupByCountry() Group by the country column
 * @method FestivalLocationQuery groupByState() Group by the state column
 * @method FestivalLocationQuery groupByCity() Group by the city column
 * @method FestivalLocationQuery groupByLatitude() Group by the latitude column
 * @method FestivalLocationQuery groupByLongtitude() Group by the longtitude column
 * @method FestivalLocationQuery groupByFestivalLocationContentId() Group by the festival_location_content_id column
 *
 * @method FestivalLocationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method FestivalLocationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method FestivalLocationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method FestivalLocationQuery leftJoinFestivalLocationContent($relationAlias = null) Adds a LEFT JOIN clause to the query using the FestivalLocationContent relation
 * @method FestivalLocationQuery rightJoinFestivalLocationContent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FestivalLocationContent relation
 * @method FestivalLocationQuery innerJoinFestivalLocationContent($relationAlias = null) Adds a INNER JOIN clause to the query using the FestivalLocationContent relation
 *
 * @method FestivalLocationQuery leftJoinFestival($relationAlias = null) Adds a LEFT JOIN clause to the query using the Festival relation
 * @method FestivalLocationQuery rightJoinFestival($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Festival relation
 * @method FestivalLocationQuery innerJoinFestival($relationAlias = null) Adds a INNER JOIN clause to the query using the Festival relation
 *
 * @method FestivalLocation findOne(PropelPDO $con = null) Return the first FestivalLocation matching the query
 * @method FestivalLocation findOneOrCreate(PropelPDO $con = null) Return the first FestivalLocation matching the query, or a new FestivalLocation object populated from the query conditions when no match is found
 *
 * @method FestivalLocation findOneByName(string $name) Return the first FestivalLocation filtered by the name column
 * @method FestivalLocation findOneByCountry(string $country) Return the first FestivalLocation filtered by the country column
 * @method FestivalLocation findOneByState(string $state) Return the first FestivalLocation filtered by the state column
 * @method FestivalLocation findOneByCity(string $city) Return the first FestivalLocation filtered by the city column
 * @method FestivalLocation findOneByLatitude(string $latitude) Return the first FestivalLocation filtered by the latitude column
 * @method FestivalLocation findOneByLongtitude(string $longtitude) Return the first FestivalLocation filtered by the longtitude column
 * @method FestivalLocation findOneByFestivalLocationContentId(int $festival_location_content_id) Return the first FestivalLocation filtered by the festival_location_content_id column
 *
 * @method array findById(int $id) Return FestivalLocation objects filtered by the id column
 * @method array findByName(string $name) Return FestivalLocation objects filtered by the name column
 * @method array findByCountry(string $country) Return FestivalLocation objects filtered by the country column
 * @method array findByState(string $state) Return FestivalLocation objects filtered by the state column
 * @method array findByCity(string $city) Return FestivalLocation objects filtered by the city column
 * @method array findByLatitude(string $latitude) Return FestivalLocation objects filtered by the latitude column
 * @method array findByLongtitude(string $longtitude) Return FestivalLocation objects filtered by the longtitude column
 * @method array findByFestivalLocationContentId(int $festival_location_content_id) Return FestivalLocation objects filtered by the festival_location_content_id column
 */
abstract class BaseFestivalLocationQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseFestivalLocationQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Festival\\FestivalBundle\\Model\\FestivalLocation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new FestivalLocationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     FestivalLocationQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return FestivalLocationQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof FestivalLocationQuery) {
            return $criteria;
        }
        $query = new FestivalLocationQuery();
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
     * @return   FestivalLocation|FestivalLocation[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = FestivalLocationPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(FestivalLocationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   FestivalLocation A model object, or null if the key is not found
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
     * @return   FestivalLocation A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `country`, `state`, `city`, `latitude`, `longtitude`, `festival_location_content_id` FROM `festival_location` WHERE `id` = :p0';
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
            $obj = new FestivalLocation();
            $obj->hydrate($row);
            FestivalLocationPeer::addInstanceToPool($obj, (string) $key);
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
     * @return FestivalLocation|FestivalLocation[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|FestivalLocation[]|mixed the list of results, formatted by the current formatter
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
     * @return FestivalLocationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FestivalLocationPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return FestivalLocationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FestivalLocationPeer::ID, $keys, Criteria::IN);
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
     * @return FestivalLocationQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(FestivalLocationPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalLocationQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalLocationPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
     * $query->filterByCountry('%fooValue%'); // WHERE country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $country The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalLocationQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($country)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $country)) {
                $country = str_replace('*', '%', $country);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalLocationPeer::COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the state column
     *
     * Example usage:
     * <code>
     * $query->filterByState('fooValue');   // WHERE state = 'fooValue'
     * $query->filterByState('%fooValue%'); // WHERE state LIKE '%fooValue%'
     * </code>
     *
     * @param     string $state The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalLocationQuery The current query, for fluid interface
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($state)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $state)) {
                $state = str_replace('*', '%', $state);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalLocationPeer::STATE, $state, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%'); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalLocationQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $city)) {
                $city = str_replace('*', '%', $city);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalLocationPeer::CITY, $city, $comparison);
    }

    /**
     * Filter the query on the latitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLatitude('fooValue');   // WHERE latitude = 'fooValue'
     * $query->filterByLatitude('%fooValue%'); // WHERE latitude LIKE '%fooValue%'
     * </code>
     *
     * @param     string $latitude The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalLocationQuery The current query, for fluid interface
     */
    public function filterByLatitude($latitude = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($latitude)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $latitude)) {
                $latitude = str_replace('*', '%', $latitude);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalLocationPeer::LATITUDE, $latitude, $comparison);
    }

    /**
     * Filter the query on the longtitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLongtitude('fooValue');   // WHERE longtitude = 'fooValue'
     * $query->filterByLongtitude('%fooValue%'); // WHERE longtitude LIKE '%fooValue%'
     * </code>
     *
     * @param     string $longtitude The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalLocationQuery The current query, for fluid interface
     */
    public function filterByLongtitude($longtitude = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($longtitude)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $longtitude)) {
                $longtitude = str_replace('*', '%', $longtitude);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalLocationPeer::LONGTITUDE, $longtitude, $comparison);
    }

    /**
     * Filter the query on the festival_location_content_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFestivalLocationContentId(1234); // WHERE festival_location_content_id = 1234
     * $query->filterByFestivalLocationContentId(array(12, 34)); // WHERE festival_location_content_id IN (12, 34)
     * $query->filterByFestivalLocationContentId(array('min' => 12)); // WHERE festival_location_content_id > 12
     * </code>
     *
     * @see       filterByFestivalLocationContent()
     *
     * @param     mixed $festivalLocationContentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalLocationQuery The current query, for fluid interface
     */
    public function filterByFestivalLocationContentId($festivalLocationContentId = null, $comparison = null)
    {
        if (is_array($festivalLocationContentId)) {
            $useMinMax = false;
            if (isset($festivalLocationContentId['min'])) {
                $this->addUsingAlias(FestivalLocationPeer::FESTIVAL_LOCATION_CONTENT_ID, $festivalLocationContentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($festivalLocationContentId['max'])) {
                $this->addUsingAlias(FestivalLocationPeer::FESTIVAL_LOCATION_CONTENT_ID, $festivalLocationContentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalLocationPeer::FESTIVAL_LOCATION_CONTENT_ID, $festivalLocationContentId, $comparison);
    }

    /**
     * Filter the query by a related FestivalLocationContent object
     *
     * @param   FestivalLocationContent|PropelObjectCollection $festivalLocationContent The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FestivalLocationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFestivalLocationContent($festivalLocationContent, $comparison = null)
    {
        if ($festivalLocationContent instanceof FestivalLocationContent) {
            return $this
                ->addUsingAlias(FestivalLocationPeer::FESTIVAL_LOCATION_CONTENT_ID, $festivalLocationContent->getId(), $comparison);
        } elseif ($festivalLocationContent instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FestivalLocationPeer::FESTIVAL_LOCATION_CONTENT_ID, $festivalLocationContent->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFestivalLocationContent() only accepts arguments of type FestivalLocationContent or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FestivalLocationContent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return FestivalLocationQuery The current query, for fluid interface
     */
    public function joinFestivalLocationContent($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FestivalLocationContent');

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
            $this->addJoinObject($join, 'FestivalLocationContent');
        }

        return $this;
    }

    /**
     * Use the FestivalLocationContent relation FestivalLocationContent object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Festival\FestivalBundle\Model\FestivalLocationContentQuery A secondary query class using the current class as primary query
     */
    public function useFestivalLocationContentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFestivalLocationContent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FestivalLocationContent', '\Festival\FestivalBundle\Model\FestivalLocationContentQuery');
    }

    /**
     * Filter the query by a related Festival object
     *
     * @param   Festival|PropelObjectCollection $festival  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FestivalLocationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFestival($festival, $comparison = null)
    {
        if ($festival instanceof Festival) {
            return $this
                ->addUsingAlias(FestivalLocationPeer::ID, $festival->getFestivalLocationId(), $comparison);
        } elseif ($festival instanceof PropelObjectCollection) {
            return $this
                ->useFestivalQuery()
                ->filterByPrimaryKeys($festival->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFestival() only accepts arguments of type Festival or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Festival relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return FestivalLocationQuery The current query, for fluid interface
     */
    public function joinFestival($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Festival');

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
            $this->addJoinObject($join, 'Festival');
        }

        return $this;
    }

    /**
     * Use the Festival relation Festival object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Festival\FestivalBundle\Model\FestivalQuery A secondary query class using the current class as primary query
     */
    public function useFestivalQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFestival($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Festival', '\Festival\FestivalBundle\Model\FestivalQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   FestivalLocation $festivalLocation Object to remove from the list of results
     *
     * @return FestivalLocationQuery The current query, for fluid interface
     */
    public function prune($festivalLocation = null)
    {
        if ($festivalLocation) {
            $this->addUsingAlias(FestivalLocationPeer::ID, $festivalLocation->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}

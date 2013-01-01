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
use Festival\FestivalBundle\Model\FestivalUrl;
use Festival\FestivalBundle\Model\FestivalUrlPeer;
use Festival\FestivalBundle\Model\FestivalUrlQuery;
use Festival\FestivalBundle\Model\FestivalUrlType;

/**
 * @method FestivalUrlQuery orderById($order = Criteria::ASC) Order by the id column
 * @method FestivalUrlQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method FestivalUrlQuery orderByFestivalUrlTypeId($order = Criteria::ASC) Order by the festival_url_type_id column
 * @method FestivalUrlQuery orderByFestivalId($order = Criteria::ASC) Order by the festival_id column
 *
 * @method FestivalUrlQuery groupById() Group by the id column
 * @method FestivalUrlQuery groupByUrl() Group by the url column
 * @method FestivalUrlQuery groupByFestivalUrlTypeId() Group by the festival_url_type_id column
 * @method FestivalUrlQuery groupByFestivalId() Group by the festival_id column
 *
 * @method FestivalUrlQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method FestivalUrlQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method FestivalUrlQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method FestivalUrlQuery leftJoinFestivalUrlType($relationAlias = null) Adds a LEFT JOIN clause to the query using the FestivalUrlType relation
 * @method FestivalUrlQuery rightJoinFestivalUrlType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FestivalUrlType relation
 * @method FestivalUrlQuery innerJoinFestivalUrlType($relationAlias = null) Adds a INNER JOIN clause to the query using the FestivalUrlType relation
 *
 * @method FestivalUrlQuery leftJoinFestival($relationAlias = null) Adds a LEFT JOIN clause to the query using the Festival relation
 * @method FestivalUrlQuery rightJoinFestival($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Festival relation
 * @method FestivalUrlQuery innerJoinFestival($relationAlias = null) Adds a INNER JOIN clause to the query using the Festival relation
 *
 * @method FestivalUrl findOne(PropelPDO $con = null) Return the first FestivalUrl matching the query
 * @method FestivalUrl findOneOrCreate(PropelPDO $con = null) Return the first FestivalUrl matching the query, or a new FestivalUrl object populated from the query conditions when no match is found
 *
 * @method FestivalUrl findOneByUrl(string $url) Return the first FestivalUrl filtered by the url column
 * @method FestivalUrl findOneByFestivalUrlTypeId(int $festival_url_type_id) Return the first FestivalUrl filtered by the festival_url_type_id column
 * @method FestivalUrl findOneByFestivalId(int $festival_id) Return the first FestivalUrl filtered by the festival_id column
 *
 * @method array findById(int $id) Return FestivalUrl objects filtered by the id column
 * @method array findByUrl(string $url) Return FestivalUrl objects filtered by the url column
 * @method array findByFestivalUrlTypeId(int $festival_url_type_id) Return FestivalUrl objects filtered by the festival_url_type_id column
 * @method array findByFestivalId(int $festival_id) Return FestivalUrl objects filtered by the festival_id column
 */
abstract class BaseFestivalUrlQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseFestivalUrlQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Festival\\FestivalBundle\\Model\\FestivalUrl', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new FestivalUrlQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     FestivalUrlQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return FestivalUrlQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof FestivalUrlQuery) {
            return $criteria;
        }
        $query = new FestivalUrlQuery();
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
     * @return   FestivalUrl|FestivalUrl[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = FestivalUrlPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(FestivalUrlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   FestivalUrl A model object, or null if the key is not found
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
     * @return   FestivalUrl A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `url`, `festival_url_type_id`, `festival_id` FROM `festival_url` WHERE `id` = :p0';
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
            $obj = new FestivalUrl();
            $obj->hydrate($row);
            FestivalUrlPeer::addInstanceToPool($obj, (string) $key);
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
     * @return FestivalUrl|FestivalUrl[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|FestivalUrl[]|mixed the list of results, formatted by the current formatter
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
     * @return FestivalUrlQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FestivalUrlPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return FestivalUrlQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FestivalUrlPeer::ID, $keys, Criteria::IN);
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
     * @return FestivalUrlQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(FestivalUrlPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%'); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalUrlQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $url)) {
                $url = str_replace('*', '%', $url);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalUrlPeer::URL, $url, $comparison);
    }

    /**
     * Filter the query on the festival_url_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFestivalUrlTypeId(1234); // WHERE festival_url_type_id = 1234
     * $query->filterByFestivalUrlTypeId(array(12, 34)); // WHERE festival_url_type_id IN (12, 34)
     * $query->filterByFestivalUrlTypeId(array('min' => 12)); // WHERE festival_url_type_id > 12
     * </code>
     *
     * @see       filterByFestivalUrlType()
     *
     * @param     mixed $festivalUrlTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalUrlQuery The current query, for fluid interface
     */
    public function filterByFestivalUrlTypeId($festivalUrlTypeId = null, $comparison = null)
    {
        if (is_array($festivalUrlTypeId)) {
            $useMinMax = false;
            if (isset($festivalUrlTypeId['min'])) {
                $this->addUsingAlias(FestivalUrlPeer::FESTIVAL_URL_TYPE_ID, $festivalUrlTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($festivalUrlTypeId['max'])) {
                $this->addUsingAlias(FestivalUrlPeer::FESTIVAL_URL_TYPE_ID, $festivalUrlTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalUrlPeer::FESTIVAL_URL_TYPE_ID, $festivalUrlTypeId, $comparison);
    }

    /**
     * Filter the query on the festival_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFestivalId(1234); // WHERE festival_id = 1234
     * $query->filterByFestivalId(array(12, 34)); // WHERE festival_id IN (12, 34)
     * $query->filterByFestivalId(array('min' => 12)); // WHERE festival_id > 12
     * </code>
     *
     * @param     mixed $festivalId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalUrlQuery The current query, for fluid interface
     */
    public function filterByFestivalId($festivalId = null, $comparison = null)
    {
        if (is_array($festivalId)) {
            $useMinMax = false;
            if (isset($festivalId['min'])) {
                $this->addUsingAlias(FestivalUrlPeer::FESTIVAL_ID, $festivalId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($festivalId['max'])) {
                $this->addUsingAlias(FestivalUrlPeer::FESTIVAL_ID, $festivalId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalUrlPeer::FESTIVAL_ID, $festivalId, $comparison);
    }

    /**
     * Filter the query by a related FestivalUrlType object
     *
     * @param   FestivalUrlType|PropelObjectCollection $festivalUrlType The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FestivalUrlQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFestivalUrlType($festivalUrlType, $comparison = null)
    {
        if ($festivalUrlType instanceof FestivalUrlType) {
            return $this
                ->addUsingAlias(FestivalUrlPeer::FESTIVAL_URL_TYPE_ID, $festivalUrlType->getId(), $comparison);
        } elseif ($festivalUrlType instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FestivalUrlPeer::FESTIVAL_URL_TYPE_ID, $festivalUrlType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFestivalUrlType() only accepts arguments of type FestivalUrlType or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FestivalUrlType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return FestivalUrlQuery The current query, for fluid interface
     */
    public function joinFestivalUrlType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FestivalUrlType');

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
            $this->addJoinObject($join, 'FestivalUrlType');
        }

        return $this;
    }

    /**
     * Use the FestivalUrlType relation FestivalUrlType object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Festival\FestivalBundle\Model\FestivalUrlTypeQuery A secondary query class using the current class as primary query
     */
    public function useFestivalUrlTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFestivalUrlType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FestivalUrlType', '\Festival\FestivalBundle\Model\FestivalUrlTypeQuery');
    }

    /**
     * Filter the query by a related Festival object
     *
     * @param   Festival|PropelObjectCollection $festival  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FestivalUrlQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFestival($festival, $comparison = null)
    {
        if ($festival instanceof Festival) {
            return $this
                ->addUsingAlias(FestivalUrlPeer::ID, $festival->getFestivalUrlId(), $comparison);
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
     * @return FestivalUrlQuery The current query, for fluid interface
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
     * @param   FestivalUrl $festivalUrl Object to remove from the list of results
     *
     * @return FestivalUrlQuery The current query, for fluid interface
     */
    public function prune($festivalUrl = null)
    {
        if ($festivalUrl) {
            $this->addUsingAlias(FestivalUrlPeer::ID, $festivalUrl->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}

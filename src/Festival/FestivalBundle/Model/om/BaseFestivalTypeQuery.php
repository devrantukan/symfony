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
use Festival\FestivalBundle\Model\FestivalType;
use Festival\FestivalBundle\Model\FestivalTypePeer;
use Festival\FestivalBundle\Model\FestivalTypeQuery;

/**
 * @method FestivalTypeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method FestivalTypeQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method FestivalTypeQuery groupById() Group by the id column
 * @method FestivalTypeQuery groupByDescription() Group by the description column
 *
 * @method FestivalTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method FestivalTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method FestivalTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method FestivalTypeQuery leftJoinFestival($relationAlias = null) Adds a LEFT JOIN clause to the query using the Festival relation
 * @method FestivalTypeQuery rightJoinFestival($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Festival relation
 * @method FestivalTypeQuery innerJoinFestival($relationAlias = null) Adds a INNER JOIN clause to the query using the Festival relation
 *
 * @method FestivalType findOne(PropelPDO $con = null) Return the first FestivalType matching the query
 * @method FestivalType findOneOrCreate(PropelPDO $con = null) Return the first FestivalType matching the query, or a new FestivalType object populated from the query conditions when no match is found
 *
 * @method FestivalType findOneByDescription(string $description) Return the first FestivalType filtered by the description column
 *
 * @method array findById(int $id) Return FestivalType objects filtered by the id column
 * @method array findByDescription(string $description) Return FestivalType objects filtered by the description column
 */
abstract class BaseFestivalTypeQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseFestivalTypeQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Festival\\FestivalBundle\\Model\\FestivalType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new FestivalTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     FestivalTypeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return FestivalTypeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof FestivalTypeQuery) {
            return $criteria;
        }
        $query = new FestivalTypeQuery();
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
     * @return   FestivalType|FestivalType[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = FestivalTypePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(FestivalTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   FestivalType A model object, or null if the key is not found
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
     * @return   FestivalType A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `DESCRIPTION` FROM `festival_type` WHERE `ID` = :p0';
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
            $obj = new FestivalType();
            $obj->hydrate($row);
            FestivalTypePeer::addInstanceToPool($obj, (string) $key);
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
     * @return FestivalType|FestivalType[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|FestivalType[]|mixed the list of results, formatted by the current formatter
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
     * @return FestivalTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FestivalTypePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return FestivalTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FestivalTypePeer::ID, $keys, Criteria::IN);
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
     * @return FestivalTypeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(FestivalTypePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalTypeQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalTypePeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related Festival object
     *
     * @param   Festival|PropelObjectCollection $festival  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FestivalTypeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFestival($festival, $comparison = null)
    {
        if ($festival instanceof Festival) {
            return $this
                ->addUsingAlias(FestivalTypePeer::ID, $festival->getTypeId(), $comparison);
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
     * @return FestivalTypeQuery The current query, for fluid interface
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
     * @param   FestivalType $festivalType Object to remove from the list of results
     *
     * @return FestivalTypeQuery The current query, for fluid interface
     */
    public function prune($festivalType = null)
    {
        if ($festivalType) {
            $this->addUsingAlias(FestivalTypePeer::ID, $festivalType->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}

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
use Festival\FestivalBundle\Model\FestivalLocation;
use Festival\FestivalBundle\Model\FestivalLocationContent;
use Festival\FestivalBundle\Model\FestivalLocationContentPeer;
use Festival\FestivalBundle\Model\FestivalLocationContentQuery;

/**
 * @method FestivalLocationContentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method FestivalLocationContentQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method FestivalLocationContentQuery orderBySubtitle($order = Criteria::ASC) Order by the subtitle column
 * @method FestivalLocationContentQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method FestivalLocationContentQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 *
 * @method FestivalLocationContentQuery groupById() Group by the id column
 * @method FestivalLocationContentQuery groupByTitle() Group by the title column
 * @method FestivalLocationContentQuery groupBySubtitle() Group by the subtitle column
 * @method FestivalLocationContentQuery groupByContent() Group by the content column
 * @method FestivalLocationContentQuery groupByUserId() Group by the user_id column
 *
 * @method FestivalLocationContentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method FestivalLocationContentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method FestivalLocationContentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method FestivalLocationContentQuery leftJoinFestivalLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the FestivalLocation relation
 * @method FestivalLocationContentQuery rightJoinFestivalLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FestivalLocation relation
 * @method FestivalLocationContentQuery innerJoinFestivalLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the FestivalLocation relation
 *
 * @method FestivalLocationContent findOne(PropelPDO $con = null) Return the first FestivalLocationContent matching the query
 * @method FestivalLocationContent findOneOrCreate(PropelPDO $con = null) Return the first FestivalLocationContent matching the query, or a new FestivalLocationContent object populated from the query conditions when no match is found
 *
 * @method FestivalLocationContent findOneByTitle(string $title) Return the first FestivalLocationContent filtered by the title column
 * @method FestivalLocationContent findOneBySubtitle(string $subtitle) Return the first FestivalLocationContent filtered by the subtitle column
 * @method FestivalLocationContent findOneByContent(string $content) Return the first FestivalLocationContent filtered by the content column
 * @method FestivalLocationContent findOneByUserId(int $user_id) Return the first FestivalLocationContent filtered by the user_id column
 *
 * @method array findById(int $id) Return FestivalLocationContent objects filtered by the id column
 * @method array findByTitle(string $title) Return FestivalLocationContent objects filtered by the title column
 * @method array findBySubtitle(string $subtitle) Return FestivalLocationContent objects filtered by the subtitle column
 * @method array findByContent(string $content) Return FestivalLocationContent objects filtered by the content column
 * @method array findByUserId(int $user_id) Return FestivalLocationContent objects filtered by the user_id column
 */
abstract class BaseFestivalLocationContentQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseFestivalLocationContentQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Festival\\FestivalBundle\\Model\\FestivalLocationContent', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new FestivalLocationContentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     FestivalLocationContentQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return FestivalLocationContentQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof FestivalLocationContentQuery) {
            return $criteria;
        }
        $query = new FestivalLocationContentQuery();
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
     * @return   FestivalLocationContent|FestivalLocationContent[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = FestivalLocationContentPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(FestivalLocationContentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   FestivalLocationContent A model object, or null if the key is not found
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
     * @return   FestivalLocationContent A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `TITLE`, `SUBTITLE`, `CONTENT`, `USER_ID` FROM `festival_location_content` WHERE `ID` = :p0';
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
            $obj = new FestivalLocationContent();
            $obj->hydrate($row);
            FestivalLocationContentPeer::addInstanceToPool($obj, (string) $key);
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
     * @return FestivalLocationContent|FestivalLocationContent[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|FestivalLocationContent[]|mixed the list of results, formatted by the current formatter
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
     * @return FestivalLocationContentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FestivalLocationContentPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return FestivalLocationContentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FestivalLocationContentPeer::ID, $keys, Criteria::IN);
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
     * @return FestivalLocationContentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(FestivalLocationContentPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalLocationContentQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalLocationContentPeer::TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the subtitle column
     *
     * Example usage:
     * <code>
     * $query->filterBySubtitle('fooValue');   // WHERE subtitle = 'fooValue'
     * $query->filterBySubtitle('%fooValue%'); // WHERE subtitle LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subtitle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalLocationContentQuery The current query, for fluid interface
     */
    public function filterBySubtitle($subtitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subtitle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $subtitle)) {
                $subtitle = str_replace('*', '%', $subtitle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalLocationContentPeer::SUBTITLE, $subtitle, $comparison);
    }

    /**
     * Filter the query on the content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE content = 'fooValue'
     * $query->filterByContent('%fooValue%'); // WHERE content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalLocationContentQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $content)) {
                $content = str_replace('*', '%', $content);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalLocationContentPeer::CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalLocationContentQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(FestivalLocationContentPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(FestivalLocationContentPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalLocationContentPeer::USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query by a related FestivalLocation object
     *
     * @param   FestivalLocation|PropelObjectCollection $festivalLocation  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FestivalLocationContentQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFestivalLocation($festivalLocation, $comparison = null)
    {
        if ($festivalLocation instanceof FestivalLocation) {
            return $this
                ->addUsingAlias(FestivalLocationContentPeer::ID, $festivalLocation->getFestivalLocationContentId(), $comparison);
        } elseif ($festivalLocation instanceof PropelObjectCollection) {
            return $this
                ->useFestivalLocationQuery()
                ->filterByPrimaryKeys($festivalLocation->getPrimaryKeys())
                ->endUse();
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
     * @return FestivalLocationContentQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   FestivalLocationContent $festivalLocationContent Object to remove from the list of results
     *
     * @return FestivalLocationContentQuery The current query, for fluid interface
     */
    public function prune($festivalLocationContent = null)
    {
        if ($festivalLocationContent) {
            $this->addUsingAlias(FestivalLocationContentPeer::ID, $festivalLocationContent->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}

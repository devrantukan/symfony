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
use Festival\FestivalBundle\Model\FestivalContentPeer;
use Festival\FestivalBundle\Model\FestivalContentQuery;

/**
 * @method FestivalContentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method FestivalContentQuery orderByFestivalId($order = Criteria::ASC) Order by the festival_id column
 * @method FestivalContentQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method FestivalContentQuery orderBySubtitle($order = Criteria::ASC) Order by the subtitle column
 * @method FestivalContentQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method FestivalContentQuery orderByMetaKeywords($order = Criteria::ASC) Order by the meta_keywords column
 * @method FestivalContentQuery orderByMetaDescription($order = Criteria::ASC) Order by the meta_description column
 * @method FestivalContentQuery orderByVisitor($order = Criteria::ASC) Order by the visitor column
 * @method FestivalContentQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 *
 * @method FestivalContentQuery groupById() Group by the id column
 * @method FestivalContentQuery groupByFestivalId() Group by the festival_id column
 * @method FestivalContentQuery groupByTitle() Group by the title column
 * @method FestivalContentQuery groupBySubtitle() Group by the subtitle column
 * @method FestivalContentQuery groupByContent() Group by the content column
 * @method FestivalContentQuery groupByMetaKeywords() Group by the meta_keywords column
 * @method FestivalContentQuery groupByMetaDescription() Group by the meta_description column
 * @method FestivalContentQuery groupByVisitor() Group by the visitor column
 * @method FestivalContentQuery groupByUserId() Group by the user_id column
 *
 * @method FestivalContentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method FestivalContentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method FestivalContentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method FestivalContentQuery leftJoinFestival($relationAlias = null) Adds a LEFT JOIN clause to the query using the Festival relation
 * @method FestivalContentQuery rightJoinFestival($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Festival relation
 * @method FestivalContentQuery innerJoinFestival($relationAlias = null) Adds a INNER JOIN clause to the query using the Festival relation
 *
 * @method FestivalContent findOne(PropelPDO $con = null) Return the first FestivalContent matching the query
 * @method FestivalContent findOneOrCreate(PropelPDO $con = null) Return the first FestivalContent matching the query, or a new FestivalContent object populated from the query conditions when no match is found
 *
 * @method FestivalContent findOneByFestivalId(int $festival_id) Return the first FestivalContent filtered by the festival_id column
 * @method FestivalContent findOneByTitle(string $title) Return the first FestivalContent filtered by the title column
 * @method FestivalContent findOneBySubtitle(string $subtitle) Return the first FestivalContent filtered by the subtitle column
 * @method FestivalContent findOneByContent(string $content) Return the first FestivalContent filtered by the content column
 * @method FestivalContent findOneByMetaKeywords(string $meta_keywords) Return the first FestivalContent filtered by the meta_keywords column
 * @method FestivalContent findOneByMetaDescription(string $meta_description) Return the first FestivalContent filtered by the meta_description column
 * @method FestivalContent findOneByVisitor(string $visitor) Return the first FestivalContent filtered by the visitor column
 * @method FestivalContent findOneByUserId(int $user_id) Return the first FestivalContent filtered by the user_id column
 *
 * @method array findById(int $id) Return FestivalContent objects filtered by the id column
 * @method array findByFestivalId(int $festival_id) Return FestivalContent objects filtered by the festival_id column
 * @method array findByTitle(string $title) Return FestivalContent objects filtered by the title column
 * @method array findBySubtitle(string $subtitle) Return FestivalContent objects filtered by the subtitle column
 * @method array findByContent(string $content) Return FestivalContent objects filtered by the content column
 * @method array findByMetaKeywords(string $meta_keywords) Return FestivalContent objects filtered by the meta_keywords column
 * @method array findByMetaDescription(string $meta_description) Return FestivalContent objects filtered by the meta_description column
 * @method array findByVisitor(string $visitor) Return FestivalContent objects filtered by the visitor column
 * @method array findByUserId(int $user_id) Return FestivalContent objects filtered by the user_id column
 */
abstract class BaseFestivalContentQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseFestivalContentQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Festival\\FestivalBundle\\Model\\FestivalContent', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new FestivalContentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     FestivalContentQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return FestivalContentQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof FestivalContentQuery) {
            return $criteria;
        }
        $query = new FestivalContentQuery();
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
     * @return   FestivalContent|FestivalContent[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = FestivalContentPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(FestivalContentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   FestivalContent A model object, or null if the key is not found
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
     * @return   FestivalContent A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `festival_id`, `title`, `subtitle`, `content`, `meta_keywords`, `meta_description`, `visitor`, `user_id` FROM `festival_content` WHERE `id` = :p0';
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
            $obj = new FestivalContent();
            $obj->hydrate($row);
            FestivalContentPeer::addInstanceToPool($obj, (string) $key);
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
     * @return FestivalContent|FestivalContent[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|FestivalContent[]|mixed the list of results, formatted by the current formatter
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
     * @return FestivalContentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FestivalContentPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return FestivalContentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FestivalContentPeer::ID, $keys, Criteria::IN);
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
     * @return FestivalContentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(FestivalContentPeer::ID, $id, $comparison);
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
     * @return FestivalContentQuery The current query, for fluid interface
     */
    public function filterByFestivalId($festivalId = null, $comparison = null)
    {
        if (is_array($festivalId)) {
            $useMinMax = false;
            if (isset($festivalId['min'])) {
                $this->addUsingAlias(FestivalContentPeer::FESTIVAL_ID, $festivalId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($festivalId['max'])) {
                $this->addUsingAlias(FestivalContentPeer::FESTIVAL_ID, $festivalId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalContentPeer::FESTIVAL_ID, $festivalId, $comparison);
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
     * @return FestivalContentQuery The current query, for fluid interface
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

        return $this->addUsingAlias(FestivalContentPeer::TITLE, $title, $comparison);
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
     * @return FestivalContentQuery The current query, for fluid interface
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

        return $this->addUsingAlias(FestivalContentPeer::SUBTITLE, $subtitle, $comparison);
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
     * @return FestivalContentQuery The current query, for fluid interface
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

        return $this->addUsingAlias(FestivalContentPeer::CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the meta_keywords column
     *
     * Example usage:
     * <code>
     * $query->filterByMetaKeywords('fooValue');   // WHERE meta_keywords = 'fooValue'
     * $query->filterByMetaKeywords('%fooValue%'); // WHERE meta_keywords LIKE '%fooValue%'
     * </code>
     *
     * @param     string $metaKeywords The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalContentQuery The current query, for fluid interface
     */
    public function filterByMetaKeywords($metaKeywords = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($metaKeywords)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $metaKeywords)) {
                $metaKeywords = str_replace('*', '%', $metaKeywords);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalContentPeer::META_KEYWORDS, $metaKeywords, $comparison);
    }

    /**
     * Filter the query on the meta_description column
     *
     * Example usage:
     * <code>
     * $query->filterByMetaDescription('fooValue');   // WHERE meta_description = 'fooValue'
     * $query->filterByMetaDescription('%fooValue%'); // WHERE meta_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $metaDescription The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalContentQuery The current query, for fluid interface
     */
    public function filterByMetaDescription($metaDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($metaDescription)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $metaDescription)) {
                $metaDescription = str_replace('*', '%', $metaDescription);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalContentPeer::META_DESCRIPTION, $metaDescription, $comparison);
    }

    /**
     * Filter the query on the visitor column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitor('fooValue');   // WHERE visitor = 'fooValue'
     * $query->filterByVisitor('%fooValue%'); // WHERE visitor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $visitor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalContentQuery The current query, for fluid interface
     */
    public function filterByVisitor($visitor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($visitor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $visitor)) {
                $visitor = str_replace('*', '%', $visitor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalContentPeer::VISITOR, $visitor, $comparison);
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
     * @return FestivalContentQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(FestivalContentPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(FestivalContentPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalContentPeer::USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query by a related Festival object
     *
     * @param   Festival|PropelObjectCollection $festival  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FestivalContentQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFestival($festival, $comparison = null)
    {
        if ($festival instanceof Festival) {
            return $this
                ->addUsingAlias(FestivalContentPeer::ID, $festival->getFestivalContentId(), $comparison);
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
     * @return FestivalContentQuery The current query, for fluid interface
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
     * @param   FestivalContent $festivalContent Object to remove from the list of results
     *
     * @return FestivalContentQuery The current query, for fluid interface
     */
    public function prune($festivalContent = null)
    {
        if ($festivalContent) {
            $this->addUsingAlias(FestivalContentPeer::ID, $festivalContent->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}

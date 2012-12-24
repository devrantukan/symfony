<?php

namespace Site\PagesBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \PDO;
use \Propel;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Site\PagesBundle\Model\Pages;
use Site\PagesBundle\Model\PagesPeer;
use Site\PagesBundle\Model\PagesQuery;

/**
 * @method PagesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PagesQuery orderByMasterId($order = Criteria::ASC) Order by the master_id column
 * @method PagesQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method PagesQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method PagesQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method PagesQuery orderByLang($order = Criteria::ASC) Order by the lang column
 * @method PagesQuery orderByImages($order = Criteria::ASC) Order by the images column
 * @method PagesQuery orderByMetaKeywords($order = Criteria::ASC) Order by the meta_keywords column
 * @method PagesQuery orderByMetaDescription($order = Criteria::ASC) Order by the meta_description column
 *
 * @method PagesQuery groupById() Group by the id column
 * @method PagesQuery groupByMasterId() Group by the master_id column
 * @method PagesQuery groupByTitle() Group by the title column
 * @method PagesQuery groupBySlug() Group by the slug column
 * @method PagesQuery groupByContent() Group by the content column
 * @method PagesQuery groupByLang() Group by the lang column
 * @method PagesQuery groupByImages() Group by the images column
 * @method PagesQuery groupByMetaKeywords() Group by the meta_keywords column
 * @method PagesQuery groupByMetaDescription() Group by the meta_description column
 *
 * @method PagesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PagesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PagesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Pages findOne(PropelPDO $con = null) Return the first Pages matching the query
 * @method Pages findOneOrCreate(PropelPDO $con = null) Return the first Pages matching the query, or a new Pages object populated from the query conditions when no match is found
 *
 * @method Pages findOneByMasterId(int $master_id) Return the first Pages filtered by the master_id column
 * @method Pages findOneByTitle(string $title) Return the first Pages filtered by the title column
 * @method Pages findOneBySlug(string $slug) Return the first Pages filtered by the slug column
 * @method Pages findOneByContent(string $content) Return the first Pages filtered by the content column
 * @method Pages findOneByLang(string $lang) Return the first Pages filtered by the lang column
 * @method Pages findOneByImages(string $images) Return the first Pages filtered by the images column
 * @method Pages findOneByMetaKeywords(string $meta_keywords) Return the first Pages filtered by the meta_keywords column
 * @method Pages findOneByMetaDescription(string $meta_description) Return the first Pages filtered by the meta_description column
 *
 * @method array findById(int $id) Return Pages objects filtered by the id column
 * @method array findByMasterId(int $master_id) Return Pages objects filtered by the master_id column
 * @method array findByTitle(string $title) Return Pages objects filtered by the title column
 * @method array findBySlug(string $slug) Return Pages objects filtered by the slug column
 * @method array findByContent(string $content) Return Pages objects filtered by the content column
 * @method array findByLang(string $lang) Return Pages objects filtered by the lang column
 * @method array findByImages(string $images) Return Pages objects filtered by the images column
 * @method array findByMetaKeywords(string $meta_keywords) Return Pages objects filtered by the meta_keywords column
 * @method array findByMetaDescription(string $meta_description) Return Pages objects filtered by the meta_description column
 */
abstract class BasePagesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePagesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Site\\PagesBundle\\Model\\Pages', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PagesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PagesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PagesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PagesQuery) {
            return $criteria;
        }
        $query = new PagesQuery();
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
     * @return   Pages|Pages[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PagesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PagesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Pages A model object, or null if the key is not found
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
     * @return   Pages A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `MASTER_ID`, `TITLE`, `SLUG`, `CONTENT`, `LANG`, `IMAGES`, `META_KEYWORDS`, `META_DESCRIPTION` FROM `pages` WHERE `ID` = :p0';
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
            $obj = new Pages();
            $obj->hydrate($row);
            PagesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Pages|Pages[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Pages[]|mixed the list of results, formatted by the current formatter
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
     * @return PagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PagesPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PagesPeer::ID, $keys, Criteria::IN);
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
     * @return PagesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PagesPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the master_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMasterId(1234); // WHERE master_id = 1234
     * $query->filterByMasterId(array(12, 34)); // WHERE master_id IN (12, 34)
     * $query->filterByMasterId(array('min' => 12)); // WHERE master_id > 12
     * </code>
     *
     * @param     mixed $masterId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PagesQuery The current query, for fluid interface
     */
    public function filterByMasterId($masterId = null, $comparison = null)
    {
        if (is_array($masterId)) {
            $useMinMax = false;
            if (isset($masterId['min'])) {
                $this->addUsingAlias(PagesPeer::MASTER_ID, $masterId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($masterId['max'])) {
                $this->addUsingAlias(PagesPeer::MASTER_ID, $masterId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagesPeer::MASTER_ID, $masterId, $comparison);
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
     * @return PagesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PagesPeer::TITLE, $title, $comparison);
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
     * @return PagesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PagesPeer::SLUG, $slug, $comparison);
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
     * @return PagesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PagesPeer::CONTENT, $content, $comparison);
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
     * @return PagesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PagesPeer::LANG, $lang, $comparison);
    }

    /**
     * Filter the query on the images column
     *
     * Example usage:
     * <code>
     * $query->filterByImages('fooValue');   // WHERE images = 'fooValue'
     * $query->filterByImages('%fooValue%'); // WHERE images LIKE '%fooValue%'
     * </code>
     *
     * @param     string $images The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PagesQuery The current query, for fluid interface
     */
    public function filterByImages($images = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($images)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $images)) {
                $images = str_replace('*', '%', $images);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PagesPeer::IMAGES, $images, $comparison);
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
     * @return PagesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PagesPeer::META_KEYWORDS, $metaKeywords, $comparison);
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
     * @return PagesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PagesPeer::META_DESCRIPTION, $metaDescription, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Pages $pages Object to remove from the list of results
     *
     * @return PagesQuery The current query, for fluid interface
     */
    public function prune($pages = null)
    {
        if ($pages) {
            $this->addUsingAlias(PagesPeer::ID, $pages->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}

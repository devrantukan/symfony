<?php

namespace Festival\FestivalBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \PDO;
use \Propel;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Festival\FestivalBundle\Model\Festival;
use Festival\FestivalBundle\Model\FestivalPeer;
use Festival\FestivalBundle\Model\FestivalQuery;

/**
 * @method FestivalQuery orderById($order = Criteria::ASC) Order by the id column
 * @method FestivalQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method FestivalQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method FestivalQuery orderByDesc($order = Criteria::ASC) Order by the desc column
 * @method FestivalQuery orderByLang($order = Criteria::ASC) Order by the lang column
 * @method FestivalQuery orderByStart($order = Criteria::ASC) Order by the start column
 * @method FestivalQuery orderByEnd($order = Criteria::ASC) Order by the end column
 * @method FestivalQuery orderByLat($order = Criteria::ASC) Order by the lat column
 * @method FestivalQuery orderByLon($order = Criteria::ASC) Order by the lon column
 * @method FestivalQuery orderByOfficialSiteUrl($order = Criteria::ASC) Order by the official_site_url column
 * @method FestivalQuery orderByFacebookUrl($order = Criteria::ASC) Order by the facebook_url column
 * @method FestivalQuery orderByTwitterUrl($order = Criteria::ASC) Order by the twitter_url column
 * @method FestivalQuery orderByYoutubeUrl($order = Criteria::ASC) Order by the youtube_url column
 * @method FestivalQuery orderByWikipediaUrl($order = Criteria::ASC) Order by the wikipedia_url column
 * @method FestivalQuery orderByRssUrl($order = Criteria::ASC) Order by the rss_url column
 * @method FestivalQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method FestivalQuery orderByLocation($order = Criteria::ASC) Order by the location column
 *
 * @method FestivalQuery groupById() Group by the id column
 * @method FestivalQuery groupByTitle() Group by the title column
 * @method FestivalQuery groupBySlug() Group by the slug column
 * @method FestivalQuery groupByDesc() Group by the desc column
 * @method FestivalQuery groupByLang() Group by the lang column
 * @method FestivalQuery groupByStart() Group by the start column
 * @method FestivalQuery groupByEnd() Group by the end column
 * @method FestivalQuery groupByLat() Group by the lat column
 * @method FestivalQuery groupByLon() Group by the lon column
 * @method FestivalQuery groupByOfficialSiteUrl() Group by the official_site_url column
 * @method FestivalQuery groupByFacebookUrl() Group by the facebook_url column
 * @method FestivalQuery groupByTwitterUrl() Group by the twitter_url column
 * @method FestivalQuery groupByYoutubeUrl() Group by the youtube_url column
 * @method FestivalQuery groupByWikipediaUrl() Group by the wikipedia_url column
 * @method FestivalQuery groupByRssUrl() Group by the rss_url column
 * @method FestivalQuery groupByCountry() Group by the country column
 * @method FestivalQuery groupByLocation() Group by the location column
 *
 * @method FestivalQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method FestivalQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method FestivalQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Festival findOne(PropelPDO $con = null) Return the first Festival matching the query
 * @method Festival findOneOrCreate(PropelPDO $con = null) Return the first Festival matching the query, or a new Festival object populated from the query conditions when no match is found
 *
 * @method Festival findOneByTitle(string $title) Return the first Festival filtered by the title column
 * @method Festival findOneBySlug(string $slug) Return the first Festival filtered by the slug column
 * @method Festival findOneByDesc(string $desc) Return the first Festival filtered by the desc column
 * @method Festival findOneByLang(string $lang) Return the first Festival filtered by the lang column
 * @method Festival findOneByStart(string $start) Return the first Festival filtered by the start column
 * @method Festival findOneByEnd(string $end) Return the first Festival filtered by the end column
 * @method Festival findOneByLat(string $lat) Return the first Festival filtered by the lat column
 * @method Festival findOneByLon(string $lon) Return the first Festival filtered by the lon column
 * @method Festival findOneByOfficialSiteUrl(string $official_site_url) Return the first Festival filtered by the official_site_url column
 * @method Festival findOneByFacebookUrl(string $facebook_url) Return the first Festival filtered by the facebook_url column
 * @method Festival findOneByTwitterUrl(string $twitter_url) Return the first Festival filtered by the twitter_url column
 * @method Festival findOneByYoutubeUrl(string $youtube_url) Return the first Festival filtered by the youtube_url column
 * @method Festival findOneByWikipediaUrl(string $wikipedia_url) Return the first Festival filtered by the wikipedia_url column
 * @method Festival findOneByRssUrl(string $rss_url) Return the first Festival filtered by the rss_url column
 * @method Festival findOneByCountry(string $country) Return the first Festival filtered by the country column
 * @method Festival findOneByLocation(string $location) Return the first Festival filtered by the location column
 *
 * @method array findById(int $id) Return Festival objects filtered by the id column
 * @method array findByTitle(string $title) Return Festival objects filtered by the title column
 * @method array findBySlug(string $slug) Return Festival objects filtered by the slug column
 * @method array findByDesc(string $desc) Return Festival objects filtered by the desc column
 * @method array findByLang(string $lang) Return Festival objects filtered by the lang column
 * @method array findByStart(string $start) Return Festival objects filtered by the start column
 * @method array findByEnd(string $end) Return Festival objects filtered by the end column
 * @method array findByLat(string $lat) Return Festival objects filtered by the lat column
 * @method array findByLon(string $lon) Return Festival objects filtered by the lon column
 * @method array findByOfficialSiteUrl(string $official_site_url) Return Festival objects filtered by the official_site_url column
 * @method array findByFacebookUrl(string $facebook_url) Return Festival objects filtered by the facebook_url column
 * @method array findByTwitterUrl(string $twitter_url) Return Festival objects filtered by the twitter_url column
 * @method array findByYoutubeUrl(string $youtube_url) Return Festival objects filtered by the youtube_url column
 * @method array findByWikipediaUrl(string $wikipedia_url) Return Festival objects filtered by the wikipedia_url column
 * @method array findByRssUrl(string $rss_url) Return Festival objects filtered by the rss_url column
 * @method array findByCountry(string $country) Return Festival objects filtered by the country column
 * @method array findByLocation(string $location) Return Festival objects filtered by the location column
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
        $sql = 'SELECT `ID`, `TITLE`, `SLUG`, `DESC`, `LANG`, `START`, `END`, `LAT`, `LON`, `OFFICIAL_SITE_URL`, `FACEBOOK_URL`, `TWITTER_URL`, `YOUTUBE_URL`, `WIKIPEDIA_URL`, `RSS_URL`, `COUNTRY`, `LOCATION` FROM `festival` WHERE `ID` = :p0';
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
     * @return FestivalQuery The current query, for fluid interface
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

        return $this->addUsingAlias(FestivalPeer::TITLE, $title, $comparison);
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
     * Filter the query on the desc column
     *
     * Example usage:
     * <code>
     * $query->filterByDesc('fooValue');   // WHERE desc = 'fooValue'
     * $query->filterByDesc('%fooValue%'); // WHERE desc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $desc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByDesc($desc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($desc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $desc)) {
                $desc = str_replace('*', '%', $desc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalPeer::DESC, $desc, $comparison);
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
     * Filter the query on the start column
     *
     * Example usage:
     * <code>
     * $query->filterByStart('2011-03-14'); // WHERE start = '2011-03-14'
     * $query->filterByStart('now'); // WHERE start = '2011-03-14'
     * $query->filterByStart(array('max' => 'yesterday')); // WHERE start > '2011-03-13'
     * </code>
     *
     * @param     mixed $start The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByStart($start = null, $comparison = null)
    {
        if (is_array($start)) {
            $useMinMax = false;
            if (isset($start['min'])) {
                $this->addUsingAlias(FestivalPeer::START, $start['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($start['max'])) {
                $this->addUsingAlias(FestivalPeer::START, $start['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalPeer::START, $start, $comparison);
    }

    /**
     * Filter the query on the end column
     *
     * Example usage:
     * <code>
     * $query->filterByEnd('2011-03-14'); // WHERE end = '2011-03-14'
     * $query->filterByEnd('now'); // WHERE end = '2011-03-14'
     * $query->filterByEnd(array('max' => 'yesterday')); // WHERE end > '2011-03-13'
     * </code>
     *
     * @param     mixed $end The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByEnd($end = null, $comparison = null)
    {
        if (is_array($end)) {
            $useMinMax = false;
            if (isset($end['min'])) {
                $this->addUsingAlias(FestivalPeer::END, $end['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($end['max'])) {
                $this->addUsingAlias(FestivalPeer::END, $end['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalPeer::END, $end, $comparison);
    }

    /**
     * Filter the query on the lat column
     *
     * Example usage:
     * <code>
     * $query->filterByLat(1234); // WHERE lat = 1234
     * $query->filterByLat(array(12, 34)); // WHERE lat IN (12, 34)
     * $query->filterByLat(array('min' => 12)); // WHERE lat > 12
     * </code>
     *
     * @param     mixed $lat The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByLat($lat = null, $comparison = null)
    {
        if (is_array($lat)) {
            $useMinMax = false;
            if (isset($lat['min'])) {
                $this->addUsingAlias(FestivalPeer::LAT, $lat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lat['max'])) {
                $this->addUsingAlias(FestivalPeer::LAT, $lat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalPeer::LAT, $lat, $comparison);
    }

    /**
     * Filter the query on the lon column
     *
     * Example usage:
     * <code>
     * $query->filterByLon(1234); // WHERE lon = 1234
     * $query->filterByLon(array(12, 34)); // WHERE lon IN (12, 34)
     * $query->filterByLon(array('min' => 12)); // WHERE lon > 12
     * </code>
     *
     * @param     mixed $lon The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByLon($lon = null, $comparison = null)
    {
        if (is_array($lon)) {
            $useMinMax = false;
            if (isset($lon['min'])) {
                $this->addUsingAlias(FestivalPeer::LON, $lon['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lon['max'])) {
                $this->addUsingAlias(FestivalPeer::LON, $lon['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FestivalPeer::LON, $lon, $comparison);
    }

    /**
     * Filter the query on the official_site_url column
     *
     * Example usage:
     * <code>
     * $query->filterByOfficialSiteUrl('fooValue');   // WHERE official_site_url = 'fooValue'
     * $query->filterByOfficialSiteUrl('%fooValue%'); // WHERE official_site_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $officialSiteUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByOfficialSiteUrl($officialSiteUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($officialSiteUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $officialSiteUrl)) {
                $officialSiteUrl = str_replace('*', '%', $officialSiteUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalPeer::OFFICIAL_SITE_URL, $officialSiteUrl, $comparison);
    }

    /**
     * Filter the query on the facebook_url column
     *
     * Example usage:
     * <code>
     * $query->filterByFacebookUrl('fooValue');   // WHERE facebook_url = 'fooValue'
     * $query->filterByFacebookUrl('%fooValue%'); // WHERE facebook_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $facebookUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByFacebookUrl($facebookUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($facebookUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $facebookUrl)) {
                $facebookUrl = str_replace('*', '%', $facebookUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalPeer::FACEBOOK_URL, $facebookUrl, $comparison);
    }

    /**
     * Filter the query on the twitter_url column
     *
     * Example usage:
     * <code>
     * $query->filterByTwitterUrl('fooValue');   // WHERE twitter_url = 'fooValue'
     * $query->filterByTwitterUrl('%fooValue%'); // WHERE twitter_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $twitterUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByTwitterUrl($twitterUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($twitterUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $twitterUrl)) {
                $twitterUrl = str_replace('*', '%', $twitterUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalPeer::TWITTER_URL, $twitterUrl, $comparison);
    }

    /**
     * Filter the query on the youtube_url column
     *
     * Example usage:
     * <code>
     * $query->filterByYoutubeUrl('fooValue');   // WHERE youtube_url = 'fooValue'
     * $query->filterByYoutubeUrl('%fooValue%'); // WHERE youtube_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $youtubeUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByYoutubeUrl($youtubeUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($youtubeUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $youtubeUrl)) {
                $youtubeUrl = str_replace('*', '%', $youtubeUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalPeer::YOUTUBE_URL, $youtubeUrl, $comparison);
    }

    /**
     * Filter the query on the wikipedia_url column
     *
     * Example usage:
     * <code>
     * $query->filterByWikipediaUrl('fooValue');   // WHERE wikipedia_url = 'fooValue'
     * $query->filterByWikipediaUrl('%fooValue%'); // WHERE wikipedia_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $wikipediaUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByWikipediaUrl($wikipediaUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wikipediaUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $wikipediaUrl)) {
                $wikipediaUrl = str_replace('*', '%', $wikipediaUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalPeer::WIKIPEDIA_URL, $wikipediaUrl, $comparison);
    }

    /**
     * Filter the query on the rss_url column
     *
     * Example usage:
     * <code>
     * $query->filterByRssUrl('fooValue');   // WHERE rss_url = 'fooValue'
     * $query->filterByRssUrl('%fooValue%'); // WHERE rss_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rssUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByRssUrl($rssUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rssUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rssUrl)) {
                $rssUrl = str_replace('*', '%', $rssUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalPeer::RSS_URL, $rssUrl, $comparison);
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
     * @return FestivalQuery The current query, for fluid interface
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

        return $this->addUsingAlias(FestivalPeer::COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the location column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation('fooValue');   // WHERE location = 'fooValue'
     * $query->filterByLocation('%fooValue%'); // WHERE location LIKE '%fooValue%'
     * </code>
     *
     * @param     string $location The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FestivalQuery The current query, for fluid interface
     */
    public function filterByLocation($location = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $location)) {
                $location = str_replace('*', '%', $location);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FestivalPeer::LOCATION, $location, $comparison);
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

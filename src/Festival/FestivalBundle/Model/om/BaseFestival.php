<?php

namespace Festival\FestivalBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelDateTime;
use \PropelException;
use \PropelPDO;
use Festival\FestivalBundle\Model\Festival;
use Festival\FestivalBundle\Model\FestivalPeer;
use Festival\FestivalBundle\Model\FestivalQuery;

abstract class BaseFestival extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Festival\\FestivalBundle\\Model\\FestivalPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        FestivalPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the title field.
     * @var        string
     */
    protected $title;

    /**
     * The value for the slug field.
     * @var        string
     */
    protected $slug;

    /**
     * The value for the desc field.
     * @var        string
     */
    protected $desc;

    /**
     * The value for the lang field.
     * @var        string
     */
    protected $lang;

    /**
     * The value for the start field.
     * @var        string
     */
    protected $start;

    /**
     * The value for the end field.
     * @var        string
     */
    protected $end;

    /**
     * The value for the lat field.
     * @var        string
     */
    protected $lat;

    /**
     * The value for the lon field.
     * @var        string
     */
    protected $lon;

    /**
     * The value for the official_site_url field.
     * @var        string
     */
    protected $official_site_url;

    /**
     * The value for the facebook_url field.
     * @var        string
     */
    protected $facebook_url;

    /**
     * The value for the twitter_url field.
     * @var        string
     */
    protected $twitter_url;

    /**
     * The value for the youtube_url field.
     * @var        string
     */
    protected $youtube_url;

    /**
     * The value for the wikipedia_url field.
     * @var        string
     */
    protected $wikipedia_url;

    /**
     * The value for the rss_url field.
     * @var        string
     */
    protected $rss_url;

    /**
     * The value for the country field.
     * @var        string
     */
    protected $country;

    /**
     * The value for the location field.
     * @var        string
     */
    protected $location;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [slug] column value.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the [desc] column value.
     *
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * Get the [lang] column value.
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Get the [optionally formatted] temporal [start] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getStart($format = null)
    {
        if ($this->start === null) {
            return null;
        }

        if ($this->start === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->start);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->start, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [optionally formatted] temporal [end] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getEnd($format = null)
    {
        if ($this->end === null) {
            return null;
        }

        if ($this->end === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->end);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->end, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [lat] column value.
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Get the [lon] column value.
     *
     * @return string
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Get the [official_site_url] column value.
     *
     * @return string
     */
    public function getOfficialSiteUrl()
    {
        return $this->official_site_url;
    }

    /**
     * Get the [facebook_url] column value.
     *
     * @return string
     */
    public function getFacebookUrl()
    {
        return $this->facebook_url;
    }

    /**
     * Get the [twitter_url] column value.
     *
     * @return string
     */
    public function getTwitterUrl()
    {
        return $this->twitter_url;
    }

    /**
     * Get the [youtube_url] column value.
     *
     * @return string
     */
    public function getYoutubeUrl()
    {
        return $this->youtube_url;
    }

    /**
     * Get the [wikipedia_url] column value.
     *
     * @return string
     */
    public function getWikipediaUrl()
    {
        return $this->wikipedia_url;
    }

    /**
     * Get the [rss_url] column value.
     *
     * @return string
     */
    public function getRssUrl()
    {
        return $this->rss_url;
    }

    /**
     * Get the [country] column value.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the [location] column value.
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = FestivalPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[] = FestivalPeer::TITLE;
        }


        return $this;
    } // setTitle()

    /**
     * Set the value of [slug] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->slug !== $v) {
            $this->slug = $v;
            $this->modifiedColumns[] = FestivalPeer::SLUG;
        }


        return $this;
    } // setSlug()

    /**
     * Set the value of [desc] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setDesc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->desc !== $v) {
            $this->desc = $v;
            $this->modifiedColumns[] = FestivalPeer::DESC;
        }


        return $this;
    } // setDesc()

    /**
     * Set the value of [lang] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setLang($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lang !== $v) {
            $this->lang = $v;
            $this->modifiedColumns[] = FestivalPeer::LANG;
        }


        return $this;
    } // setLang()

    /**
     * Sets the value of [start] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Festival The current object (for fluent API support)
     */
    public function setStart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->start !== null || $dt !== null) {
            $currentDateAsString = ($this->start !== null && $tmpDt = new DateTime($this->start)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->start = $newDateAsString;
                $this->modifiedColumns[] = FestivalPeer::START;
            }
        } // if either are not null


        return $this;
    } // setStart()

    /**
     * Sets the value of [end] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Festival The current object (for fluent API support)
     */
    public function setEnd($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->end !== null || $dt !== null) {
            $currentDateAsString = ($this->end !== null && $tmpDt = new DateTime($this->end)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->end = $newDateAsString;
                $this->modifiedColumns[] = FestivalPeer::END;
            }
        } // if either are not null


        return $this;
    } // setEnd()

    /**
     * Set the value of [lat] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setLat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lat !== $v) {
            $this->lat = $v;
            $this->modifiedColumns[] = FestivalPeer::LAT;
        }


        return $this;
    } // setLat()

    /**
     * Set the value of [lon] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setLon($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lon !== $v) {
            $this->lon = $v;
            $this->modifiedColumns[] = FestivalPeer::LON;
        }


        return $this;
    } // setLon()

    /**
     * Set the value of [official_site_url] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setOfficialSiteUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->official_site_url !== $v) {
            $this->official_site_url = $v;
            $this->modifiedColumns[] = FestivalPeer::OFFICIAL_SITE_URL;
        }


        return $this;
    } // setOfficialSiteUrl()

    /**
     * Set the value of [facebook_url] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setFacebookUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->facebook_url !== $v) {
            $this->facebook_url = $v;
            $this->modifiedColumns[] = FestivalPeer::FACEBOOK_URL;
        }


        return $this;
    } // setFacebookUrl()

    /**
     * Set the value of [twitter_url] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setTwitterUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->twitter_url !== $v) {
            $this->twitter_url = $v;
            $this->modifiedColumns[] = FestivalPeer::TWITTER_URL;
        }


        return $this;
    } // setTwitterUrl()

    /**
     * Set the value of [youtube_url] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setYoutubeUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->youtube_url !== $v) {
            $this->youtube_url = $v;
            $this->modifiedColumns[] = FestivalPeer::YOUTUBE_URL;
        }


        return $this;
    } // setYoutubeUrl()

    /**
     * Set the value of [wikipedia_url] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setWikipediaUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wikipedia_url !== $v) {
            $this->wikipedia_url = $v;
            $this->modifiedColumns[] = FestivalPeer::WIKIPEDIA_URL;
        }


        return $this;
    } // setWikipediaUrl()

    /**
     * Set the value of [rss_url] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setRssUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rss_url !== $v) {
            $this->rss_url = $v;
            $this->modifiedColumns[] = FestivalPeer::RSS_URL;
        }


        return $this;
    } // setRssUrl()

    /**
     * Set the value of [country] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country !== $v) {
            $this->country = $v;
            $this->modifiedColumns[] = FestivalPeer::COUNTRY;
        }


        return $this;
    } // setCountry()

    /**
     * Set the value of [location] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setLocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->location !== $v) {
            $this->location = $v;
            $this->modifiedColumns[] = FestivalPeer::LOCATION;
        }


        return $this;
    } // setLocation()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->slug = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->desc = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->lang = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->start = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->end = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->lat = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->lon = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->official_site_url = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->facebook_url = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->twitter_url = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->youtube_url = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->wikipedia_url = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->rss_url = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->country = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->location = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = FestivalPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Festival object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(FestivalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = FestivalPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(FestivalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = FestivalQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(FestivalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                FestivalPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = FestivalPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FestivalPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FestivalPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(FestivalPeer::TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`TITLE`';
        }
        if ($this->isColumnModified(FestivalPeer::SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`SLUG`';
        }
        if ($this->isColumnModified(FestivalPeer::DESC)) {
            $modifiedColumns[':p' . $index++]  = '`DESC`';
        }
        if ($this->isColumnModified(FestivalPeer::LANG)) {
            $modifiedColumns[':p' . $index++]  = '`LANG`';
        }
        if ($this->isColumnModified(FestivalPeer::START)) {
            $modifiedColumns[':p' . $index++]  = '`START`';
        }
        if ($this->isColumnModified(FestivalPeer::END)) {
            $modifiedColumns[':p' . $index++]  = '`END`';
        }
        if ($this->isColumnModified(FestivalPeer::LAT)) {
            $modifiedColumns[':p' . $index++]  = '`LAT`';
        }
        if ($this->isColumnModified(FestivalPeer::LON)) {
            $modifiedColumns[':p' . $index++]  = '`LON`';
        }
        if ($this->isColumnModified(FestivalPeer::OFFICIAL_SITE_URL)) {
            $modifiedColumns[':p' . $index++]  = '`OFFICIAL_SITE_URL`';
        }
        if ($this->isColumnModified(FestivalPeer::FACEBOOK_URL)) {
            $modifiedColumns[':p' . $index++]  = '`FACEBOOK_URL`';
        }
        if ($this->isColumnModified(FestivalPeer::TWITTER_URL)) {
            $modifiedColumns[':p' . $index++]  = '`TWITTER_URL`';
        }
        if ($this->isColumnModified(FestivalPeer::YOUTUBE_URL)) {
            $modifiedColumns[':p' . $index++]  = '`YOUTUBE_URL`';
        }
        if ($this->isColumnModified(FestivalPeer::WIKIPEDIA_URL)) {
            $modifiedColumns[':p' . $index++]  = '`WIKIPEDIA_URL`';
        }
        if ($this->isColumnModified(FestivalPeer::RSS_URL)) {
            $modifiedColumns[':p' . $index++]  = '`RSS_URL`';
        }
        if ($this->isColumnModified(FestivalPeer::COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`COUNTRY`';
        }
        if ($this->isColumnModified(FestivalPeer::LOCATION)) {
            $modifiedColumns[':p' . $index++]  = '`LOCATION`';
        }

        $sql = sprintf(
            'INSERT INTO `festival` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`ID`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`TITLE`':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case '`SLUG`':
                        $stmt->bindValue($identifier, $this->slug, PDO::PARAM_STR);
                        break;
                    case '`DESC`':
                        $stmt->bindValue($identifier, $this->desc, PDO::PARAM_STR);
                        break;
                    case '`LANG`':
                        $stmt->bindValue($identifier, $this->lang, PDO::PARAM_STR);
                        break;
                    case '`START`':
                        $stmt->bindValue($identifier, $this->start, PDO::PARAM_STR);
                        break;
                    case '`END`':
                        $stmt->bindValue($identifier, $this->end, PDO::PARAM_STR);
                        break;
                    case '`LAT`':
                        $stmt->bindValue($identifier, $this->lat, PDO::PARAM_STR);
                        break;
                    case '`LON`':
                        $stmt->bindValue($identifier, $this->lon, PDO::PARAM_STR);
                        break;
                    case '`OFFICIAL_SITE_URL`':
                        $stmt->bindValue($identifier, $this->official_site_url, PDO::PARAM_STR);
                        break;
                    case '`FACEBOOK_URL`':
                        $stmt->bindValue($identifier, $this->facebook_url, PDO::PARAM_STR);
                        break;
                    case '`TWITTER_URL`':
                        $stmt->bindValue($identifier, $this->twitter_url, PDO::PARAM_STR);
                        break;
                    case '`YOUTUBE_URL`':
                        $stmt->bindValue($identifier, $this->youtube_url, PDO::PARAM_STR);
                        break;
                    case '`WIKIPEDIA_URL`':
                        $stmt->bindValue($identifier, $this->wikipedia_url, PDO::PARAM_STR);
                        break;
                    case '`RSS_URL`':
                        $stmt->bindValue($identifier, $this->rss_url, PDO::PARAM_STR);
                        break;
                    case '`COUNTRY`':
                        $stmt->bindValue($identifier, $this->country, PDO::PARAM_STR);
                        break;
                    case '`LOCATION`':
                        $stmt->bindValue($identifier, $this->location, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        } else {
            $this->validationFailures = $res;

            return false;
        }
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = FestivalPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }



            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = FestivalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getTitle();
                break;
            case 2:
                return $this->getSlug();
                break;
            case 3:
                return $this->getDesc();
                break;
            case 4:
                return $this->getLang();
                break;
            case 5:
                return $this->getStart();
                break;
            case 6:
                return $this->getEnd();
                break;
            case 7:
                return $this->getLat();
                break;
            case 8:
                return $this->getLon();
                break;
            case 9:
                return $this->getOfficialSiteUrl();
                break;
            case 10:
                return $this->getFacebookUrl();
                break;
            case 11:
                return $this->getTwitterUrl();
                break;
            case 12:
                return $this->getYoutubeUrl();
                break;
            case 13:
                return $this->getWikipediaUrl();
                break;
            case 14:
                return $this->getRssUrl();
                break;
            case 15:
                return $this->getCountry();
                break;
            case 16:
                return $this->getLocation();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {
        if (isset($alreadyDumpedObjects['Festival'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Festival'][$this->getPrimaryKey()] = true;
        $keys = FestivalPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getSlug(),
            $keys[3] => $this->getDesc(),
            $keys[4] => $this->getLang(),
            $keys[5] => $this->getStart(),
            $keys[6] => $this->getEnd(),
            $keys[7] => $this->getLat(),
            $keys[8] => $this->getLon(),
            $keys[9] => $this->getOfficialSiteUrl(),
            $keys[10] => $this->getFacebookUrl(),
            $keys[11] => $this->getTwitterUrl(),
            $keys[12] => $this->getYoutubeUrl(),
            $keys[13] => $this->getWikipediaUrl(),
            $keys[14] => $this->getRssUrl(),
            $keys[15] => $this->getCountry(),
            $keys[16] => $this->getLocation(),
        );

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = FestivalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setTitle($value);
                break;
            case 2:
                $this->setSlug($value);
                break;
            case 3:
                $this->setDesc($value);
                break;
            case 4:
                $this->setLang($value);
                break;
            case 5:
                $this->setStart($value);
                break;
            case 6:
                $this->setEnd($value);
                break;
            case 7:
                $this->setLat($value);
                break;
            case 8:
                $this->setLon($value);
                break;
            case 9:
                $this->setOfficialSiteUrl($value);
                break;
            case 10:
                $this->setFacebookUrl($value);
                break;
            case 11:
                $this->setTwitterUrl($value);
                break;
            case 12:
                $this->setYoutubeUrl($value);
                break;
            case 13:
                $this->setWikipediaUrl($value);
                break;
            case 14:
                $this->setRssUrl($value);
                break;
            case 15:
                $this->setCountry($value);
                break;
            case 16:
                $this->setLocation($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = FestivalPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSlug($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setDesc($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setLang($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setStart($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setEnd($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setLat($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setLon($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setOfficialSiteUrl($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setFacebookUrl($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setTwitterUrl($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setYoutubeUrl($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setWikipediaUrl($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setRssUrl($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setCountry($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setLocation($arr[$keys[16]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(FestivalPeer::DATABASE_NAME);

        if ($this->isColumnModified(FestivalPeer::ID)) $criteria->add(FestivalPeer::ID, $this->id);
        if ($this->isColumnModified(FestivalPeer::TITLE)) $criteria->add(FestivalPeer::TITLE, $this->title);
        if ($this->isColumnModified(FestivalPeer::SLUG)) $criteria->add(FestivalPeer::SLUG, $this->slug);
        if ($this->isColumnModified(FestivalPeer::DESC)) $criteria->add(FestivalPeer::DESC, $this->desc);
        if ($this->isColumnModified(FestivalPeer::LANG)) $criteria->add(FestivalPeer::LANG, $this->lang);
        if ($this->isColumnModified(FestivalPeer::START)) $criteria->add(FestivalPeer::START, $this->start);
        if ($this->isColumnModified(FestivalPeer::END)) $criteria->add(FestivalPeer::END, $this->end);
        if ($this->isColumnModified(FestivalPeer::LAT)) $criteria->add(FestivalPeer::LAT, $this->lat);
        if ($this->isColumnModified(FestivalPeer::LON)) $criteria->add(FestivalPeer::LON, $this->lon);
        if ($this->isColumnModified(FestivalPeer::OFFICIAL_SITE_URL)) $criteria->add(FestivalPeer::OFFICIAL_SITE_URL, $this->official_site_url);
        if ($this->isColumnModified(FestivalPeer::FACEBOOK_URL)) $criteria->add(FestivalPeer::FACEBOOK_URL, $this->facebook_url);
        if ($this->isColumnModified(FestivalPeer::TWITTER_URL)) $criteria->add(FestivalPeer::TWITTER_URL, $this->twitter_url);
        if ($this->isColumnModified(FestivalPeer::YOUTUBE_URL)) $criteria->add(FestivalPeer::YOUTUBE_URL, $this->youtube_url);
        if ($this->isColumnModified(FestivalPeer::WIKIPEDIA_URL)) $criteria->add(FestivalPeer::WIKIPEDIA_URL, $this->wikipedia_url);
        if ($this->isColumnModified(FestivalPeer::RSS_URL)) $criteria->add(FestivalPeer::RSS_URL, $this->rss_url);
        if ($this->isColumnModified(FestivalPeer::COUNTRY)) $criteria->add(FestivalPeer::COUNTRY, $this->country);
        if ($this->isColumnModified(FestivalPeer::LOCATION)) $criteria->add(FestivalPeer::LOCATION, $this->location);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(FestivalPeer::DATABASE_NAME);
        $criteria->add(FestivalPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Festival (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitle($this->getTitle());
        $copyObj->setSlug($this->getSlug());
        $copyObj->setDesc($this->getDesc());
        $copyObj->setLang($this->getLang());
        $copyObj->setStart($this->getStart());
        $copyObj->setEnd($this->getEnd());
        $copyObj->setLat($this->getLat());
        $copyObj->setLon($this->getLon());
        $copyObj->setOfficialSiteUrl($this->getOfficialSiteUrl());
        $copyObj->setFacebookUrl($this->getFacebookUrl());
        $copyObj->setTwitterUrl($this->getTwitterUrl());
        $copyObj->setYoutubeUrl($this->getYoutubeUrl());
        $copyObj->setWikipediaUrl($this->getWikipediaUrl());
        $copyObj->setRssUrl($this->getRssUrl());
        $copyObj->setCountry($this->getCountry());
        $copyObj->setLocation($this->getLocation());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Festival Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return FestivalPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new FestivalPeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->title = null;
        $this->slug = null;
        $this->desc = null;
        $this->lang = null;
        $this->start = null;
        $this->end = null;
        $this->lat = null;
        $this->lon = null;
        $this->official_site_url = null;
        $this->facebook_url = null;
        $this->twitter_url = null;
        $this->youtube_url = null;
        $this->wikipedia_url = null;
        $this->rss_url = null;
        $this->country = null;
        $this->location = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

    }

    /**
     * return the string representation of this object
     *
     * @return string The value of the 'title' column
     */
    public function __toString()
    {
        return (string) $this->getTitle();
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}

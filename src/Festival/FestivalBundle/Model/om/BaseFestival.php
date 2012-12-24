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
use Festival\FestivalBundle\Model\FestivalContent;
use Festival\FestivalBundle\Model\FestivalContentQuery;
use Festival\FestivalBundle\Model\FestivalLocation;
use Festival\FestivalBundle\Model\FestivalLocationQuery;
use Festival\FestivalBundle\Model\FestivalPeer;
use Festival\FestivalBundle\Model\FestivalQuery;
use Festival\FestivalBundle\Model\FestivalType;
use Festival\FestivalBundle\Model\FestivalTypeQuery;
use Festival\FestivalBundle\Model\FestivalUrl;
use Festival\FestivalBundle\Model\FestivalUrlQuery;

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
     * The value for the type_id field.
     * @var        int
     */
    protected $type_id;

    /**
     * The value for the festival_content_title field.
     * @var        string
     */
    protected $festival_content_title;

    /**
     * The value for the start_date field.
     * @var        string
     */
    protected $start_date;

    /**
     * The value for the end_date field.
     * @var        string
     */
    protected $end_date;

    /**
     * The value for the festival_location_id field.
     * @var        int
     */
    protected $festival_location_id;

    /**
     * The value for the festival_content_id field.
     * @var        int
     */
    protected $festival_content_id;

    /**
     * The value for the festival_url_id field.
     * @var        int
     */
    protected $festival_url_id;

    /**
     * The value for the slug field.
     * @var        string
     */
    protected $slug;

    /**
     * The value for the lang field.
     * @var        string
     */
    protected $lang;

    /**
     * @var        FestivalType
     */
    protected $aFestivalType;

    /**
     * @var        FestivalLocation
     */
    protected $aFestivalLocation;

    /**
     * @var        FestivalContent
     */
    protected $aFestivalContent;

    /**
     * @var        FestivalUrl
     */
    protected $aFestivalUrl;

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
     * Get the [type_id] column value.
     *
     * @return int
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Get the [festival_content_title] column value.
     *
     * @return string
     */
    public function getFestivalContentTitle()
    {
        return $this->festival_content_title;
    }

    /**
     * Get the [optionally formatted] temporal [start_date] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getStartDate($format = null)
    {
        if ($this->start_date === null) {
            return null;
        }

        if ($this->start_date === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->start_date);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->start_date, true), $x);
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
     * Get the [optionally formatted] temporal [end_date] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getEndDate($format = null)
    {
        if ($this->end_date === null) {
            return null;
        }

        if ($this->end_date === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->end_date);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->end_date, true), $x);
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
     * Get the [festival_location_id] column value.
     *
     * @return int
     */
    public function getFestivalLocationId()
    {
        return $this->festival_location_id;
    }

    /**
     * Get the [festival_content_id] column value.
     *
     * @return int
     */
    public function getFestivalContentId()
    {
        return $this->festival_content_id;
    }

    /**
     * Get the [festival_url_id] column value.
     *
     * @return int
     */
    public function getFestivalUrlId()
    {
        return $this->festival_url_id;
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
     * Get the [lang] column value.
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
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
     * Set the value of [type_id] column.
     *
     * @param int $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->type_id !== $v) {
            $this->type_id = $v;
            $this->modifiedColumns[] = FestivalPeer::TYPE_ID;
        }

        if ($this->aFestivalType !== null && $this->aFestivalType->getId() !== $v) {
            $this->aFestivalType = null;
        }


        return $this;
    } // setTypeId()

    /**
     * Set the value of [festival_content_title] column.
     *
     * @param string $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setFestivalContentTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->festival_content_title !== $v) {
            $this->festival_content_title = $v;
            $this->modifiedColumns[] = FestivalPeer::FESTIVAL_CONTENT_TITLE;
        }


        return $this;
    } // setFestivalContentTitle()

    /**
     * Sets the value of [start_date] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Festival The current object (for fluent API support)
     */
    public function setStartDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->start_date !== null || $dt !== null) {
            $currentDateAsString = ($this->start_date !== null && $tmpDt = new DateTime($this->start_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->start_date = $newDateAsString;
                $this->modifiedColumns[] = FestivalPeer::START_DATE;
            }
        } // if either are not null


        return $this;
    } // setStartDate()

    /**
     * Sets the value of [end_date] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Festival The current object (for fluent API support)
     */
    public function setEndDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->end_date !== null || $dt !== null) {
            $currentDateAsString = ($this->end_date !== null && $tmpDt = new DateTime($this->end_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->end_date = $newDateAsString;
                $this->modifiedColumns[] = FestivalPeer::END_DATE;
            }
        } // if either are not null


        return $this;
    } // setEndDate()

    /**
     * Set the value of [festival_location_id] column.
     *
     * @param int $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setFestivalLocationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->festival_location_id !== $v) {
            $this->festival_location_id = $v;
            $this->modifiedColumns[] = FestivalPeer::FESTIVAL_LOCATION_ID;
        }

        if ($this->aFestivalLocation !== null && $this->aFestivalLocation->getId() !== $v) {
            $this->aFestivalLocation = null;
        }


        return $this;
    } // setFestivalLocationId()

    /**
     * Set the value of [festival_content_id] column.
     *
     * @param int $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setFestivalContentId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->festival_content_id !== $v) {
            $this->festival_content_id = $v;
            $this->modifiedColumns[] = FestivalPeer::FESTIVAL_CONTENT_ID;
        }

        if ($this->aFestivalContent !== null && $this->aFestivalContent->getId() !== $v) {
            $this->aFestivalContent = null;
        }


        return $this;
    } // setFestivalContentId()

    /**
     * Set the value of [festival_url_id] column.
     *
     * @param int $v new value
     * @return Festival The current object (for fluent API support)
     */
    public function setFestivalUrlId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->festival_url_id !== $v) {
            $this->festival_url_id = $v;
            $this->modifiedColumns[] = FestivalPeer::FESTIVAL_URL_ID;
        }

        if ($this->aFestivalUrl !== null && $this->aFestivalUrl->getId() !== $v) {
            $this->aFestivalUrl = null;
        }


        return $this;
    } // setFestivalUrlId()

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
            $this->type_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->festival_content_title = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->start_date = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->end_date = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->festival_location_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->festival_content_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->festival_url_id = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->slug = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->lang = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = FestivalPeer::NUM_HYDRATE_COLUMNS.

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

        if ($this->aFestivalType !== null && $this->type_id !== $this->aFestivalType->getId()) {
            $this->aFestivalType = null;
        }
        if ($this->aFestivalLocation !== null && $this->festival_location_id !== $this->aFestivalLocation->getId()) {
            $this->aFestivalLocation = null;
        }
        if ($this->aFestivalContent !== null && $this->festival_content_id !== $this->aFestivalContent->getId()) {
            $this->aFestivalContent = null;
        }
        if ($this->aFestivalUrl !== null && $this->festival_url_id !== $this->aFestivalUrl->getId()) {
            $this->aFestivalUrl = null;
        }
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

            $this->aFestivalType = null;
            $this->aFestivalLocation = null;
            $this->aFestivalContent = null;
            $this->aFestivalUrl = null;
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aFestivalType !== null) {
                if ($this->aFestivalType->isModified() || $this->aFestivalType->isNew()) {
                    $affectedRows += $this->aFestivalType->save($con);
                }
                $this->setFestivalType($this->aFestivalType);
            }

            if ($this->aFestivalLocation !== null) {
                if ($this->aFestivalLocation->isModified() || $this->aFestivalLocation->isNew()) {
                    $affectedRows += $this->aFestivalLocation->save($con);
                }
                $this->setFestivalLocation($this->aFestivalLocation);
            }

            if ($this->aFestivalContent !== null) {
                if ($this->aFestivalContent->isModified() || $this->aFestivalContent->isNew()) {
                    $affectedRows += $this->aFestivalContent->save($con);
                }
                $this->setFestivalContent($this->aFestivalContent);
            }

            if ($this->aFestivalUrl !== null) {
                if ($this->aFestivalUrl->isModified() || $this->aFestivalUrl->isNew()) {
                    $affectedRows += $this->aFestivalUrl->save($con);
                }
                $this->setFestivalUrl($this->aFestivalUrl);
            }

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
        if ($this->isColumnModified(FestivalPeer::TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`TYPE_ID`';
        }
        if ($this->isColumnModified(FestivalPeer::FESTIVAL_CONTENT_TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`FESTIVAL_CONTENT_TITLE`';
        }
        if ($this->isColumnModified(FestivalPeer::START_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`START_DATE`';
        }
        if ($this->isColumnModified(FestivalPeer::END_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`END_DATE`';
        }
        if ($this->isColumnModified(FestivalPeer::FESTIVAL_LOCATION_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FESTIVAL_LOCATION_ID`';
        }
        if ($this->isColumnModified(FestivalPeer::FESTIVAL_CONTENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FESTIVAL_CONTENT_ID`';
        }
        if ($this->isColumnModified(FestivalPeer::FESTIVAL_URL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FESTIVAL_URL_ID`';
        }
        if ($this->isColumnModified(FestivalPeer::SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`SLUG`';
        }
        if ($this->isColumnModified(FestivalPeer::LANG)) {
            $modifiedColumns[':p' . $index++]  = '`LANG`';
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
                    case '`TYPE_ID`':
                        $stmt->bindValue($identifier, $this->type_id, PDO::PARAM_INT);
                        break;
                    case '`FESTIVAL_CONTENT_TITLE`':
                        $stmt->bindValue($identifier, $this->festival_content_title, PDO::PARAM_STR);
                        break;
                    case '`START_DATE`':
                        $stmt->bindValue($identifier, $this->start_date, PDO::PARAM_STR);
                        break;
                    case '`END_DATE`':
                        $stmt->bindValue($identifier, $this->end_date, PDO::PARAM_STR);
                        break;
                    case '`FESTIVAL_LOCATION_ID`':
                        $stmt->bindValue($identifier, $this->festival_location_id, PDO::PARAM_INT);
                        break;
                    case '`FESTIVAL_CONTENT_ID`':
                        $stmt->bindValue($identifier, $this->festival_content_id, PDO::PARAM_INT);
                        break;
                    case '`FESTIVAL_URL_ID`':
                        $stmt->bindValue($identifier, $this->festival_url_id, PDO::PARAM_INT);
                        break;
                    case '`SLUG`':
                        $stmt->bindValue($identifier, $this->slug, PDO::PARAM_STR);
                        break;
                    case '`LANG`':
                        $stmt->bindValue($identifier, $this->lang, PDO::PARAM_STR);
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


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aFestivalType !== null) {
                if (!$this->aFestivalType->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aFestivalType->getValidationFailures());
                }
            }

            if ($this->aFestivalLocation !== null) {
                if (!$this->aFestivalLocation->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aFestivalLocation->getValidationFailures());
                }
            }

            if ($this->aFestivalContent !== null) {
                if (!$this->aFestivalContent->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aFestivalContent->getValidationFailures());
                }
            }

            if ($this->aFestivalUrl !== null) {
                if (!$this->aFestivalUrl->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aFestivalUrl->getValidationFailures());
                }
            }


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
                return $this->getTypeId();
                break;
            case 2:
                return $this->getFestivalContentTitle();
                break;
            case 3:
                return $this->getStartDate();
                break;
            case 4:
                return $this->getEndDate();
                break;
            case 5:
                return $this->getFestivalLocationId();
                break;
            case 6:
                return $this->getFestivalContentId();
                break;
            case 7:
                return $this->getFestivalUrlId();
                break;
            case 8:
                return $this->getSlug();
                break;
            case 9:
                return $this->getLang();
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
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Festival'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Festival'][$this->getPrimaryKey()] = true;
        $keys = FestivalPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTypeId(),
            $keys[2] => $this->getFestivalContentTitle(),
            $keys[3] => $this->getStartDate(),
            $keys[4] => $this->getEndDate(),
            $keys[5] => $this->getFestivalLocationId(),
            $keys[6] => $this->getFestivalContentId(),
            $keys[7] => $this->getFestivalUrlId(),
            $keys[8] => $this->getSlug(),
            $keys[9] => $this->getLang(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aFestivalType) {
                $result['FestivalType'] = $this->aFestivalType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aFestivalLocation) {
                $result['FestivalLocation'] = $this->aFestivalLocation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aFestivalContent) {
                $result['FestivalContent'] = $this->aFestivalContent->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aFestivalUrl) {
                $result['FestivalUrl'] = $this->aFestivalUrl->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

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
                $this->setTypeId($value);
                break;
            case 2:
                $this->setFestivalContentTitle($value);
                break;
            case 3:
                $this->setStartDate($value);
                break;
            case 4:
                $this->setEndDate($value);
                break;
            case 5:
                $this->setFestivalLocationId($value);
                break;
            case 6:
                $this->setFestivalContentId($value);
                break;
            case 7:
                $this->setFestivalUrlId($value);
                break;
            case 8:
                $this->setSlug($value);
                break;
            case 9:
                $this->setLang($value);
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
        if (array_key_exists($keys[1], $arr)) $this->setTypeId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setFestivalContentTitle($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setStartDate($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setEndDate($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setFestivalLocationId($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setFestivalContentId($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setFestivalUrlId($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setSlug($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setLang($arr[$keys[9]]);
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
        if ($this->isColumnModified(FestivalPeer::TYPE_ID)) $criteria->add(FestivalPeer::TYPE_ID, $this->type_id);
        if ($this->isColumnModified(FestivalPeer::FESTIVAL_CONTENT_TITLE)) $criteria->add(FestivalPeer::FESTIVAL_CONTENT_TITLE, $this->festival_content_title);
        if ($this->isColumnModified(FestivalPeer::START_DATE)) $criteria->add(FestivalPeer::START_DATE, $this->start_date);
        if ($this->isColumnModified(FestivalPeer::END_DATE)) $criteria->add(FestivalPeer::END_DATE, $this->end_date);
        if ($this->isColumnModified(FestivalPeer::FESTIVAL_LOCATION_ID)) $criteria->add(FestivalPeer::FESTIVAL_LOCATION_ID, $this->festival_location_id);
        if ($this->isColumnModified(FestivalPeer::FESTIVAL_CONTENT_ID)) $criteria->add(FestivalPeer::FESTIVAL_CONTENT_ID, $this->festival_content_id);
        if ($this->isColumnModified(FestivalPeer::FESTIVAL_URL_ID)) $criteria->add(FestivalPeer::FESTIVAL_URL_ID, $this->festival_url_id);
        if ($this->isColumnModified(FestivalPeer::SLUG)) $criteria->add(FestivalPeer::SLUG, $this->slug);
        if ($this->isColumnModified(FestivalPeer::LANG)) $criteria->add(FestivalPeer::LANG, $this->lang);

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
        $copyObj->setTypeId($this->getTypeId());
        $copyObj->setFestivalContentTitle($this->getFestivalContentTitle());
        $copyObj->setStartDate($this->getStartDate());
        $copyObj->setEndDate($this->getEndDate());
        $copyObj->setFestivalLocationId($this->getFestivalLocationId());
        $copyObj->setFestivalContentId($this->getFestivalContentId());
        $copyObj->setFestivalUrlId($this->getFestivalUrlId());
        $copyObj->setSlug($this->getSlug());
        $copyObj->setLang($this->getLang());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

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
     * Declares an association between this object and a FestivalType object.
     *
     * @param             FestivalType $v
     * @return Festival The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFestivalType(FestivalType $v = null)
    {
        if ($v === null) {
            $this->setTypeId(NULL);
        } else {
            $this->setTypeId($v->getId());
        }

        $this->aFestivalType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the FestivalType object, it will not be re-added.
        if ($v !== null) {
            $v->addFestival($this);
        }


        return $this;
    }


    /**
     * Get the associated FestivalType object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return FestivalType The associated FestivalType object.
     * @throws PropelException
     */
    public function getFestivalType(PropelPDO $con = null)
    {
        if ($this->aFestivalType === null && ($this->type_id !== null)) {
            $this->aFestivalType = FestivalTypeQuery::create()->findPk($this->type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFestivalType->addFestivals($this);
             */
        }

        return $this->aFestivalType;
    }

    /**
     * Declares an association between this object and a FestivalLocation object.
     *
     * @param             FestivalLocation $v
     * @return Festival The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFestivalLocation(FestivalLocation $v = null)
    {
        if ($v === null) {
            $this->setFestivalLocationId(NULL);
        } else {
            $this->setFestivalLocationId($v->getId());
        }

        $this->aFestivalLocation = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the FestivalLocation object, it will not be re-added.
        if ($v !== null) {
            $v->addFestival($this);
        }


        return $this;
    }


    /**
     * Get the associated FestivalLocation object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return FestivalLocation The associated FestivalLocation object.
     * @throws PropelException
     */
    public function getFestivalLocation(PropelPDO $con = null)
    {
        if ($this->aFestivalLocation === null && ($this->festival_location_id !== null)) {
            $this->aFestivalLocation = FestivalLocationQuery::create()->findPk($this->festival_location_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFestivalLocation->addFestivals($this);
             */
        }

        return $this->aFestivalLocation;
    }

    /**
     * Declares an association between this object and a FestivalContent object.
     *
     * @param             FestivalContent $v
     * @return Festival The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFestivalContent(FestivalContent $v = null)
    {
        if ($v === null) {
            $this->setFestivalContentId(NULL);
        } else {
            $this->setFestivalContentId($v->getId());
        }

        $this->aFestivalContent = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the FestivalContent object, it will not be re-added.
        if ($v !== null) {
            $v->addFestival($this);
        }


        return $this;
    }


    /**
     * Get the associated FestivalContent object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return FestivalContent The associated FestivalContent object.
     * @throws PropelException
     */
    public function getFestivalContent(PropelPDO $con = null)
    {
        if ($this->aFestivalContent === null && ($this->festival_content_id !== null)) {
            $this->aFestivalContent = FestivalContentQuery::create()->findPk($this->festival_content_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFestivalContent->addFestivals($this);
             */
        }

        return $this->aFestivalContent;
    }

    /**
     * Declares an association between this object and a FestivalUrl object.
     *
     * @param             FestivalUrl $v
     * @return Festival The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFestivalUrl(FestivalUrl $v = null)
    {
        if ($v === null) {
            $this->setFestivalUrlId(NULL);
        } else {
            $this->setFestivalUrlId($v->getId());
        }

        $this->aFestivalUrl = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the FestivalUrl object, it will not be re-added.
        if ($v !== null) {
            $v->addFestival($this);
        }


        return $this;
    }


    /**
     * Get the associated FestivalUrl object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return FestivalUrl The associated FestivalUrl object.
     * @throws PropelException
     */
    public function getFestivalUrl(PropelPDO $con = null)
    {
        if ($this->aFestivalUrl === null && ($this->festival_url_id !== null)) {
            $this->aFestivalUrl = FestivalUrlQuery::create()->findPk($this->festival_url_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFestivalUrl->addFestivals($this);
             */
        }

        return $this->aFestivalUrl;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->type_id = null;
        $this->festival_content_title = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->festival_location_id = null;
        $this->festival_content_id = null;
        $this->festival_url_id = null;
        $this->slug = null;
        $this->lang = null;
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

        $this->aFestivalType = null;
        $this->aFestivalLocation = null;
        $this->aFestivalContent = null;
        $this->aFestivalUrl = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FestivalPeer::DEFAULT_STRING_FORMAT);
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

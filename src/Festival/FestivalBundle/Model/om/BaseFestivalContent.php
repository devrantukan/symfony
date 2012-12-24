<?php

namespace Festival\FestivalBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Festival\FestivalBundle\Model\Festival;
use Festival\FestivalBundle\Model\FestivalContent;
use Festival\FestivalBundle\Model\FestivalContentPeer;
use Festival\FestivalBundle\Model\FestivalContentQuery;
use Festival\FestivalBundle\Model\FestivalQuery;

abstract class BaseFestivalContent extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Festival\\FestivalBundle\\Model\\FestivalContentPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        FestivalContentPeer
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
     * The value for the festival_id field.
     * @var        int
     */
    protected $festival_id;

    /**
     * The value for the title field.
     * @var        string
     */
    protected $title;

    /**
     * The value for the subtitle field.
     * @var        string
     */
    protected $subtitle;

    /**
     * The value for the content field.
     * @var        string
     */
    protected $content;

    /**
     * The value for the visitor field.
     * @var        string
     */
    protected $visitor;

    /**
     * The value for the user_id field.
     * @var        int
     */
    protected $user_id;

    /**
     * @var        PropelObjectCollection|Festival[] Collection to store aggregation of Festival objects.
     */
    protected $collFestivals;
    protected $collFestivalsPartial;

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
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $festivalsScheduledForDeletion = null;

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
     * Get the [festival_id] column value.
     *
     * @return int
     */
    public function getFestivalId()
    {
        return $this->festival_id;
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
     * Get the [subtitle] column value.
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Get the [content] column value.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the [visitor] column value.
     *
     * @return string
     */
    public function getVisitor()
    {
        return $this->visitor;
    }

    /**
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return FestivalContent The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = FestivalContentPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [festival_id] column.
     *
     * @param int $v new value
     * @return FestivalContent The current object (for fluent API support)
     */
    public function setFestivalId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->festival_id !== $v) {
            $this->festival_id = $v;
            $this->modifiedColumns[] = FestivalContentPeer::FESTIVAL_ID;
        }


        return $this;
    } // setFestivalId()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return FestivalContent The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[] = FestivalContentPeer::TITLE;
        }


        return $this;
    } // setTitle()

    /**
     * Set the value of [subtitle] column.
     *
     * @param string $v new value
     * @return FestivalContent The current object (for fluent API support)
     */
    public function setSubtitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->subtitle !== $v) {
            $this->subtitle = $v;
            $this->modifiedColumns[] = FestivalContentPeer::SUBTITLE;
        }


        return $this;
    } // setSubtitle()

    /**
     * Set the value of [content] column.
     *
     * @param string $v new value
     * @return FestivalContent The current object (for fluent API support)
     */
    public function setContent($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->content !== $v) {
            $this->content = $v;
            $this->modifiedColumns[] = FestivalContentPeer::CONTENT;
        }


        return $this;
    } // setContent()

    /**
     * Set the value of [visitor] column.
     *
     * @param string $v new value
     * @return FestivalContent The current object (for fluent API support)
     */
    public function setVisitor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->visitor !== $v) {
            $this->visitor = $v;
            $this->modifiedColumns[] = FestivalContentPeer::VISITOR;
        }


        return $this;
    } // setVisitor()

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v new value
     * @return FestivalContent The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[] = FestivalContentPeer::USER_ID;
        }


        return $this;
    } // setUserId()

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
            $this->festival_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->title = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->subtitle = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->content = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->visitor = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->user_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = FestivalContentPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating FestivalContent object", $e);
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
            $con = Propel::getConnection(FestivalContentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = FestivalContentPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collFestivals = null;

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
            $con = Propel::getConnection(FestivalContentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = FestivalContentQuery::create()
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
            $con = Propel::getConnection(FestivalContentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                FestivalContentPeer::addInstanceToPool($this);
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

            if ($this->festivalsScheduledForDeletion !== null) {
                if (!$this->festivalsScheduledForDeletion->isEmpty()) {
                    foreach ($this->festivalsScheduledForDeletion as $festival) {
                        // need to save related object because we set the relation to null
                        $festival->save($con);
                    }
                    $this->festivalsScheduledForDeletion = null;
                }
            }

            if ($this->collFestivals !== null) {
                foreach ($this->collFestivals as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[] = FestivalContentPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FestivalContentPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FestivalContentPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(FestivalContentPeer::FESTIVAL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FESTIVAL_ID`';
        }
        if ($this->isColumnModified(FestivalContentPeer::TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`TITLE`';
        }
        if ($this->isColumnModified(FestivalContentPeer::SUBTITLE)) {
            $modifiedColumns[':p' . $index++]  = '`SUBTITLE`';
        }
        if ($this->isColumnModified(FestivalContentPeer::CONTENT)) {
            $modifiedColumns[':p' . $index++]  = '`CONTENT`';
        }
        if ($this->isColumnModified(FestivalContentPeer::VISITOR)) {
            $modifiedColumns[':p' . $index++]  = '`VISITOR`';
        }
        if ($this->isColumnModified(FestivalContentPeer::USER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`USER_ID`';
        }

        $sql = sprintf(
            'INSERT INTO `festival_content` (%s) VALUES (%s)',
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
                    case '`FESTIVAL_ID`':
                        $stmt->bindValue($identifier, $this->festival_id, PDO::PARAM_INT);
                        break;
                    case '`TITLE`':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case '`SUBTITLE`':
                        $stmt->bindValue($identifier, $this->subtitle, PDO::PARAM_STR);
                        break;
                    case '`CONTENT`':
                        $stmt->bindValue($identifier, $this->content, PDO::PARAM_STR);
                        break;
                    case '`VISITOR`':
                        $stmt->bindValue($identifier, $this->visitor, PDO::PARAM_STR);
                        break;
                    case '`USER_ID`':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
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


            if (($retval = FestivalContentPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collFestivals !== null) {
                    foreach ($this->collFestivals as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
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
        $pos = FestivalContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getFestivalId();
                break;
            case 2:
                return $this->getTitle();
                break;
            case 3:
                return $this->getSubtitle();
                break;
            case 4:
                return $this->getContent();
                break;
            case 5:
                return $this->getVisitor();
                break;
            case 6:
                return $this->getUserId();
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
        if (isset($alreadyDumpedObjects['FestivalContent'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['FestivalContent'][$this->getPrimaryKey()] = true;
        $keys = FestivalContentPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getFestivalId(),
            $keys[2] => $this->getTitle(),
            $keys[3] => $this->getSubtitle(),
            $keys[4] => $this->getContent(),
            $keys[5] => $this->getVisitor(),
            $keys[6] => $this->getUserId(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collFestivals) {
                $result['Festivals'] = $this->collFestivals->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = FestivalContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setFestivalId($value);
                break;
            case 2:
                $this->setTitle($value);
                break;
            case 3:
                $this->setSubtitle($value);
                break;
            case 4:
                $this->setContent($value);
                break;
            case 5:
                $this->setVisitor($value);
                break;
            case 6:
                $this->setUserId($value);
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
        $keys = FestivalContentPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFestivalId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setTitle($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setSubtitle($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setContent($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setVisitor($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setUserId($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(FestivalContentPeer::DATABASE_NAME);

        if ($this->isColumnModified(FestivalContentPeer::ID)) $criteria->add(FestivalContentPeer::ID, $this->id);
        if ($this->isColumnModified(FestivalContentPeer::FESTIVAL_ID)) $criteria->add(FestivalContentPeer::FESTIVAL_ID, $this->festival_id);
        if ($this->isColumnModified(FestivalContentPeer::TITLE)) $criteria->add(FestivalContentPeer::TITLE, $this->title);
        if ($this->isColumnModified(FestivalContentPeer::SUBTITLE)) $criteria->add(FestivalContentPeer::SUBTITLE, $this->subtitle);
        if ($this->isColumnModified(FestivalContentPeer::CONTENT)) $criteria->add(FestivalContentPeer::CONTENT, $this->content);
        if ($this->isColumnModified(FestivalContentPeer::VISITOR)) $criteria->add(FestivalContentPeer::VISITOR, $this->visitor);
        if ($this->isColumnModified(FestivalContentPeer::USER_ID)) $criteria->add(FestivalContentPeer::USER_ID, $this->user_id);

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
        $criteria = new Criteria(FestivalContentPeer::DATABASE_NAME);
        $criteria->add(FestivalContentPeer::ID, $this->id);

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
     * @param object $copyObj An object of FestivalContent (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFestivalId($this->getFestivalId());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setSubtitle($this->getSubtitle());
        $copyObj->setContent($this->getContent());
        $copyObj->setVisitor($this->getVisitor());
        $copyObj->setUserId($this->getUserId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getFestivals() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFestival($relObj->copy($deepCopy));
                }
            }

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
     * @return FestivalContent Clone of current object.
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
     * @return FestivalContentPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new FestivalContentPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Festival' == $relationName) {
            $this->initFestivals();
        }
    }

    /**
     * Clears out the collFestivals collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFestivals()
     */
    public function clearFestivals()
    {
        $this->collFestivals = null; // important to set this to null since that means it is uninitialized
        $this->collFestivalsPartial = null;
    }

    /**
     * reset is the collFestivals collection loaded partially
     *
     * @return void
     */
    public function resetPartialFestivals($v = true)
    {
        $this->collFestivalsPartial = $v;
    }

    /**
     * Initializes the collFestivals collection.
     *
     * By default this just sets the collFestivals collection to an empty array (like clearcollFestivals());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFestivals($overrideExisting = true)
    {
        if (null !== $this->collFestivals && !$overrideExisting) {
            return;
        }
        $this->collFestivals = new PropelObjectCollection();
        $this->collFestivals->setModel('Festival');
    }

    /**
     * Gets an array of Festival objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this FestivalContent is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Festival[] List of Festival objects
     * @throws PropelException
     */
    public function getFestivals($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collFestivalsPartial && !$this->isNew();
        if (null === $this->collFestivals || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFestivals) {
                // return empty collection
                $this->initFestivals();
            } else {
                $collFestivals = FestivalQuery::create(null, $criteria)
                    ->filterByFestivalContent($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collFestivalsPartial && count($collFestivals)) {
                      $this->initFestivals(false);

                      foreach($collFestivals as $obj) {
                        if (false == $this->collFestivals->contains($obj)) {
                          $this->collFestivals->append($obj);
                        }
                      }

                      $this->collFestivalsPartial = true;
                    }

                    return $collFestivals;
                }

                if($partial && $this->collFestivals) {
                    foreach($this->collFestivals as $obj) {
                        if($obj->isNew()) {
                            $collFestivals[] = $obj;
                        }
                    }
                }

                $this->collFestivals = $collFestivals;
                $this->collFestivalsPartial = false;
            }
        }

        return $this->collFestivals;
    }

    /**
     * Sets a collection of Festival objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $festivals A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setFestivals(PropelCollection $festivals, PropelPDO $con = null)
    {
        $this->festivalsScheduledForDeletion = $this->getFestivals(new Criteria(), $con)->diff($festivals);

        foreach ($this->festivalsScheduledForDeletion as $festivalRemoved) {
            $festivalRemoved->setFestivalContent(null);
        }

        $this->collFestivals = null;
        foreach ($festivals as $festival) {
            $this->addFestival($festival);
        }

        $this->collFestivals = $festivals;
        $this->collFestivalsPartial = false;
    }

    /**
     * Returns the number of related Festival objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Festival objects.
     * @throws PropelException
     */
    public function countFestivals(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collFestivalsPartial && !$this->isNew();
        if (null === $this->collFestivals || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFestivals) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getFestivals());
                }
                $query = FestivalQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByFestivalContent($this)
                    ->count($con);
            }
        } else {
            return count($this->collFestivals);
        }
    }

    /**
     * Method called to associate a Festival object to this object
     * through the Festival foreign key attribute.
     *
     * @param    Festival $l Festival
     * @return FestivalContent The current object (for fluent API support)
     */
    public function addFestival(Festival $l)
    {
        if ($this->collFestivals === null) {
            $this->initFestivals();
            $this->collFestivalsPartial = true;
        }
        if (!in_array($l, $this->collFestivals->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddFestival($l);
        }

        return $this;
    }

    /**
     * @param	Festival $festival The festival object to add.
     */
    protected function doAddFestival($festival)
    {
        $this->collFestivals[]= $festival;
        $festival->setFestivalContent($this);
    }

    /**
     * @param	Festival $festival The festival object to remove.
     */
    public function removeFestival($festival)
    {
        if ($this->getFestivals()->contains($festival)) {
            $this->collFestivals->remove($this->collFestivals->search($festival));
            if (null === $this->festivalsScheduledForDeletion) {
                $this->festivalsScheduledForDeletion = clone $this->collFestivals;
                $this->festivalsScheduledForDeletion->clear();
            }
            $this->festivalsScheduledForDeletion[]= $festival;
            $festival->setFestivalContent(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this FestivalContent is new, it will return
     * an empty collection; or if this FestivalContent has previously
     * been saved, it will retrieve related Festivals from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in FestivalContent.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Festival[] List of Festival objects
     */
    public function getFestivalsJoinFestivalType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = FestivalQuery::create(null, $criteria);
        $query->joinWith('FestivalType', $join_behavior);

        return $this->getFestivals($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this FestivalContent is new, it will return
     * an empty collection; or if this FestivalContent has previously
     * been saved, it will retrieve related Festivals from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in FestivalContent.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Festival[] List of Festival objects
     */
    public function getFestivalsJoinFestivalLocation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = FestivalQuery::create(null, $criteria);
        $query->joinWith('FestivalLocation', $join_behavior);

        return $this->getFestivals($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this FestivalContent is new, it will return
     * an empty collection; or if this FestivalContent has previously
     * been saved, it will retrieve related Festivals from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in FestivalContent.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Festival[] List of Festival objects
     */
    public function getFestivalsJoinFestivalUrl($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = FestivalQuery::create(null, $criteria);
        $query->joinWith('FestivalUrl', $join_behavior);

        return $this->getFestivals($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->festival_id = null;
        $this->title = null;
        $this->subtitle = null;
        $this->content = null;
        $this->visitor = null;
        $this->user_id = null;
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
            if ($this->collFestivals) {
                foreach ($this->collFestivals as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collFestivals instanceof PropelCollection) {
            $this->collFestivals->clearIterator();
        }
        $this->collFestivals = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FestivalContentPeer::DEFAULT_STRING_FORMAT);
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

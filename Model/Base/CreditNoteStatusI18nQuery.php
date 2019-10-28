<?php

namespace CreditNote\Model\Base;

use \Exception;
use \PDO;
use CreditNote\Model\CreditNoteStatusI18n as ChildCreditNoteStatusI18n;
use CreditNote\Model\CreditNoteStatusI18nQuery as ChildCreditNoteStatusI18nQuery;
use CreditNote\Model\Map\CreditNoteStatusI18nTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'credit_note_status_i18n' table.
 *
 *
 *
 * @method     ChildCreditNoteStatusI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCreditNoteStatusI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildCreditNoteStatusI18nQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildCreditNoteStatusI18nQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildCreditNoteStatusI18nQuery orderByChapo($order = Criteria::ASC) Order by the chapo column
 * @method     ChildCreditNoteStatusI18nQuery orderByPostscriptum($order = Criteria::ASC) Order by the postscriptum column
 *
 * @method     ChildCreditNoteStatusI18nQuery groupById() Group by the id column
 * @method     ChildCreditNoteStatusI18nQuery groupByLocale() Group by the locale column
 * @method     ChildCreditNoteStatusI18nQuery groupByTitle() Group by the title column
 * @method     ChildCreditNoteStatusI18nQuery groupByDescription() Group by the description column
 * @method     ChildCreditNoteStatusI18nQuery groupByChapo() Group by the chapo column
 * @method     ChildCreditNoteStatusI18nQuery groupByPostscriptum() Group by the postscriptum column
 *
 * @method     ChildCreditNoteStatusI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCreditNoteStatusI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCreditNoteStatusI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCreditNoteStatusI18nQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCreditNoteStatusI18nQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCreditNoteStatusI18nQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCreditNoteStatusI18nQuery leftJoinCreditNoteStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the CreditNoteStatus relation
 * @method     ChildCreditNoteStatusI18nQuery rightJoinCreditNoteStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CreditNoteStatus relation
 * @method     ChildCreditNoteStatusI18nQuery innerJoinCreditNoteStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the CreditNoteStatus relation
 *
 * @method     ChildCreditNoteStatusI18nQuery joinWithCreditNoteStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CreditNoteStatus relation
 *
 * @method     ChildCreditNoteStatusI18nQuery leftJoinWithCreditNoteStatus() Adds a LEFT JOIN clause and with to the query using the CreditNoteStatus relation
 * @method     ChildCreditNoteStatusI18nQuery rightJoinWithCreditNoteStatus() Adds a RIGHT JOIN clause and with to the query using the CreditNoteStatus relation
 * @method     ChildCreditNoteStatusI18nQuery innerJoinWithCreditNoteStatus() Adds a INNER JOIN clause and with to the query using the CreditNoteStatus relation
 *
 * @method     \CreditNote\Model\CreditNoteStatusQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCreditNoteStatusI18n findOne(ConnectionInterface $con = null) Return the first ChildCreditNoteStatusI18n matching the query
 * @method     ChildCreditNoteStatusI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCreditNoteStatusI18n matching the query, or a new ChildCreditNoteStatusI18n object populated from the query conditions when no match is found
 *
 * @method     ChildCreditNoteStatusI18n findOneById(int $id) Return the first ChildCreditNoteStatusI18n filtered by the id column
 * @method     ChildCreditNoteStatusI18n findOneByLocale(string $locale) Return the first ChildCreditNoteStatusI18n filtered by the locale column
 * @method     ChildCreditNoteStatusI18n findOneByTitle(string $title) Return the first ChildCreditNoteStatusI18n filtered by the title column
 * @method     ChildCreditNoteStatusI18n findOneByDescription(string $description) Return the first ChildCreditNoteStatusI18n filtered by the description column
 * @method     ChildCreditNoteStatusI18n findOneByChapo(string $chapo) Return the first ChildCreditNoteStatusI18n filtered by the chapo column
 * @method     ChildCreditNoteStatusI18n findOneByPostscriptum(string $postscriptum) Return the first ChildCreditNoteStatusI18n filtered by the postscriptum column *

 * @method     ChildCreditNoteStatusI18n requirePk($key, ConnectionInterface $con = null) Return the ChildCreditNoteStatusI18n by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCreditNoteStatusI18n requireOne(ConnectionInterface $con = null) Return the first ChildCreditNoteStatusI18n matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCreditNoteStatusI18n requireOneById(int $id) Return the first ChildCreditNoteStatusI18n filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCreditNoteStatusI18n requireOneByLocale(string $locale) Return the first ChildCreditNoteStatusI18n filtered by the locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCreditNoteStatusI18n requireOneByTitle(string $title) Return the first ChildCreditNoteStatusI18n filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCreditNoteStatusI18n requireOneByDescription(string $description) Return the first ChildCreditNoteStatusI18n filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCreditNoteStatusI18n requireOneByChapo(string $chapo) Return the first ChildCreditNoteStatusI18n filtered by the chapo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCreditNoteStatusI18n requireOneByPostscriptum(string $postscriptum) Return the first ChildCreditNoteStatusI18n filtered by the postscriptum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCreditNoteStatusI18n[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCreditNoteStatusI18n objects based on current ModelCriteria
 * @method     ChildCreditNoteStatusI18n[]|ObjectCollection findById(int $id) Return ChildCreditNoteStatusI18n objects filtered by the id column
 * @method     ChildCreditNoteStatusI18n[]|ObjectCollection findByLocale(string $locale) Return ChildCreditNoteStatusI18n objects filtered by the locale column
 * @method     ChildCreditNoteStatusI18n[]|ObjectCollection findByTitle(string $title) Return ChildCreditNoteStatusI18n objects filtered by the title column
 * @method     ChildCreditNoteStatusI18n[]|ObjectCollection findByDescription(string $description) Return ChildCreditNoteStatusI18n objects filtered by the description column
 * @method     ChildCreditNoteStatusI18n[]|ObjectCollection findByChapo(string $chapo) Return ChildCreditNoteStatusI18n objects filtered by the chapo column
 * @method     ChildCreditNoteStatusI18n[]|ObjectCollection findByPostscriptum(string $postscriptum) Return ChildCreditNoteStatusI18n objects filtered by the postscriptum column
 * @method     ChildCreditNoteStatusI18n[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CreditNoteStatusI18nQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CreditNote\Model\Base\CreditNoteStatusI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\CreditNote\\Model\\CreditNoteStatusI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCreditNoteStatusI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCreditNoteStatusI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ChildCreditNoteStatusI18nQuery) {
            return $criteria;
        }
        $query = new ChildCreditNoteStatusI18nQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $locale] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCreditNoteStatusI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CreditNoteStatusI18nTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CreditNoteStatusI18nTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCreditNoteStatusI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `locale`, `title`, `description`, `chapo`, `postscriptum` FROM `credit_note_status_i18n` WHERE `id` = :p0 AND `locale` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCreditNoteStatusI18n $obj */
            $obj = new ChildCreditNoteStatusI18n();
            $obj->hydrate($row);
            CreditNoteStatusI18nTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildCreditNoteStatusI18n|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCreditNoteStatusI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(CreditNoteStatusI18nTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(CreditNoteStatusI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCreditNoteStatusI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(CreditNoteStatusI18nTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(CreditNoteStatusI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByCreditNoteStatus()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for \in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCreditNoteStatusI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (\is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CreditNoteStatusI18nTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CreditNoteStatusI18nTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteStatusI18nTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%', Criteria::LIKE); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCreditNoteStatusI18nQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (\is_array($locale)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteStatusI18nTableMap::COL_LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCreditNoteStatusI18nQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (\is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteStatusI18nTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCreditNoteStatusI18nQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (\is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteStatusI18nTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the chapo column
     *
     * Example usage:
     * <code>
     * $query->filterByChapo('fooValue');   // WHERE chapo = 'fooValue'
     * $query->filterByChapo('%fooValue%', Criteria::LIKE); // WHERE chapo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $chapo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCreditNoteStatusI18nQuery The current query, for fluid interface
     */
    public function filterByChapo($chapo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (\is_array($chapo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteStatusI18nTableMap::COL_CHAPO, $chapo, $comparison);
    }

    /**
     * Filter the query on the postscriptum column
     *
     * Example usage:
     * <code>
     * $query->filterByPostscriptum('fooValue');   // WHERE postscriptum = 'fooValue'
     * $query->filterByPostscriptum('%fooValue%', Criteria::LIKE); // WHERE postscriptum LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postscriptum The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCreditNoteStatusI18nQuery The current query, for fluid interface
     */
    public function filterByPostscriptum($postscriptum = null, $comparison = null)
    {
        if (null === $comparison) {
            if (\is_array($postscriptum)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteStatusI18nTableMap::COL_POSTSCRIPTUM, $postscriptum, $comparison);
    }

    /**
     * Filter the query by a related \CreditNote\Model\CreditNoteStatus object
     *
     * @param \CreditNote\Model\CreditNoteStatus|ObjectCollection $creditNoteStatus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCreditNoteStatusI18nQuery The current query, for fluid interface
     */
    public function filterByCreditNoteStatus($creditNoteStatus, $comparison = null)
    {
        if ($creditNoteStatus instanceof \CreditNote\Model\CreditNoteStatus) {
            return $this
                ->addUsingAlias(CreditNoteStatusI18nTableMap::COL_ID, $creditNoteStatus->getId(), $comparison);
        } elseif ($creditNoteStatus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CreditNoteStatusI18nTableMap::COL_ID, $creditNoteStatus->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCreditNoteStatus() only accepts arguments of type \CreditNote\Model\CreditNoteStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CreditNoteStatus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCreditNoteStatusI18nQuery The current query, for fluid interface
     */
    public function joinCreditNoteStatus($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CreditNoteStatus');

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
            $this->addJoinObject($join, 'CreditNoteStatus');
        }

        return $this;
    }

    /**
     * Use the CreditNoteStatus relation CreditNoteStatus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CreditNote\Model\CreditNoteStatusQuery A secondary query class using the current class as primary query
     */
    public function useCreditNoteStatusQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinCreditNoteStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CreditNoteStatus', '\CreditNote\Model\CreditNoteStatusQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCreditNoteStatusI18n $creditNoteStatusI18n Object to remove from the list of results
     *
     * @return $this|ChildCreditNoteStatusI18nQuery The current query, for fluid interface
     */
    public function prune($creditNoteStatusI18n = null)
    {
        if ($creditNoteStatusI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(CreditNoteStatusI18nTableMap::COL_ID), $creditNoteStatusI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(CreditNoteStatusI18nTableMap::COL_LOCALE), $creditNoteStatusI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the credit_note_status_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CreditNoteStatusI18nTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CreditNoteStatusI18nTableMap::clearInstancePool();
            CreditNoteStatusI18nTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CreditNoteStatusI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CreditNoteStatusI18nTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CreditNoteStatusI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CreditNoteStatusI18nTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CreditNoteStatusI18nQuery

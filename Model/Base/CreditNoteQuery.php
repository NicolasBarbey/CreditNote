<?php

namespace CreditNote\Model\Base;

use \Exception;
use \PDO;
use CreditNote\Model\CreditNote as ChildCreditNote;
use CreditNote\Model\CreditNoteQuery as ChildCreditNoteQuery;
use CreditNote\Model\Map\CreditNoteTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Thelia\Model\Currency;
use Thelia\Model\Customer;
use Thelia\Model\Order;

/**
 * Base class that represents a query for the 'credit_note' table.
 *
 *
 *
 * @method     ChildCreditNoteQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCreditNoteQuery orderByRef($order = Criteria::ASC) Order by the ref column
 * @method     ChildCreditNoteQuery orderByInvoiceRef($order = Criteria::ASC) Order by the invoice_ref column
 * @method     ChildCreditNoteQuery orderByInvoiceAddressId($order = Criteria::ASC) Order by the invoice_address_id column
 * @method     ChildCreditNoteQuery orderByInvoiceDate($order = Criteria::ASC) Order by the invoice_date column
 * @method     ChildCreditNoteQuery orderByOrderId($order = Criteria::ASC) Order by the order_id column
 * @method     ChildCreditNoteQuery orderByCustomerId($order = Criteria::ASC) Order by the customer_id column
 * @method     ChildCreditNoteQuery orderByParentId($order = Criteria::ASC) Order by the parent_id column
 * @method     ChildCreditNoteQuery orderByTypeId($order = Criteria::ASC) Order by the type_id column
 * @method     ChildCreditNoteQuery orderByStatusId($order = Criteria::ASC) Order by the status_id column
 * @method     ChildCreditNoteQuery orderByCurrencyId($order = Criteria::ASC) Order by the currency_id column
 * @method     ChildCreditNoteQuery orderByCurrencyRate($order = Criteria::ASC) Order by the currency_rate column
 * @method     ChildCreditNoteQuery orderByTotalPrice($order = Criteria::ASC) Order by the total_price column
 * @method     ChildCreditNoteQuery orderByTotalPriceWithTax($order = Criteria::ASC) Order by the total_price_with_tax column
 * @method     ChildCreditNoteQuery orderByDiscountWithoutTax($order = Criteria::ASC) Order by the discount_without_tax column
 * @method     ChildCreditNoteQuery orderByDiscountWithTax($order = Criteria::ASC) Order by the discount_with_tax column
 * @method     ChildCreditNoteQuery orderByAllowPartialUse($order = Criteria::ASC) Order by the allow_partial_use column
 * @method     ChildCreditNoteQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildCreditNoteQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildCreditNoteQuery groupById() Group by the id column
 * @method     ChildCreditNoteQuery groupByRef() Group by the ref column
 * @method     ChildCreditNoteQuery groupByInvoiceRef() Group by the invoice_ref column
 * @method     ChildCreditNoteQuery groupByInvoiceAddressId() Group by the invoice_address_id column
 * @method     ChildCreditNoteQuery groupByInvoiceDate() Group by the invoice_date column
 * @method     ChildCreditNoteQuery groupByOrderId() Group by the order_id column
 * @method     ChildCreditNoteQuery groupByCustomerId() Group by the customer_id column
 * @method     ChildCreditNoteQuery groupByParentId() Group by the parent_id column
 * @method     ChildCreditNoteQuery groupByTypeId() Group by the type_id column
 * @method     ChildCreditNoteQuery groupByStatusId() Group by the status_id column
 * @method     ChildCreditNoteQuery groupByCurrencyId() Group by the currency_id column
 * @method     ChildCreditNoteQuery groupByCurrencyRate() Group by the currency_rate column
 * @method     ChildCreditNoteQuery groupByTotalPrice() Group by the total_price column
 * @method     ChildCreditNoteQuery groupByTotalPriceWithTax() Group by the total_price_with_tax column
 * @method     ChildCreditNoteQuery groupByDiscountWithoutTax() Group by the discount_without_tax column
 * @method     ChildCreditNoteQuery groupByDiscountWithTax() Group by the discount_with_tax column
 * @method     ChildCreditNoteQuery groupByAllowPartialUse() Group by the allow_partial_use column
 * @method     ChildCreditNoteQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildCreditNoteQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildCreditNoteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCreditNoteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCreditNoteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCreditNoteQuery leftJoinOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Order relation
 * @method     ChildCreditNoteQuery rightJoinOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Order relation
 * @method     ChildCreditNoteQuery innerJoinOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the Order relation
 *
 * @method     ChildCreditNoteQuery leftJoinCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customer relation
 * @method     ChildCreditNoteQuery rightJoinCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customer relation
 * @method     ChildCreditNoteQuery innerJoinCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the Customer relation
 *
 * @method     ChildCreditNoteQuery leftJoinCreditNoteRelatedByParentId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CreditNoteRelatedByParentId relation
 * @method     ChildCreditNoteQuery rightJoinCreditNoteRelatedByParentId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CreditNoteRelatedByParentId relation
 * @method     ChildCreditNoteQuery innerJoinCreditNoteRelatedByParentId($relationAlias = null) Adds a INNER JOIN clause to the query using the CreditNoteRelatedByParentId relation
 *
 * @method     ChildCreditNoteQuery leftJoinCreditNoteType($relationAlias = null) Adds a LEFT JOIN clause to the query using the CreditNoteType relation
 * @method     ChildCreditNoteQuery rightJoinCreditNoteType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CreditNoteType relation
 * @method     ChildCreditNoteQuery innerJoinCreditNoteType($relationAlias = null) Adds a INNER JOIN clause to the query using the CreditNoteType relation
 *
 * @method     ChildCreditNoteQuery leftJoinCreditNoteStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the CreditNoteStatus relation
 * @method     ChildCreditNoteQuery rightJoinCreditNoteStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CreditNoteStatus relation
 * @method     ChildCreditNoteQuery innerJoinCreditNoteStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the CreditNoteStatus relation
 *
 * @method     ChildCreditNoteQuery leftJoinCurrency($relationAlias = null) Adds a LEFT JOIN clause to the query using the Currency relation
 * @method     ChildCreditNoteQuery rightJoinCurrency($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Currency relation
 * @method     ChildCreditNoteQuery innerJoinCurrency($relationAlias = null) Adds a INNER JOIN clause to the query using the Currency relation
 *
 * @method     ChildCreditNoteQuery leftJoinCreditNoteAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the CreditNoteAddress relation
 * @method     ChildCreditNoteQuery rightJoinCreditNoteAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CreditNoteAddress relation
 * @method     ChildCreditNoteQuery innerJoinCreditNoteAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the CreditNoteAddress relation
 *
 * @method     ChildCreditNoteQuery leftJoinCreditNoteRelatedById($relationAlias = null) Adds a LEFT JOIN clause to the query using the CreditNoteRelatedById relation
 * @method     ChildCreditNoteQuery rightJoinCreditNoteRelatedById($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CreditNoteRelatedById relation
 * @method     ChildCreditNoteQuery innerJoinCreditNoteRelatedById($relationAlias = null) Adds a INNER JOIN clause to the query using the CreditNoteRelatedById relation
 *
 * @method     ChildCreditNoteQuery leftJoinOrderCreditNote($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderCreditNote relation
 * @method     ChildCreditNoteQuery rightJoinOrderCreditNote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderCreditNote relation
 * @method     ChildCreditNoteQuery innerJoinOrderCreditNote($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderCreditNote relation
 *
 * @method     ChildCreditNoteQuery leftJoinCartCreditNote($relationAlias = null) Adds a LEFT JOIN clause to the query using the CartCreditNote relation
 * @method     ChildCreditNoteQuery rightJoinCartCreditNote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CartCreditNote relation
 * @method     ChildCreditNoteQuery innerJoinCartCreditNote($relationAlias = null) Adds a INNER JOIN clause to the query using the CartCreditNote relation
 *
 * @method     ChildCreditNoteQuery leftJoinCreditNoteDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the CreditNoteDetail relation
 * @method     ChildCreditNoteQuery rightJoinCreditNoteDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CreditNoteDetail relation
 * @method     ChildCreditNoteQuery innerJoinCreditNoteDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the CreditNoteDetail relation
 *
 * @method     ChildCreditNoteQuery leftJoinCreditNoteComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the CreditNoteComment relation
 * @method     ChildCreditNoteQuery rightJoinCreditNoteComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CreditNoteComment relation
 * @method     ChildCreditNoteQuery innerJoinCreditNoteComment($relationAlias = null) Adds a INNER JOIN clause to the query using the CreditNoteComment relation
 *
 * @method     ChildCreditNote findOne(ConnectionInterface $con = null) Return the first ChildCreditNote matching the query
 * @method     ChildCreditNote findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCreditNote matching the query, or a new ChildCreditNote object populated from the query conditions when no match is found
 *
 * @method     ChildCreditNote findOneById(int $id) Return the first ChildCreditNote filtered by the id column
 * @method     ChildCreditNote findOneByRef(string $ref) Return the first ChildCreditNote filtered by the ref column
 * @method     ChildCreditNote findOneByInvoiceRef(string $invoice_ref) Return the first ChildCreditNote filtered by the invoice_ref column
 * @method     ChildCreditNote findOneByInvoiceAddressId(int $invoice_address_id) Return the first ChildCreditNote filtered by the invoice_address_id column
 * @method     ChildCreditNote findOneByInvoiceDate(string $invoice_date) Return the first ChildCreditNote filtered by the invoice_date column
 * @method     ChildCreditNote findOneByOrderId(int $order_id) Return the first ChildCreditNote filtered by the order_id column
 * @method     ChildCreditNote findOneByCustomerId(int $customer_id) Return the first ChildCreditNote filtered by the customer_id column
 * @method     ChildCreditNote findOneByParentId(int $parent_id) Return the first ChildCreditNote filtered by the parent_id column
 * @method     ChildCreditNote findOneByTypeId(int $type_id) Return the first ChildCreditNote filtered by the type_id column
 * @method     ChildCreditNote findOneByStatusId(int $status_id) Return the first ChildCreditNote filtered by the status_id column
 * @method     ChildCreditNote findOneByCurrencyId(int $currency_id) Return the first ChildCreditNote filtered by the currency_id column
 * @method     ChildCreditNote findOneByCurrencyRate(double $currency_rate) Return the first ChildCreditNote filtered by the currency_rate column
 * @method     ChildCreditNote findOneByTotalPrice(string $total_price) Return the first ChildCreditNote filtered by the total_price column
 * @method     ChildCreditNote findOneByTotalPriceWithTax(string $total_price_with_tax) Return the first ChildCreditNote filtered by the total_price_with_tax column
 * @method     ChildCreditNote findOneByDiscountWithoutTax(string $discount_without_tax) Return the first ChildCreditNote filtered by the discount_without_tax column
 * @method     ChildCreditNote findOneByDiscountWithTax(string $discount_with_tax) Return the first ChildCreditNote filtered by the discount_with_tax column
 * @method     ChildCreditNote findOneByAllowPartialUse(boolean $allow_partial_use) Return the first ChildCreditNote filtered by the allow_partial_use column
 * @method     ChildCreditNote findOneByCreatedAt(string $created_at) Return the first ChildCreditNote filtered by the created_at column
 * @method     ChildCreditNote findOneByUpdatedAt(string $updated_at) Return the first ChildCreditNote filtered by the updated_at column
 *
 * @method     array findById(int $id) Return ChildCreditNote objects filtered by the id column
 * @method     array findByRef(string $ref) Return ChildCreditNote objects filtered by the ref column
 * @method     array findByInvoiceRef(string $invoice_ref) Return ChildCreditNote objects filtered by the invoice_ref column
 * @method     array findByInvoiceAddressId(int $invoice_address_id) Return ChildCreditNote objects filtered by the invoice_address_id column
 * @method     array findByInvoiceDate(string $invoice_date) Return ChildCreditNote objects filtered by the invoice_date column
 * @method     array findByOrderId(int $order_id) Return ChildCreditNote objects filtered by the order_id column
 * @method     array findByCustomerId(int $customer_id) Return ChildCreditNote objects filtered by the customer_id column
 * @method     array findByParentId(int $parent_id) Return ChildCreditNote objects filtered by the parent_id column
 * @method     array findByTypeId(int $type_id) Return ChildCreditNote objects filtered by the type_id column
 * @method     array findByStatusId(int $status_id) Return ChildCreditNote objects filtered by the status_id column
 * @method     array findByCurrencyId(int $currency_id) Return ChildCreditNote objects filtered by the currency_id column
 * @method     array findByCurrencyRate(double $currency_rate) Return ChildCreditNote objects filtered by the currency_rate column
 * @method     array findByTotalPrice(string $total_price) Return ChildCreditNote objects filtered by the total_price column
 * @method     array findByTotalPriceWithTax(string $total_price_with_tax) Return ChildCreditNote objects filtered by the total_price_with_tax column
 * @method     array findByDiscountWithoutTax(string $discount_without_tax) Return ChildCreditNote objects filtered by the discount_without_tax column
 * @method     array findByDiscountWithTax(string $discount_with_tax) Return ChildCreditNote objects filtered by the discount_with_tax column
 * @method     array findByAllowPartialUse(boolean $allow_partial_use) Return ChildCreditNote objects filtered by the allow_partial_use column
 * @method     array findByCreatedAt(string $created_at) Return ChildCreditNote objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return ChildCreditNote objects filtered by the updated_at column
 *
 */
abstract class CreditNoteQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \CreditNote\Model\Base\CreditNoteQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\CreditNote\\Model\\CreditNote', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCreditNoteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCreditNoteQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \CreditNote\Model\CreditNoteQuery) {
            return $criteria;
        }
        $query = new \CreditNote\Model\CreditNoteQuery();
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
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCreditNote|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CreditNoteTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CreditNoteTableMap::DATABASE_NAME);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildCreditNote A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, REF, INVOICE_REF, INVOICE_ADDRESS_ID, INVOICE_DATE, ORDER_ID, CUSTOMER_ID, PARENT_ID, TYPE_ID, STATUS_ID, CURRENCY_ID, CURRENCY_RATE, TOTAL_PRICE, TOTAL_PRICE_WITH_TAX, DISCOUNT_WITHOUT_TAX, DISCOUNT_WITH_TAX, ALLOW_PARTIAL_USE, CREATED_AT, UPDATED_AT FROM credit_note WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildCreditNote();
            $obj->hydrate($row);
            CreditNoteTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCreditNote|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
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
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CreditNoteTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CreditNoteTableMap::ID, $keys, Criteria::IN);
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
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the ref column
     *
     * Example usage:
     * <code>
     * $query->filterByRef('fooValue');   // WHERE ref = 'fooValue'
     * $query->filterByRef('%fooValue%'); // WHERE ref LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ref The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByRef($ref = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ref)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ref)) {
                $ref = str_replace('*', '%', $ref);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::REF, $ref, $comparison);
    }

    /**
     * Filter the query on the invoice_ref column
     *
     * Example usage:
     * <code>
     * $query->filterByInvoiceRef('fooValue');   // WHERE invoice_ref = 'fooValue'
     * $query->filterByInvoiceRef('%fooValue%'); // WHERE invoice_ref LIKE '%fooValue%'
     * </code>
     *
     * @param     string $invoiceRef The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByInvoiceRef($invoiceRef = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($invoiceRef)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $invoiceRef)) {
                $invoiceRef = str_replace('*', '%', $invoiceRef);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::INVOICE_REF, $invoiceRef, $comparison);
    }

    /**
     * Filter the query on the invoice_address_id column
     *
     * Example usage:
     * <code>
     * $query->filterByInvoiceAddressId(1234); // WHERE invoice_address_id = 1234
     * $query->filterByInvoiceAddressId(array(12, 34)); // WHERE invoice_address_id IN (12, 34)
     * $query->filterByInvoiceAddressId(array('min' => 12)); // WHERE invoice_address_id > 12
     * </code>
     *
     * @see       filterByCreditNoteAddress()
     *
     * @param     mixed $invoiceAddressId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByInvoiceAddressId($invoiceAddressId = null, $comparison = null)
    {
        if (is_array($invoiceAddressId)) {
            $useMinMax = false;
            if (isset($invoiceAddressId['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::INVOICE_ADDRESS_ID, $invoiceAddressId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($invoiceAddressId['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::INVOICE_ADDRESS_ID, $invoiceAddressId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::INVOICE_ADDRESS_ID, $invoiceAddressId, $comparison);
    }

    /**
     * Filter the query on the invoice_date column
     *
     * Example usage:
     * <code>
     * $query->filterByInvoiceDate('2011-03-14'); // WHERE invoice_date = '2011-03-14'
     * $query->filterByInvoiceDate('now'); // WHERE invoice_date = '2011-03-14'
     * $query->filterByInvoiceDate(array('max' => 'yesterday')); // WHERE invoice_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $invoiceDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByInvoiceDate($invoiceDate = null, $comparison = null)
    {
        if (is_array($invoiceDate)) {
            $useMinMax = false;
            if (isset($invoiceDate['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::INVOICE_DATE, $invoiceDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($invoiceDate['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::INVOICE_DATE, $invoiceDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::INVOICE_DATE, $invoiceDate, $comparison);
    }

    /**
     * Filter the query on the order_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderId(1234); // WHERE order_id = 1234
     * $query->filterByOrderId(array(12, 34)); // WHERE order_id IN (12, 34)
     * $query->filterByOrderId(array('min' => 12)); // WHERE order_id > 12
     * </code>
     *
     * @see       filterByOrder()
     *
     * @param     mixed $orderId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByOrderId($orderId = null, $comparison = null)
    {
        if (is_array($orderId)) {
            $useMinMax = false;
            if (isset($orderId['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::ORDER_ID, $orderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderId['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::ORDER_ID, $orderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::ORDER_ID, $orderId, $comparison);
    }

    /**
     * Filter the query on the customer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomerId(1234); // WHERE customer_id = 1234
     * $query->filterByCustomerId(array(12, 34)); // WHERE customer_id IN (12, 34)
     * $query->filterByCustomerId(array('min' => 12)); // WHERE customer_id > 12
     * </code>
     *
     * @see       filterByCustomer()
     *
     * @param     mixed $customerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCustomerId($customerId = null, $comparison = null)
    {
        if (is_array($customerId)) {
            $useMinMax = false;
            if (isset($customerId['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::CUSTOMER_ID, $customerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customerId['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::CUSTOMER_ID, $customerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::CUSTOMER_ID, $customerId, $comparison);
    }

    /**
     * Filter the query on the parent_id column
     *
     * Example usage:
     * <code>
     * $query->filterByParentId(1234); // WHERE parent_id = 1234
     * $query->filterByParentId(array(12, 34)); // WHERE parent_id IN (12, 34)
     * $query->filterByParentId(array('min' => 12)); // WHERE parent_id > 12
     * </code>
     *
     * @see       filterByCreditNoteRelatedByParentId()
     *
     * @param     mixed $parentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByParentId($parentId = null, $comparison = null)
    {
        if (is_array($parentId)) {
            $useMinMax = false;
            if (isset($parentId['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::PARENT_ID, $parentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentId['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::PARENT_ID, $parentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::PARENT_ID, $parentId, $comparison);
    }

    /**
     * Filter the query on the type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeId(1234); // WHERE type_id = 1234
     * $query->filterByTypeId(array(12, 34)); // WHERE type_id IN (12, 34)
     * $query->filterByTypeId(array('min' => 12)); // WHERE type_id > 12
     * </code>
     *
     * @see       filterByCreditNoteType()
     *
     * @param     mixed $typeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByTypeId($typeId = null, $comparison = null)
    {
        if (is_array($typeId)) {
            $useMinMax = false;
            if (isset($typeId['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::TYPE_ID, $typeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($typeId['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::TYPE_ID, $typeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::TYPE_ID, $typeId, $comparison);
    }

    /**
     * Filter the query on the status_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusId(1234); // WHERE status_id = 1234
     * $query->filterByStatusId(array(12, 34)); // WHERE status_id IN (12, 34)
     * $query->filterByStatusId(array('min' => 12)); // WHERE status_id > 12
     * </code>
     *
     * @see       filterByCreditNoteStatus()
     *
     * @param     mixed $statusId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByStatusId($statusId = null, $comparison = null)
    {
        if (is_array($statusId)) {
            $useMinMax = false;
            if (isset($statusId['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::STATUS_ID, $statusId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($statusId['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::STATUS_ID, $statusId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::STATUS_ID, $statusId, $comparison);
    }

    /**
     * Filter the query on the currency_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencyId(1234); // WHERE currency_id = 1234
     * $query->filterByCurrencyId(array(12, 34)); // WHERE currency_id IN (12, 34)
     * $query->filterByCurrencyId(array('min' => 12)); // WHERE currency_id > 12
     * </code>
     *
     * @see       filterByCurrency()
     *
     * @param     mixed $currencyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCurrencyId($currencyId = null, $comparison = null)
    {
        if (is_array($currencyId)) {
            $useMinMax = false;
            if (isset($currencyId['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::CURRENCY_ID, $currencyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($currencyId['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::CURRENCY_ID, $currencyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::CURRENCY_ID, $currencyId, $comparison);
    }

    /**
     * Filter the query on the currency_rate column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencyRate(1234); // WHERE currency_rate = 1234
     * $query->filterByCurrencyRate(array(12, 34)); // WHERE currency_rate IN (12, 34)
     * $query->filterByCurrencyRate(array('min' => 12)); // WHERE currency_rate > 12
     * </code>
     *
     * @param     mixed $currencyRate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCurrencyRate($currencyRate = null, $comparison = null)
    {
        if (is_array($currencyRate)) {
            $useMinMax = false;
            if (isset($currencyRate['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::CURRENCY_RATE, $currencyRate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($currencyRate['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::CURRENCY_RATE, $currencyRate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::CURRENCY_RATE, $currencyRate, $comparison);
    }

    /**
     * Filter the query on the total_price column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalPrice(1234); // WHERE total_price = 1234
     * $query->filterByTotalPrice(array(12, 34)); // WHERE total_price IN (12, 34)
     * $query->filterByTotalPrice(array('min' => 12)); // WHERE total_price > 12
     * </code>
     *
     * @param     mixed $totalPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByTotalPrice($totalPrice = null, $comparison = null)
    {
        if (is_array($totalPrice)) {
            $useMinMax = false;
            if (isset($totalPrice['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::TOTAL_PRICE, $totalPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalPrice['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::TOTAL_PRICE, $totalPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::TOTAL_PRICE, $totalPrice, $comparison);
    }

    /**
     * Filter the query on the total_price_with_tax column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalPriceWithTax(1234); // WHERE total_price_with_tax = 1234
     * $query->filterByTotalPriceWithTax(array(12, 34)); // WHERE total_price_with_tax IN (12, 34)
     * $query->filterByTotalPriceWithTax(array('min' => 12)); // WHERE total_price_with_tax > 12
     * </code>
     *
     * @param     mixed $totalPriceWithTax The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByTotalPriceWithTax($totalPriceWithTax = null, $comparison = null)
    {
        if (is_array($totalPriceWithTax)) {
            $useMinMax = false;
            if (isset($totalPriceWithTax['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::TOTAL_PRICE_WITH_TAX, $totalPriceWithTax['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalPriceWithTax['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::TOTAL_PRICE_WITH_TAX, $totalPriceWithTax['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::TOTAL_PRICE_WITH_TAX, $totalPriceWithTax, $comparison);
    }

    /**
     * Filter the query on the discount_without_tax column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscountWithoutTax(1234); // WHERE discount_without_tax = 1234
     * $query->filterByDiscountWithoutTax(array(12, 34)); // WHERE discount_without_tax IN (12, 34)
     * $query->filterByDiscountWithoutTax(array('min' => 12)); // WHERE discount_without_tax > 12
     * </code>
     *
     * @param     mixed $discountWithoutTax The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByDiscountWithoutTax($discountWithoutTax = null, $comparison = null)
    {
        if (is_array($discountWithoutTax)) {
            $useMinMax = false;
            if (isset($discountWithoutTax['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::DISCOUNT_WITHOUT_TAX, $discountWithoutTax['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discountWithoutTax['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::DISCOUNT_WITHOUT_TAX, $discountWithoutTax['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::DISCOUNT_WITHOUT_TAX, $discountWithoutTax, $comparison);
    }

    /**
     * Filter the query on the discount_with_tax column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscountWithTax(1234); // WHERE discount_with_tax = 1234
     * $query->filterByDiscountWithTax(array(12, 34)); // WHERE discount_with_tax IN (12, 34)
     * $query->filterByDiscountWithTax(array('min' => 12)); // WHERE discount_with_tax > 12
     * </code>
     *
     * @param     mixed $discountWithTax The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByDiscountWithTax($discountWithTax = null, $comparison = null)
    {
        if (is_array($discountWithTax)) {
            $useMinMax = false;
            if (isset($discountWithTax['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::DISCOUNT_WITH_TAX, $discountWithTax['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discountWithTax['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::DISCOUNT_WITH_TAX, $discountWithTax['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::DISCOUNT_WITH_TAX, $discountWithTax, $comparison);
    }

    /**
     * Filter the query on the allow_partial_use column
     *
     * Example usage:
     * <code>
     * $query->filterByAllowPartialUse(true); // WHERE allow_partial_use = true
     * $query->filterByAllowPartialUse('yes'); // WHERE allow_partial_use = true
     * </code>
     *
     * @param     boolean|string $allowPartialUse The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByAllowPartialUse($allowPartialUse = null, $comparison = null)
    {
        if (is_string($allowPartialUse)) {
            $allow_partial_use = in_array(strtolower($allowPartialUse), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CreditNoteTableMap::ALLOW_PARTIAL_USE, $allowPartialUse, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CreditNoteTableMap::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CreditNoteTableMap::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditNoteTableMap::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Thelia\Model\Order object
     *
     * @param \Thelia\Model\Order|ObjectCollection $order The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByOrder($order, $comparison = null)
    {
        if ($order instanceof \Thelia\Model\Order) {
            return $this
                ->addUsingAlias(CreditNoteTableMap::ORDER_ID, $order->getId(), $comparison);
        } elseif ($order instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CreditNoteTableMap::ORDER_ID, $order->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByOrder() only accepts arguments of type \Thelia\Model\Order or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Order relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function joinOrder($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Order');

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
            $this->addJoinObject($join, 'Order');
        }

        return $this;
    }

    /**
     * Use the Order relation Order object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Thelia\Model\OrderQuery A secondary query class using the current class as primary query
     */
    public function useOrderQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Order', '\Thelia\Model\OrderQuery');
    }

    /**
     * Filter the query by a related \Thelia\Model\Customer object
     *
     * @param \Thelia\Model\Customer|ObjectCollection $customer The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCustomer($customer, $comparison = null)
    {
        if ($customer instanceof \Thelia\Model\Customer) {
            return $this
                ->addUsingAlias(CreditNoteTableMap::CUSTOMER_ID, $customer->getId(), $comparison);
        } elseif ($customer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CreditNoteTableMap::CUSTOMER_ID, $customer->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCustomer() only accepts arguments of type \Thelia\Model\Customer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Customer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function joinCustomer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Customer');

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
            $this->addJoinObject($join, 'Customer');
        }

        return $this;
    }

    /**
     * Use the Customer relation Customer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Thelia\Model\CustomerQuery A secondary query class using the current class as primary query
     */
    public function useCustomerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCustomer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Customer', '\Thelia\Model\CustomerQuery');
    }

    /**
     * Filter the query by a related \CreditNote\Model\CreditNote object
     *
     * @param \CreditNote\Model\CreditNote|ObjectCollection $creditNote The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCreditNoteRelatedByParentId($creditNote, $comparison = null)
    {
        if ($creditNote instanceof \CreditNote\Model\CreditNote) {
            return $this
                ->addUsingAlias(CreditNoteTableMap::PARENT_ID, $creditNote->getId(), $comparison);
        } elseif ($creditNote instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CreditNoteTableMap::PARENT_ID, $creditNote->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCreditNoteRelatedByParentId() only accepts arguments of type \CreditNote\Model\CreditNote or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CreditNoteRelatedByParentId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function joinCreditNoteRelatedByParentId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CreditNoteRelatedByParentId');

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
            $this->addJoinObject($join, 'CreditNoteRelatedByParentId');
        }

        return $this;
    }

    /**
     * Use the CreditNoteRelatedByParentId relation CreditNote object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CreditNote\Model\CreditNoteQuery A secondary query class using the current class as primary query
     */
    public function useCreditNoteRelatedByParentIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCreditNoteRelatedByParentId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CreditNoteRelatedByParentId', '\CreditNote\Model\CreditNoteQuery');
    }

    /**
     * Filter the query by a related \CreditNote\Model\CreditNoteType object
     *
     * @param \CreditNote\Model\CreditNoteType|ObjectCollection $creditNoteType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCreditNoteType($creditNoteType, $comparison = null)
    {
        if ($creditNoteType instanceof \CreditNote\Model\CreditNoteType) {
            return $this
                ->addUsingAlias(CreditNoteTableMap::TYPE_ID, $creditNoteType->getId(), $comparison);
        } elseif ($creditNoteType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CreditNoteTableMap::TYPE_ID, $creditNoteType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCreditNoteType() only accepts arguments of type \CreditNote\Model\CreditNoteType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CreditNoteType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function joinCreditNoteType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CreditNoteType');

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
            $this->addJoinObject($join, 'CreditNoteType');
        }

        return $this;
    }

    /**
     * Use the CreditNoteType relation CreditNoteType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CreditNote\Model\CreditNoteTypeQuery A secondary query class using the current class as primary query
     */
    public function useCreditNoteTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCreditNoteType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CreditNoteType', '\CreditNote\Model\CreditNoteTypeQuery');
    }

    /**
     * Filter the query by a related \CreditNote\Model\CreditNoteStatus object
     *
     * @param \CreditNote\Model\CreditNoteStatus|ObjectCollection $creditNoteStatus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCreditNoteStatus($creditNoteStatus, $comparison = null)
    {
        if ($creditNoteStatus instanceof \CreditNote\Model\CreditNoteStatus) {
            return $this
                ->addUsingAlias(CreditNoteTableMap::STATUS_ID, $creditNoteStatus->getId(), $comparison);
        } elseif ($creditNoteStatus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CreditNoteTableMap::STATUS_ID, $creditNoteStatus->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function joinCreditNoteStatus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
     * @return   \CreditNote\Model\CreditNoteStatusQuery A secondary query class using the current class as primary query
     */
    public function useCreditNoteStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCreditNoteStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CreditNoteStatus', '\CreditNote\Model\CreditNoteStatusQuery');
    }

    /**
     * Filter the query by a related \Thelia\Model\Currency object
     *
     * @param \Thelia\Model\Currency|ObjectCollection $currency The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCurrency($currency, $comparison = null)
    {
        if ($currency instanceof \Thelia\Model\Currency) {
            return $this
                ->addUsingAlias(CreditNoteTableMap::CURRENCY_ID, $currency->getId(), $comparison);
        } elseif ($currency instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CreditNoteTableMap::CURRENCY_ID, $currency->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCurrency() only accepts arguments of type \Thelia\Model\Currency or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Currency relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function joinCurrency($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Currency');

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
            $this->addJoinObject($join, 'Currency');
        }

        return $this;
    }

    /**
     * Use the Currency relation Currency object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Thelia\Model\CurrencyQuery A secondary query class using the current class as primary query
     */
    public function useCurrencyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCurrency($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Currency', '\Thelia\Model\CurrencyQuery');
    }

    /**
     * Filter the query by a related \CreditNote\Model\CreditNoteAddress object
     *
     * @param \CreditNote\Model\CreditNoteAddress|ObjectCollection $creditNoteAddress The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCreditNoteAddress($creditNoteAddress, $comparison = null)
    {
        if ($creditNoteAddress instanceof \CreditNote\Model\CreditNoteAddress) {
            return $this
                ->addUsingAlias(CreditNoteTableMap::INVOICE_ADDRESS_ID, $creditNoteAddress->getId(), $comparison);
        } elseif ($creditNoteAddress instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CreditNoteTableMap::INVOICE_ADDRESS_ID, $creditNoteAddress->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCreditNoteAddress() only accepts arguments of type \CreditNote\Model\CreditNoteAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CreditNoteAddress relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function joinCreditNoteAddress($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CreditNoteAddress');

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
            $this->addJoinObject($join, 'CreditNoteAddress');
        }

        return $this;
    }

    /**
     * Use the CreditNoteAddress relation CreditNoteAddress object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CreditNote\Model\CreditNoteAddressQuery A secondary query class using the current class as primary query
     */
    public function useCreditNoteAddressQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCreditNoteAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CreditNoteAddress', '\CreditNote\Model\CreditNoteAddressQuery');
    }

    /**
     * Filter the query by a related \CreditNote\Model\CreditNote object
     *
     * @param \CreditNote\Model\CreditNote|ObjectCollection $creditNote  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCreditNoteRelatedById($creditNote, $comparison = null)
    {
        if ($creditNote instanceof \CreditNote\Model\CreditNote) {
            return $this
                ->addUsingAlias(CreditNoteTableMap::ID, $creditNote->getParentId(), $comparison);
        } elseif ($creditNote instanceof ObjectCollection) {
            return $this
                ->useCreditNoteRelatedByIdQuery()
                ->filterByPrimaryKeys($creditNote->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCreditNoteRelatedById() only accepts arguments of type \CreditNote\Model\CreditNote or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CreditNoteRelatedById relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function joinCreditNoteRelatedById($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CreditNoteRelatedById');

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
            $this->addJoinObject($join, 'CreditNoteRelatedById');
        }

        return $this;
    }

    /**
     * Use the CreditNoteRelatedById relation CreditNote object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CreditNote\Model\CreditNoteQuery A secondary query class using the current class as primary query
     */
    public function useCreditNoteRelatedByIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCreditNoteRelatedById($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CreditNoteRelatedById', '\CreditNote\Model\CreditNoteQuery');
    }

    /**
     * Filter the query by a related \CreditNote\Model\OrderCreditNote object
     *
     * @param \CreditNote\Model\OrderCreditNote|ObjectCollection $orderCreditNote  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByOrderCreditNote($orderCreditNote, $comparison = null)
    {
        if ($orderCreditNote instanceof \CreditNote\Model\OrderCreditNote) {
            return $this
                ->addUsingAlias(CreditNoteTableMap::ID, $orderCreditNote->getCreditNoteId(), $comparison);
        } elseif ($orderCreditNote instanceof ObjectCollection) {
            return $this
                ->useOrderCreditNoteQuery()
                ->filterByPrimaryKeys($orderCreditNote->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrderCreditNote() only accepts arguments of type \CreditNote\Model\OrderCreditNote or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderCreditNote relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function joinOrderCreditNote($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderCreditNote');

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
            $this->addJoinObject($join, 'OrderCreditNote');
        }

        return $this;
    }

    /**
     * Use the OrderCreditNote relation OrderCreditNote object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CreditNote\Model\OrderCreditNoteQuery A secondary query class using the current class as primary query
     */
    public function useOrderCreditNoteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderCreditNote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderCreditNote', '\CreditNote\Model\OrderCreditNoteQuery');
    }

    /**
     * Filter the query by a related \CreditNote\Model\CartCreditNote object
     *
     * @param \CreditNote\Model\CartCreditNote|ObjectCollection $cartCreditNote  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCartCreditNote($cartCreditNote, $comparison = null)
    {
        if ($cartCreditNote instanceof \CreditNote\Model\CartCreditNote) {
            return $this
                ->addUsingAlias(CreditNoteTableMap::ID, $cartCreditNote->getCreditNoteId(), $comparison);
        } elseif ($cartCreditNote instanceof ObjectCollection) {
            return $this
                ->useCartCreditNoteQuery()
                ->filterByPrimaryKeys($cartCreditNote->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCartCreditNote() only accepts arguments of type \CreditNote\Model\CartCreditNote or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CartCreditNote relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function joinCartCreditNote($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CartCreditNote');

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
            $this->addJoinObject($join, 'CartCreditNote');
        }

        return $this;
    }

    /**
     * Use the CartCreditNote relation CartCreditNote object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CreditNote\Model\CartCreditNoteQuery A secondary query class using the current class as primary query
     */
    public function useCartCreditNoteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCartCreditNote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CartCreditNote', '\CreditNote\Model\CartCreditNoteQuery');
    }

    /**
     * Filter the query by a related \CreditNote\Model\CreditNoteDetail object
     *
     * @param \CreditNote\Model\CreditNoteDetail|ObjectCollection $creditNoteDetail  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCreditNoteDetail($creditNoteDetail, $comparison = null)
    {
        if ($creditNoteDetail instanceof \CreditNote\Model\CreditNoteDetail) {
            return $this
                ->addUsingAlias(CreditNoteTableMap::ID, $creditNoteDetail->getCreditNoteId(), $comparison);
        } elseif ($creditNoteDetail instanceof ObjectCollection) {
            return $this
                ->useCreditNoteDetailQuery()
                ->filterByPrimaryKeys($creditNoteDetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCreditNoteDetail() only accepts arguments of type \CreditNote\Model\CreditNoteDetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CreditNoteDetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function joinCreditNoteDetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CreditNoteDetail');

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
            $this->addJoinObject($join, 'CreditNoteDetail');
        }

        return $this;
    }

    /**
     * Use the CreditNoteDetail relation CreditNoteDetail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CreditNote\Model\CreditNoteDetailQuery A secondary query class using the current class as primary query
     */
    public function useCreditNoteDetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCreditNoteDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CreditNoteDetail', '\CreditNote\Model\CreditNoteDetailQuery');
    }

    /**
     * Filter the query by a related \CreditNote\Model\CreditNoteComment object
     *
     * @param \CreditNote\Model\CreditNoteComment|ObjectCollection $creditNoteComment  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function filterByCreditNoteComment($creditNoteComment, $comparison = null)
    {
        if ($creditNoteComment instanceof \CreditNote\Model\CreditNoteComment) {
            return $this
                ->addUsingAlias(CreditNoteTableMap::ID, $creditNoteComment->getCreditNoteId(), $comparison);
        } elseif ($creditNoteComment instanceof ObjectCollection) {
            return $this
                ->useCreditNoteCommentQuery()
                ->filterByPrimaryKeys($creditNoteComment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCreditNoteComment() only accepts arguments of type \CreditNote\Model\CreditNoteComment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CreditNoteComment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function joinCreditNoteComment($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CreditNoteComment');

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
            $this->addJoinObject($join, 'CreditNoteComment');
        }

        return $this;
    }

    /**
     * Use the CreditNoteComment relation CreditNoteComment object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CreditNote\Model\CreditNoteCommentQuery A secondary query class using the current class as primary query
     */
    public function useCreditNoteCommentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCreditNoteComment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CreditNoteComment', '\CreditNote\Model\CreditNoteCommentQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCreditNote $creditNote Object to remove from the list of results
     *
     * @return ChildCreditNoteQuery The current query, for fluid interface
     */
    public function prune($creditNote = null)
    {
        if ($creditNote) {
            $this->addUsingAlias(CreditNoteTableMap::ID, $creditNote->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the credit_note table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CreditNoteTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CreditNoteTableMap::clearInstancePool();
            CreditNoteTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildCreditNote or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildCreditNote object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CreditNoteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CreditNoteTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        CreditNoteTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CreditNoteTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ChildCreditNoteQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(CreditNoteTableMap::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ChildCreditNoteQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(CreditNoteTableMap::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ChildCreditNoteQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(CreditNoteTableMap::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ChildCreditNoteQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(CreditNoteTableMap::UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     ChildCreditNoteQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(CreditNoteTableMap::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ChildCreditNoteQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(CreditNoteTableMap::CREATED_AT);
    }

} // CreditNoteQuery

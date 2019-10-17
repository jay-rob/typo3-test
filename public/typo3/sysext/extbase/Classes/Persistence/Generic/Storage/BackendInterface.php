<?php
declare(strict_types = 1);

namespace TYPO3\CMS\Extbase\Persistence\Generic\Storage;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Storage backend interface
 */
interface BackendInterface
{
    /**
     * Adds a row to the storage
     *
     * @param string $tableName The database table name
     * @param array $fieldValues The fieldValues to insert
     * @param bool $isRelation TRUE if we are currently inserting into a relation table, FALSE by default
     * @return int the UID of the inserted row
     */
    public function addRow(string $tableName, array $fieldValues, bool $isRelation = false): int;

    /**
     * Updates a row in the storage
     *
     * @param string $tableName The database table name
     * @param array $fieldValues The fieldValues to update
     * @param bool $isRelation TRUE if we are currently inserting into a relation table, FALSE by default
     */
    public function updateRow(string $tableName, array $fieldValues, bool $isRelation = false): void;

    /**
     * Updates a relation row in the storage
     *
     * @param string $tableName The database relation table name
     * @param array $fieldValues The fieldValues to be updated
     */
    public function updateRelationTableRow(string $tableName, array $fieldValues): void;

    /**
     * Deletes a row in the storage
     *
     * @param string $tableName The database table name
     * @param array $where An array of where array('fieldname' => value). This array will be transformed to a WHERE clause
     * @param bool $isRelation TRUE if we are currently inserting into a relation table, FALSE by default
     */
    public function removeRow(string $tableName, array $where, bool $isRelation = false): void;

    /**
     * Fetches maximal value for given table column
     *
     * @param string $tableName The database table name
     * @param array $where An array of where array('fieldname' => value). This array will be transformed to a WHERE clause
     * @param string $columnName column name to get the max value from
     * @return mixed the max value
     */
    public function getMaxValueFromTable(string $tableName, array $where, string $columnName);

    /**
     * Returns the number of items matching the query.
     *
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
     * @return int
     */
    public function getObjectCountByQuery(\TYPO3\CMS\Extbase\Persistence\QueryInterface $query): int;

    /**
     * Returns the object data matching the $query.
     *
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
     * @return array
     */
    public function getObjectDataByQuery(\TYPO3\CMS\Extbase\Persistence\QueryInterface $query): array;

    /**
     * Checks if a Value Object equal to the given Object exists in the data base
     *
     * @param \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject $object The Value Object
     * @return int|null The matching uid if an object was found, else null
     * @todo this is the last monster in this persistence series. refactor!
     */
    public function getUidOfAlreadyPersistedValueObject(\TYPO3\CMS\Extbase\DomainObject\AbstractValueObject $object): ?int;
}
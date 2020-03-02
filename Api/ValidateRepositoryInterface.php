<?php
namespace CarmineOwl\Subdir\Api;

use CarmineOwl\Subdir\Api\Data\ValidateInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface ValidateRepositoryInterface
 *
 * @api
 */
interface ValidateRepositoryInterface
{
    /**
     * Create or update a Validate.
     *
     * @param ValidateInterface $page
     * @return ValidateInterface
     */
    public function save(ValidateInterface $page);

    /**
     * Get a Validate by Id
     *
     * @param int $id
     * @return ValidateInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If Validate with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve Validates which match a specified criteria.
     *
     * @param SearchCriteriaInterface $criteria
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * Delete a Validate
     *
     * @param ValidateInterface $page
     * @return ValidateInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If Validate with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(ValidateInterface $page);

    /**
     * Delete a Validate by Id
     *
     * @param int $id
     * @return ValidateInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If customer with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);
}

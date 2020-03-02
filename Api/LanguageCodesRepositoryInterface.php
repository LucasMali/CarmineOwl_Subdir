<?php
namespace CarmineOwl\Subdir\Api;

use CarmineOwl\Subdir\Api\Data\LanguageCodesInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface LanguageCodesRepositoryInterface
 *
 * @api
 */
interface LanguageCodesRepositoryInterface
{
    /**
     * Create or update a LanguageCodes.
     *
     * @param LanguageCodesInterface $page
     * @return LanguageCodesInterface
     */
    public function save(LanguageCodesInterface $page);

    /**
     * Get a LanguageCodes by Id
     *
     * @param int $id
     * @return LanguageCodesInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If LanguageCodes with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve LanguageCodess which match a specified criteria.
     *
     * @param SearchCriteriaInterface $criteria
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * Delete a LanguageCodes
     *
     * @param LanguageCodesInterface $page
     * @return LanguageCodesInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If LanguageCodes with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(LanguageCodesInterface $page);

    /**
     * Delete a LanguageCodes by Id
     *
     * @param int $id
     * @return LanguageCodesInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If customer with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);
}

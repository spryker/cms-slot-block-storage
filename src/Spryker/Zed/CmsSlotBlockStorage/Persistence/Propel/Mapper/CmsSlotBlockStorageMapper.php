<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsSlotBlockStorage\Persistence\Propel\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CmsSlotBlockConditionTransfer;
use Generated\Shared\Transfer\CmsSlotBlockStorageTransfer;
use Generated\Shared\Transfer\CmsSlotBlockTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Orm\Zed\CmsSlot\Persistence\Map\SpyCmsSlotTableMap;
use Orm\Zed\CmsSlot\Persistence\Map\SpyCmsSlotTemplateTableMap;
use Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlock;
use Orm\Zed\CmsSlotBlockStorage\Persistence\SpyCmsSlotBlockStorage;
use Spryker\Zed\CmsSlotBlockStorage\Dependency\Service\CmsSlotBlockStorageToUtilEncodingServiceInterface;

class CmsSlotBlockStorageMapper
{
    /**
     * @var \Spryker\Zed\CmsSlotBlockStorage\Dependency\Service\CmsSlotBlockStorageToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    public function __construct(CmsSlotBlockStorageToUtilEncodingServiceInterface $utilEncodingService)
    {
        $this->utilEncodingService = $utilEncodingService;
    }

    public function mapCmsSlotBlockEntityToCmsSlotBlockTransfer(
        SpyCmsSlotBlock $cmsSlotBlockEntity,
        CmsSlotBlockTransfer $cmsSlotBlockTransfer
    ): CmsSlotBlockTransfer {
        $cmsSlotBlockTransfer->setCmsBlockKey($cmsSlotBlockEntity->getCmsBlock()->getKey());
        $conditions = $this->utilEncodingService->decodeJson($cmsSlotBlockEntity->getConditions(), true);

        $cmsSlotBlockTransfer->setConditions(new ArrayObject());
        foreach ($conditions as $conditionKey => $condition) {
            $cmsSlotBlockTransfer->addCondition(
                $conditionKey,
                (new CmsSlotBlockConditionTransfer())->fromArray($condition, true),
            );
        }

        return $cmsSlotBlockTransfer;
    }

    public function mapCmsSlotBlockStorageTransferToCmsSlotBlockStorageEntity(
        CmsSlotBlockStorageTransfer $cmsSlotBlockStorageTransfer,
        SpyCmsSlotBlockStorage $cmsSlotBlockStorageEntity
    ): SpyCmsSlotBlockStorage {
        $cmsSlotBlockStorageEntity->setFkCmsSlot($cmsSlotBlockStorageTransfer->getIdCmsSlot());
        $cmsSlotBlockStorageEntity->setFkCmsSlotTemplate($cmsSlotBlockStorageTransfer->getIdCmsSlotTemplate());
        $cmsSlotBlockStorageEntity->setSlotTemplateKey($cmsSlotBlockStorageTransfer->getSlotTemplateKey());
        $cmsSlotBlockStorageEntity->setData(
            $cmsSlotBlockStorageTransfer->getData()->modifiedToArray(true, true),
        );

        return $cmsSlotBlockStorageEntity;
    }

    public function mapCmsSlotBlockStorageEntityToSynchronizationDataTransfer(
        SpyCmsSlotBlockStorage $cmsSlotBlockStorageEntity
    ): SynchronizationDataTransfer {
        $synchronizationDataTransfer = new SynchronizationDataTransfer();
        /** @var string $data */
        $data = $cmsSlotBlockStorageEntity->getData();
        $synchronizationDataTransfer->setData($data);
        $synchronizationDataTransfer->setKey($cmsSlotBlockStorageEntity->getKey());

        return $synchronizationDataTransfer;
    }

    public function mapCmsSlotWithTemplateCombinationToCmsSlotBlockStorageTransfer(
        array $cmsSlotWithSlotTemplateCombination
    ): CmsSlotBlockStorageTransfer {
        return (new CmsSlotBlockStorageTransfer())
            ->setIdCmsSlot($cmsSlotWithSlotTemplateCombination[SpyCmsSlotTableMap::COL_ID_CMS_SLOT])
            ->setIdCmsSlotTemplate($cmsSlotWithSlotTemplateCombination[SpyCmsSlotTemplateTableMap::COL_ID_CMS_SLOT_TEMPLATE])
            ->setSlotKey($cmsSlotWithSlotTemplateCombination[SpyCmsSlotTableMap::COL_KEY])
            ->setTemplatePath($cmsSlotWithSlotTemplateCombination[SpyCmsSlotTemplateTableMap::COL_PATH]);
    }
}

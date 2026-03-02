<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsSlotBlockStorage\Business;

use Spryker\Service\CmsSlotBlockStorage\CmsSlotBlockStorageServiceInterface;
use Spryker\Zed\CmsSlotBlockStorage\Business\Storage\CmsSlotBlockStorageWriter;
use Spryker\Zed\CmsSlotBlockStorage\Business\Storage\CmsSlotBlockStorageWriterInterface;
use Spryker\Zed\CmsSlotBlockStorage\CmsSlotBlockStorageDependencyProvider;
use Spryker\Zed\CmsSlotBlockStorage\Dependency\Facade\CmsSlotBlockStorageToCmsSlotBlockFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Spryker\Zed\CmsSlotBlockStorage\CmsSlotBlockStorageConfig getConfig()
 * @method \Spryker\Zed\CmsSlotBlockStorage\Persistence\CmsSlotBlockStorageEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\CmsSlotBlockStorage\Persistence\CmsSlotBlockStorageRepositoryInterface getRepository()
 */
class CmsSlotBlockStorageBusinessFactory extends AbstractBusinessFactory
{
    public function createCmsSlotBlockStorageWriter(): CmsSlotBlockStorageWriterInterface
    {
        return new CmsSlotBlockStorageWriter(
            $this->getRepository(),
            $this->getEntityManager(),
            $this->getCmsSlotBlockStorageService(),
        );
    }

    public function getCmsSlotBlockFacade(): CmsSlotBlockStorageToCmsSlotBlockFacadeInterface
    {
        return $this->getProvidedDependency(CmsSlotBlockStorageDependencyProvider::FACADE_CMS_SLOT_BLOCK);
    }

    public function getCmsSlotBlockStorageService(): CmsSlotBlockStorageServiceInterface
    {
        return $this->getProvidedDependency(CmsSlotBlockStorageDependencyProvider::SERVICE_CMS_SLOT_BLOCK_STORAGE);
    }
}

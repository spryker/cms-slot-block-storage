<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsSlotBlockStorage\Persistence;

use Generated\Shared\Transfer\CmsSlotBlockStorageTransfer;

interface CmsSlotBlockStorageEntityManagerInterface
{
    public function saveCmsSlotBlockStorage(CmsSlotBlockStorageTransfer $cmsSlotBlockStorageTransfer): void;

    public function deleteCmsSlotBlockStorage(
        CmsSlotBlockStorageTransfer $cmsSlotBlockStorageTransfer
    ): void;
}

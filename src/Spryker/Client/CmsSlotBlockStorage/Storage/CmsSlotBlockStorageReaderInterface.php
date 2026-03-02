<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\CmsSlotBlockStorage\Storage;

use Generated\Shared\Transfer\CmsSlotBlockCollectionTransfer;

interface CmsSlotBlockStorageReaderInterface
{
    public function getCmsSlotBlockCollection(
        string $cmsSlotTemplatePath,
        string $cmsSlotKey
    ): CmsSlotBlockCollectionTransfer;
}

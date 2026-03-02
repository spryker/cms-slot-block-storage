<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\CmsSlotBlockStorage\KeyBuilder;

interface CmsSlotBlockStorageKeyBuilderInterface
{
    public function generateSlotTemplateKey(string $cmsSlotTemplatePath, string $cmsSlotKey): string;
}

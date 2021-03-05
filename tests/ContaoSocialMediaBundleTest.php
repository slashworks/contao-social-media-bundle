<?php

declare(strict_types=1);

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */

namespace Slashworks\ContaoSocialMediaBundle\Tests;

use Slashworks\ContaoSocialMediaBundle\ContaoSocialMediaBundle;
use PHPUnit\Framework\TestCase;

class ContaoSocialMediaBundleTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $bundle = new ContaoSocialMediaBundle();

        $this->assertInstanceOf('Slashworks\ContaoSocialMediaBundle\ContaoSocialMediaBundle', $bundle);
    }
}

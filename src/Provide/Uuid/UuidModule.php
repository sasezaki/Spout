<?php
/**
 * This file is part of the Mackstar.Spout package.
 *
 * (c) Richard McIntyre <richard.mackstar@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mackstar\Spout\Provide\Uuid;

use Ray\Di\AbstractModule;

class UuidModule extends AbstractModule
{

    public function configure()
    {
        $this
            ->bind('Rhumsaa\Uuid\Uuid')
            ->toProvider('Mackstar\Spout\Provide\Uuid\UuidProvider');
    }

}

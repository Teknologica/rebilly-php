<?php
/**
 * This file is part of the PHP Rebilly API package.
 *
 * (c) 2015 Rebilly SRL
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Rebilly\Tests;

use RuntimeException;
use Rebilly\Client;
use Rebilly\Rest\File;

/**
 * Class FileTest.
 *
 * @group wip
 */
class FileTest extends TestCase
{
    public function testFile()
    {
        $client = new Client([
            'apiKey' => getenv('REBILLY_TEST_APIKEY'),
            'baseUrl' => getenv('REBILLY_TEST_HOST'),
            // 'httpHandler' => null,
            // 'logger' => new NullLogger(),
        ]);

        $file = $client->invoices()->loadPdf('c79c2e4d-4209-47e0-8459-26416d1fb749-1');

        if ($file instanceof File) {
            $filename = tempnam(sys_get_temp_dir(), 'Invoice');
            $file->save($filename);

            $this->assertTrue(file_exists($filename));
            $this->assertEquals($file->getSize(), filesize($filename));
        } else {
            throw new RuntimeException('Cannot download file');
        }
    }
}

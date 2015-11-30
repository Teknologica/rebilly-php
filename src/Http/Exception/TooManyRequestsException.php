<?php
/**
 * This file is part of the PHP Rebilly API package.
 *
 * (c) 2015 Rebilly SRL
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Rebilly\Http\Exception;

use Exception;

/**
 * Class TooManyRequestsException.
 *
 * @author Arman Tuyakbayev <arman.tuyakbayev@rebilly.com>
 * @version 0.1
 */
final class TooManyRequestsException extends ClientException
{
    private $retryAfter = '';
    private $rateLimit = 0;
    private $rateRemaining = 0;

    public function __construct($message = "", $retryAfter = '', $rateLimit = 0, $rateRemaining = 0, $code = 0, Exception $previous = null)
    {
        $this->retryAfter = $retryAfter;
        $this->rateLimit = $rateLimit;
        $this->rateRemaining = $rateRemaining;

        parent::__construct(429, $message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getRetryAfter()
    {
        return $this->retryAfter;
    }

    /**
     * @return int
     */
    public function getRateLimit()
    {
        return $this->rateLimit;
    }

    /**
     * @return int
     */
    public function getRateRemaining()
    {
        return $this->rateRemaining;
    }
}

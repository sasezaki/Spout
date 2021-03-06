<?php
/**
 * This file is part of the Mackstar.Spout package.
 *
 * (c) Richard McIntyre <richard.mackstar@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mackstar\Spout\App\Interceptor\Users;

use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;


class PasswordHider implements MethodInterceptor
{

    private $_passwordField = 'password';

    public function invoke(MethodInvocation $invocation)
    {
        $response = $invocation->proceed();
        $this->removeFromSingleRecord($response->body);
        $this->removeFromArrayRecord($response->body);
        return $response;
    }

    private function removeFromArrayRecord(&$body)
    {
        foreach ($body as &$records) {
            if (!isset($records[0]) || !is_array($records[0])) {
                continue;
            }
            foreach($records as &$record) {
                $this->removePassword($record);
            }
        }
    }

    private function removeFromSingleRecord(&$body)
    {
        foreach ($body as &$record) {
            if (isset($record[0]) && is_array($record[0])) {
                continue;
            }
            $this->removePassword($record);
        }
    }

    private function removePassword(&$record)
    {
        if (isset($record[$this->_passwordField])) {
            unset($record[$this->_passwordField]);
        }
    }
}

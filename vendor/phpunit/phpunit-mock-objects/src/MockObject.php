<?php
/*
 * This file is part of the phpunit-mock-objects package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\MockObject\Builder\InvocationMocker;
use PHPUnit\Framework\MockObject\Matcher\Invocation;

/**
 * Interface for all mock objects which are generated by
 * MockBuilder.
 *
 * @method InvocationMocker method($constraint)
 */
interface PHPUnit_Framework_MockObject_MockObject /*extends Verifiable*/
{
    /**
     * Registers a new expectation in the mock object and returns the match
     * object which can be infused with further details.
     *
     * @param Invocation $matcher
     *
     * @return InvocationMocker
     */
    public function expects(Invocation $matcher);

    /**
     * @return InvocationMocker
     */
    public function __phpunit_setOriginalObject($originalObject);

    /**
     * @return InvocationMocker
     */
    public function __phpunit_getInvocationMocker();

    /**
     * Verifies that the current expectation is valid. If everything is OK the
     * code should just return, if not it must throw an exception.
     *
     * @throws ExpectationFailedException
     */
    public function __phpunit_verify();

    /**
     * @return bool
     */
    public function __phpunit_hasMatchers();
}

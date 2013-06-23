<?php
/**
 * This file is part of the phpunit-mink library.
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @copyright Alexander Obuhovich <aik.bold@gmail.com>
 * @link      https://github.com/aik099/phpunit-mink
 */

/**
 * PHPUnit
 *
 * Copyright (c) 2010-2013, Sebastian Bergmann <sebastian@phpunit.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHPUnit_Selenium
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2010-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 1.0.0
 */

if ( isset($_COOKIE['PHPUNIT_SELENIUM_TEST_ID']) &&
	!isset($_GET['PHPUNIT_SELENIUM_TEST_ID']) &&
	extension_loaded('xdebug')
) {
	$GLOBALS['PHPUNIT_FILTERED_FILES'][] = __FILE__;

	$data = xdebug_get_code_coverage();
	xdebug_stop_code_coverage();

	foreach ($GLOBALS['PHPUNIT_FILTERED_FILES'] as $file) {
		unset($data[$file]);
	}

	if ( is_string($GLOBALS['PHPUNIT_COVERAGE_DATA_DIRECTORY']) &&
		is_dir($GLOBALS['PHPUNIT_COVERAGE_DATA_DIRECTORY'])
	) {
		$file = $GLOBALS['PHPUNIT_COVERAGE_DATA_DIRECTORY'] .
			DIRECTORY_SEPARATOR . md5($_SERVER['SCRIPT_FILENAME']);
	}
	else {
		$file = $_SERVER['SCRIPT_FILENAME'];
	}

	file_put_contents(
		$name = $file . '.' . md5(uniqid(rand(), true)) . '.' . $_COOKIE['PHPUNIT_SELENIUM_TEST_ID'],
		serialize($data)
	);
}
<?php

/**
 * Showcase API
 * PHP version 7.4
 *
 * @package OpenAPIServer
 * @author  OpenAPI Generator team
 * @link    https://github.com/openapitools/openapi-generator
 */

/**
 * API for FHSTP Showcase
 * The version of the OpenAPI document: 1.0.0
 * Generated by: https://github.com/openapitools/openapi-generator.git
 */

/**
 * NOTE: This class is auto generated by the openapi generator program.
 * https://github.com/openapitools/openapi-generator
 * Please update the test case below to test the model.
 */
namespace OpenAPIServer\Model;

use PHPUnit\Framework\TestCase;
use OpenAPIServer\Model\SourceType;

/**
 * SourceTypeTest Class Doc Comment
 *
 * @package OpenAPIServer\Model
 * @author  OpenAPI Generator team
 * @link    https://github.com/openapitools/openapi-generator
 *
 * @coversDefaultClass \OpenAPIServer\Model\SourceType
 */
class SourceTypeTest extends TestCase
{

    /**
     * Setup before running any test cases
     */
    public static function setUpBeforeClass(): void
    {
    }

    /**
     * Setup before running each test case
     */
    public function setUp(): void
    {
    }

    /**
     * Clean up after running each test case
     */
    public function tearDown(): void
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass(): void
    {
    }

    /**
     * Test "SourceType"
     */
    public function testSourceType()
    {
        $testSourceType = new SourceType();
        $namespacedClassname = SourceType::getModelsNamespace() . '\\SourceType';
        $this->assertSame('\\' . SourceType::class, $namespacedClassname);
        $this->assertTrue(
            class_exists($namespacedClassname),
            sprintf('Assertion failed that "%s" class exists', $namespacedClassname)
        );
        $this->markTestIncomplete(
            'Test of "SourceType" model has not been implemented yet.'
        );
    }

    /**
     * Test attribute "id"
     */
    public function testPropertyId()
    {
        $this->markTestIncomplete(
            'Test of "id" property in "SourceType" model has not been implemented yet.'
        );
    }

    /**
     * Test attribute "title"
     */
    public function testPropertyTitle()
    {
        $this->markTestIncomplete(
            'Test of "title" property in "SourceType" model has not been implemented yet.'
        );
    }

    /**
     * Test attribute "icon"
     */
    public function testPropertyIcon()
    {
        $this->markTestIncomplete(
            'Test of "icon" property in "SourceType" model has not been implemented yet.'
        );
    }

    /**
     * Test attribute "language"
     */
    public function testPropertyLanguage()
    {
        $this->markTestIncomplete(
            'Test of "language" property in "SourceType" model has not been implemented yet.'
        );
    }

    /**
     * Test getOpenApiSchema static method
     * @covers ::getOpenApiSchema
     */
    public function testGetOpenApiSchema()
    {
        $schemaArr = SourceType::getOpenApiSchema();
        $this->assertIsArray($schemaArr);
    }
}

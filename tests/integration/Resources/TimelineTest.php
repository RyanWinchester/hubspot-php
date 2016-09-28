<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Timeline;

class TimelineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Demo application to be used for testing.
     *
     * @see https://app.hubspot.com/developers/62515/application/36472
     */
    const APP_ID = 36472;

    /**
     * @var Timeline
     */
    protected $timeline;

    /**
     * @var int
     */
    private $eventTypeId;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->timeline = new Timeline(new Client([
            'key'    => 'demo',
            'userId' => '215482',
        ]));

        $response = $this->createEventType();
        $eventType = json_decode((string) $response->getBody());

        // Set this for future tests
        if ($id = $eventType->id) {
            $this->eventTypeId = $id;
        }

        sleep(1);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        // Make sure that everything still exists
        if (!$this->timeline || !$this->eventTypeId) {
            return false;
        }

        $this->deleteEventType();
    }

    /**
     * @test
     */
    public function createOrUpdate()
    {
        // @todo
    }

    /**
     * @test
     */
    public function getEventTypes()
    {
        $response = $this->timeline->getEventTypes(self::APP_ID);
        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }

    /**
     * @test
     */
    public function createEventType()
    {
        $name = 'Event name';
        $headerTemplate = 'Event header template';
        $detailTemplate = 'Event detail template';
        $objectType = 'CONTACT';

        $response = $this->timeline->createEventType(
            self::APP_ID,
            $name,
            $headerTemplate,
            $detailTemplate,
            $objectType
        );

        $eventType = json_decode((string) $response->getBody());

        $this->assertEquals($name, $eventType->name);
        $this->assertEquals($headerTemplate, $eventType->headerTemplate);
        $this->assertEquals($detailTemplate, $eventType->detailTemplate);
        $this->assertEquals($objectType, $eventType->objectType);
        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }

    /**
     * @test
     */
    public function updateEventType()
    {
        // @todo
    }

    /**
     * @test
     */
    public function deleteEventType()
    {
        $response = $this->timeline->deleteEventType(self::APP_ID, $this->eventTypeId);
        $this->assertEquals(204, $response->getStatusCode());

        // Remove event type id from class since we just deleted it.
        $this->eventTypeId = null;

        return $response;
    }

    /**
     * @test
     */
    public function getEventTypeProperties()
    {
        // @todo
    }

    /**
     * @test
     */
    public function createEventTypeProperty()
    {
        // @todo
    }

    /**
     * @test
     */
    public function updateEventTypeProperty()
    {
        // @todo
    }

    /**
     * @test
     */
    public function deleteEventTypeProperty()
    {
        // @todo
    }
}

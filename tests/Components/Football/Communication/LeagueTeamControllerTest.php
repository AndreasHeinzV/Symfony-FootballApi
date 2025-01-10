<?php

declare(strict_types=1);

namespace App\Tests\Components\Football\Communication;

use App\Components\Api\Business\Model\ApiRequesterInterface;
use App\Components\Football\Persitence\Mapper\LeaguesMapper;
use App\Components\Football\Persitence\Mapper\LeagueTeamsMapper;
use App\Components\Football\Persitence\Mapper\PlayerMapper;
use App\Components\Football\Persitence\Mapper\TeamMapper;
use App\Tests\Fixtures\ApiRequest\ApiRequestFaker;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LeagueTeamControllerTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $container = static::getContainer();
        $apiRequesterFaker = new ApiRequestFaker(
            $container->get(PlayerMapper::class),
            $container->get(TeamMapper::class),
            $container->get(LeaguesMapper::class),
            $container->get(LeagueTeamsMapper::class),

        );
        $container->set(ApiRequesterInterface::class, $apiRequesterFaker);
    }
    public function testGetLeagueTeam(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $crawler = $client->request('GET', '/');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Hello World")')->count());
    }
}

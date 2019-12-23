<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command as BaseCommand;

class EchoServerCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'echo-server {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call commands for Laravel Echo Server.';

    /**
     * Execute the console command.
     *
     * @param Client $client
     */
    public function handle(Client $client): void
    {
        $path = $this->argument('path');

        $this->info("Calling endpoint: $path");

        $response = $client->get($path, [
            'base_uri' => 'http://node:6001/apps/_/',
            'headers' => [
                'Authorization' => 'Bearer _',
            ],
        ]);

        $body = json_decode($response->getBody(), false, 512, JSON_THROW_ON_ERROR);
        $this->output->writeln(json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}

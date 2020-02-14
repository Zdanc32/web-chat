<?php

namespace App\Controller\Publisher;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\Mercure\Update;

class ChatPublisherController
{
    public function __invoke(Publisher $publisher): Response
    {
        $update = new Update(
            'http://api.web-chat.test/api/chats',
            json_encode(['text' => 'asdf'])
        );

        $publisher($update);

        return new Response('published!');
    }
}
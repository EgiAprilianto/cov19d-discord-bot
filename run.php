<?php

include __DIR__.'/vendor/autoload.php';

use Discord\DiscordCommandClient;

$token = 'Njk4NDI0ODc3MjA3NjUwMzQ0.XpGZGA.XeJOt9uKICYj-BvCEUn3cP5yG2w';
$discord = new DiscordCommandClient([
    'token' => $token,
    'prefix' => '#',
    'name' => 'COV19D',
    'description' => 'The latest information about COVID19 | Contact : eggyaprilianto@gmail.com',
]);

$discord->on('ready', function ($discord) {
    echo "Bot is ready.", PHP_EOL;
  
    // Listen for events here
    $discord->on('message', function ($message) {
        echo "Recieved a message from {$message->author->username}: {$message->content}", PHP_EOL;
    });
});

$discord->registerCommand('info', function($message)
{	
	$get = file_get_contents("https://api.kawalcorona.com/indonesia");
	$hasil = json_decode($get);
	$pesan = 
"
```
Cek Kasus Covid19 Di Indonesia | COV19D

Positif : ".$hasil[0]->positif."
Sembuh  : ".$hasil[0]->sembuh."
Meninggal : ".$hasil[0]->meninggal."

Last update : ".date('d M Y H:i:s')."

```
";

	$message->channel->sendMessage($pesan);
}, [
  'description' => 'Cek kasus covid19 hari ini.',
]);



$discord->run();

<?php

/**
 * TODOLIST
 * Školní projekt k seznámení s Nette a ORM
 * 
 * @author MMR <miroslav.mrazek@gmail.com>
 */


# Odkomentujte, pokud bude potřeba odstavit aplikaci kvůli údržbě.
// require '.maintenance.php';

# Necháme bootstrap vytvořit DI kontejner.
$container = require __DIR__ . '/../app/bootstrap.php';

# Spustíme aplikaci.
$container->application->run();

# Zein\Console

library for running php in cli. Inspired from symphony/console.

### How to
Before you start to use this library, please make your autoload.php
to make App and Commands namespace.

#### Directory structure
```
app
---- AppConsole.php
commands
---- Make.php
app.php
vendor
```
#### Make.php
```PHP
<?php
namespace Commands;
use Zein\Console\Command\Contract;

class Make extends Contract
{
    protected array $signatures = [
        'make:plugin' => ['description' => 'Make a plugin', 'input' => '{pluginname}']
    ];
    
    protected array $options = [
        '--type' => 'Set plugin type'
    ];

    public function handle()
    {
        // Retrieve all option
        $option = $this->option();

        // Retrieve single option
        $option = $this->option('type');

        // Retrive all argument
        $argument = $this->argument();

        // Retrieve single argument
        $argument = $this->argument('type');

        // running code here
    }
}
```

#### AppConsole.php
```PHP
<?php
namespace App;
use Zein\Console\{Console,Argument,Output\Output};

class AppConsole extends Console
{
    private object $argument;

    public function __construct()
    {
        $this->argument = new Argument;
        $this->argument->strict = false;
        $this->argument->fetch();    
    }

    public function run()
    {
        if (!$this->argument->get())
        {
            Output::help($this->commandClass);
        }

        $Parameter = $this->argument->getParameter();
        $Option = $this->argument->getOption();

        // Run command
        $Command = $this->{$this->seperateCommand($Parameter[0])};
        $CommandInstance = new $Command($Option, $Parameter);

        $CommandInstance->handle();
    }
}
```

#### app.php
```PHP
<?php

use App\AppConsole;

require __DIR__ . '/vendor/autoload.php';

$AppConsole = new AppConsole;
$AppConsole->register([
    'make' => \Commands\Make::class,
]);

$AppConsole->run();

```

#### Running 
```BASH
php app.php make:plugin dummies --type=report
```
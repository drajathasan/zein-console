# Zein\Console

library for running php in cli. Inspired from symphony/console.

### How to
Directory structure
```
app
---- AppConsole.php
commands
---- YourCommand.php
app.php
vendor
```
#### yourCommand.php
```PHP
<?php
namespace Commands;
use Zein\Console\Command\Contract;

class YourCommand extends Contract
{
    protected array $signatures = [
        'make:plugin' => ['description' => 'Make a plugin', 
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
$AppConsole->register(require __DIR__ . '/commands.php');

$AppConsole->run();

```

#### Running 
```BASH
php app.php make:plugin dummies --type=report
```
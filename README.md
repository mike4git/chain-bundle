# chain-bundle
This bundle offers a generic way of creating a chain of (potentially responsible) handlers which delegate or finish the task. 

May be you have already heard about the [Chain of Responsability Pattern](https://en.wikipedia.org/wiki/Chain-of-responsibility_pattern)?!

If you think you can handle that with Symfony Events, do so.
If you think you can use Messenger-Middleware-Stack instead, of course - feel free.

But if you are searching for a generic way to put services to a chain, where each of the chain links can decides what is going on, use this bundle.

## Installation

### Require the bundle

   ```shell
   composer require mike4git/chain-bundle
   ```

That's it.

## Usage

Imagine you have a processing chain.
And each link in the chain may need to perform a specific operation on a workpiece until the entire workpiece is complete.

Or you have a series of areas of responsibility, and a request passes through this [Chain of Responsabilities](https://en.wikipedia.org/wiki/Chain-of-responsibility_pattern) until it reaches the one that can handle and respond to it.

In both cases, the chain-bundle helps you create a simple, structured solution based on a common design pattern.

All you need is a workpiece or a request represented as a PHP object. The only requirement is that this object must implement the marker interface `Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext`.

Each handler or responsible unit in your chain has two constraints:

1. They must implement the Mike4Git\ChainBundle\Handler\ChainHandlerInterface, which requires two methods:
* `supports()` – to check if the handler can process the given request
* `handle()` – to perform the actual processing

2. Handlers are registered as tagged services, like this:

```yaml
Mike4Git\ChainBundle\Tests\FizzBuzz\FizzHandler:
    tags:
        - { name: 'chain.handler', chain: 'fizzbuzz', priority: 100 }
    public: true
```

To trigger the processing chain, simply use the following code:

```php
/** stop handling if fitting handler found - by default it is true */
$stopOnFound = false;

/** @var ChainExecutor $executor */
$executor = $container->get(ChainExecutor::class);
$processedWorkpiece = $executor->execute('Name Of The Processing Chain', $workpiece, $stopOnFound);
```

That's it.

### Example
Let's implement a simple FizzBuzz chain using the chain-bundle.
We want different handlers to decide if a number should be replaced with "Fizz", "Buzz", "FizzBuzz", or left as-is.

#### Define the Context
```php
use Mike4Git\ChainBundle\Handler\Context\ChainHandlerContext;

class FizzBuzzContext implements ChainHandlerContext
{
    public function __construct(
        public int $number,
        public string $result = ''
    ) {}
}
```

#### Create Handlers

One simple example for the `FizzBuzzHandler`:

```php
use Mike4Git\ChainBundle\Handler\ChainHandlerInterface;

class FizzBuzzHandler implements ChainHandlerInterface
{
    public function supports(ChainHandlerContext $context): bool
    {
        return $context instanceof FizzBuzzContext
            && $context->number % 15 === 0;
    }

    public function handle(ChainHandlerContext $context): ChainHandlerContext
    {
        $context->result = 'FizzBuzz';
        return $context;
    }
}
```

You can then add FizzHandler and BuzzHandler similarly and don't forget the DefaultNumberHandler.

#### Register Handlers in services.yaml

```yaml
App\FizzBuzz\FizzBuzzHandler:
    tags:
        - { name: 'chain.handler', chain: 'fizzbuzz', priority: 300 }
```

#### Run the Chain

Finally, you can run the chain in your controller or service:

```php
/** @var ChainExecutor $executor */
$executor = $container->get(ChainExecutor::class);

$context = new FizzBuzzContext(15);
$resultContext = $executor->execute('fizzbuzz', $context, true);

echo $resultContext->result; // Outputs: FizzBuzz
```

## Contribution

Feel free to open issues for any bug, feature request, or other ideas.

Please remember to create an issue before creating large pull requests.

### Local Development

To develop on local machine, the vendor dependencies are required.

```shell
bin/composer install
```

We use composer scripts for our main quality tools. They can be executed via the `bin/composer` file as well.

```shell
bin/composer cs:fix
bin/composer phpstan
bin/composer tests
```

# chain-bundle
This bundle offers a generic way of creating a chain of (potentially responsible) handlers which delegate or finish the task. 

May be you have already heard about the (Chain of Repsonability Pattern)[https://en.wikipedia.org/wiki/Chain-of-responsibility_pattern]?!

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

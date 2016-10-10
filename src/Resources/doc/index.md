# IbrowsJsonPatchBundle

The IbrowsJsonPatchBundle provides a RFC 6902 compliant PHP Patch Applier. It contains symfony container bindings.

## Installation

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
    $ composer require ibrows/json-patch
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding the following line in the `app/AppKernel.php`
file of your project:

```php
    <?php
    // app/AppKernel.php
    
    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...
                new Ibrows\JsonPatch\IbrowsJsonPatchBundle(),
            );
            
            // ...
        }
    }
```

## Patch

The patching system is able to apply JSON Patches to arrays & objects. 

### Custom Address

To support custom types, implement `\Ibrows\RestBundle\Patch\AddressResolverInterface` and tag your service with the tag `ibrows_rest.patch.address_resolver`.
The address resolver has to return a `\Ibrows\RestBundle\Patch\AddressInterface`.

### Custom Operation

To add a custom operation, implement `\Ibrows\RestBundle\Patch\OperationApplierInterface` and tag your service with the tag `ibrows_rest.patch.operation_applier`.

Tag Attributes:
 - `operation` - The name of the operation to support.
 - `priority` - The priority of your implementation.

## Testing

Setup the test suite using [Composer](http://getcomposer.org/):

```bash
    $ composer install --dev
```

Run it using PHPUnit:

```bash
    $ phpunit
```
# Patch

The patching system is able to apply JSON Patches to arrays & objects. 

# Custom Address

To support custom types, implement `\Ibrows\JsonPatch\AddressResolverInterface` and tag your service with the tag `ibrows_rest.patch.address_resolver`.
The address resolver has to return a `\Ibrows\JsonPatch\AddressInterface`.

# Custom Operation

To add a custom operation, implement `\Ibrows\JsonPatchOperationApplierInterface` and tag your service with the tag `ibrows_rest.patch.operation_applier`.

Tag Attributes:
 - `operation` - The name of the operation to support.
 - `priority` - The priority of your implementation.

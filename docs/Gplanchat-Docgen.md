Namespace `Gplanchat\Docgen`
==========



## Classes

### Class `AbstractCallableEntry`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#class-abstractcallableentry)

Base class for callable entries (methods and functions).

#### Implemented Interfaces

* `Gplanchat\Docgen\EntryInterface`


#### Used Traits

* `Gplanchat\Docgen\EntryTrait`
* `Gplanchat\Docgen\ParameterAwareTrait`


#### Method `setReturnType`

Defines the callable's return type

##### Parameter `returnType`


* *type* : Gplanchat\Docgen\AbstractCallableEntry
* *is nullable* : Yes


#### Method `getReturnType`

Get the callable's return type

#### Method `parse`



##### Parameter `re`


* *type* : Gplanchat\Docgen\AbstractCallableEntry
* *is nullable* : No


#### Method `__construct`



##### Parameter `name`


* *type* : Gplanchat\Docgen\AbstractCallableEntry
* *is nullable* : Yes


##### Parameter `parentEntry`


* *type* : Gplanchat\Docgen\AbstractCallableEntry
* *is nullable* : Yes
* *default value* : `NULL`


#### Method `getName`



#### Method `setName`



##### Parameter `name`


* *type* : Gplanchat\Docgen\AbstractCallableEntry
* *is nullable* : Yes


#### Method `getDescription`



#### Method `setDescription`



##### Parameter `description`


* *type* : Gplanchat\Docgen\AbstractCallableEntry
* *is nullable* : Yes


#### Method `getParentEntry`



#### Method `setParentEntry`



##### Parameter `parent`


* *type* : Gplanchat\Docgen\AbstractCallableEntry
* *is nullable* : No


#### Method `setParameters`



##### Parameter `parameters`


* *type* : array
* *is nullable* : No


#### Method `addParameter`



##### Parameter `parameterEntry`


* *type* : Gplanchat\Docgen\AbstractCallableEntry
* *is nullable* : No


#### Method `getParameters`





### Trait `ClassAwareTrait`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#trait-classawaretrait)

Trait designed for entries containing classes

#### Method `setClasses`

Define a new class entries list

##### Parameter `classes`


* *type* : array
* *is nullable* : No


#### Method `addClass`

Add a new class entry to the list

##### Parameter `classEntry`


* *type* : Gplanchat\Docgen\ClassAwareTrait
* *is nullable* : No


#### Method `getClasses`

Get all class entries in the list



### Class `ClassEntry`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#class-classentry)

Class entry manager. Handles every class's element delcaration.

#### Implemented Interfaces

* `Gplanchat\Docgen\EntryInterface`


#### Used Traits

* `Gplanchat\Docgen\EntryTrait`
* `Gplanchat\Docgen\ConstantAwareTrait`
* `Gplanchat\Docgen\ParameterAwareTrait`
* `Gplanchat\Docgen\MethodAwareTrait`


#### Method `setType`

Define the class entry type

##### Parameter `type`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : Yes


#### Method `getType`

Get the class entry type

#### Method `setParentClass`

Define the parent class' name

##### Parameter `parentClass`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : Yes


#### Method `getParentClass`

Get the parent class' name

#### Method `setParentInterfaces`

Define the parent interfaces names list

##### Parameter `parentInterfaces`


* *type* : array
* *is nullable* : No


#### Method `addParentInterface`

Add a parent interface name to the list

##### Parameter `parentInterface`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : Yes


#### Method `getParentInterfaces`

Get the parent interfaces names list

#### Method `setUsedTraits`

Define the used traits names list

##### Parameter `usedTraits`


* *type* : array
* *is nullable* : No


#### Method `addUsedTrait`

Add an used trait name to the list

##### Parameter `usedTrait`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : Yes


#### Method `getUsedTraits`

Get the used traits names list

#### Method `parse`

Parse class's definition by reflection

##### Parameter `re`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : Yes
* *default value* : `NULL`


#### Method `parseMethodDeclaration`

Parse DocBlock method declaration (for virtual methods using __call() magic)

##### Parameter `methodDeclaration`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : Yes


#### Method `__construct`



##### Parameter `name`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : Yes


##### Parameter `parentEntry`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : Yes
* *default value* : `NULL`


#### Method `getName`



#### Method `setName`



##### Parameter `name`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : Yes


#### Method `getDescription`



#### Method `setDescription`



##### Parameter `description`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : Yes


#### Method `getParentEntry`



#### Method `setParentEntry`



##### Parameter `parent`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : No


#### Method `setConstants`



##### Parameter `constants`


* *type* : array
* *is nullable* : No


#### Method `addConstant`



##### Parameter `constantEntry`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : No


#### Method `getConstants`



#### Method `setParameters`



##### Parameter `parameters`


* *type* : array
* *is nullable* : No


#### Method `addParameter`



##### Parameter `parameterEntry`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : No


#### Method `getParameters`



#### Method `setMethods`



##### Parameter `methods`


* *type* : array
* *is nullable* : No


#### Method `addMethod`



##### Parameter `methodEntry`


* *type* : Gplanchat\Docgen\ClassEntry
* *is nullable* : No


#### Method `getMethods`





### Class `ComponentEntry`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#class-componententry)

Component entry manager. A component is a group of namespaces and/or classes and/or functions grouped as a whole that builds a feature. Class ComponentEntry

#### Implemented Interfaces

* `Gplanchat\Docgen\EntryInterface`


#### Used Traits

* `Gplanchat\Docgen\EntryTrait`
* `Gplanchat\Docgen\FileAwareTrait`
* `Gplanchat\Docgen\NamespaceAwareTrait`
* `Gplanchat\Docgen\ClassAwareTrait`
* `Gplanchat\Docgen\ConstantAwareTrait`
* `Gplanchat\Docgen\FunctionAwareTrait`


#### Method `parse`

Parse a directory path, searching for

##### Parameter `sourcePath`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : Yes


#### Method `__construct`



##### Parameter `name`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : Yes


##### Parameter `parentEntry`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : Yes
* *default value* : `NULL`


#### Method `getName`



#### Method `setName`



##### Parameter `name`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : Yes


#### Method `getDescription`



#### Method `setDescription`



##### Parameter `description`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : Yes


#### Method `getParentEntry`



#### Method `setParentEntry`



##### Parameter `parent`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : No


#### Method `setFiles`



##### Parameter `files`


* *type* : array
* *is nullable* : No


#### Method `addFile`



##### Parameter `fileEntry`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : No


#### Method `getFiles`



#### Method `hasFile`



##### Parameter `fileName`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : Yes


#### Method `getFile`



##### Parameter `fileName`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : Yes


#### Method `setNamespaces`



##### Parameter `namespaces`


* *type* : array
* *is nullable* : No


#### Method `addNamespace`



##### Parameter `namespaceEntry`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : No


#### Method `getNamespaces`



#### Method `hasNamespace`



##### Parameter `namespaceName`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : Yes


#### Method `getNamespace`



##### Parameter `namespaceName`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : Yes


#### Method `setClasses`

Define a new class entries list

##### Parameter `classes`


* *type* : array
* *is nullable* : No


#### Method `addClass`

Add a new class entry to the list

##### Parameter `classEntry`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : No


#### Method `getClasses`

Get all class entries in the list

#### Method `setConstants`



##### Parameter `constants`


* *type* : array
* *is nullable* : No


#### Method `addConstant`



##### Parameter `constantEntry`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : No


#### Method `getConstants`



#### Method `setFunctions`



##### Parameter `functions`


* *type* : array
* *is nullable* : No


#### Method `addFunction`



##### Parameter `functionEntry`


* *type* : Gplanchat\Docgen\ComponentEntry
* *is nullable* : No


#### Method `getFunctions`





### Trait `ConstantAwareTrait`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#trait-constantawaretrait)



#### Method `setConstants`



##### Parameter `constants`


* *type* : array
* *is nullable* : No


#### Method `addConstant`



##### Parameter `constantEntry`


* *type* : Gplanchat\Docgen\ConstantAwareTrait
* *is nullable* : No


#### Method `getConstants`





### Class `ConstantEntry`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#class-constantentry)



#### Implemented Interfaces

* `Gplanchat\Docgen\EntryInterface`


#### Used Traits

* `Gplanchat\Docgen\EntryTrait`


#### Method `setValue`



##### Parameter `value`


* *type* : Gplanchat\Docgen\ConstantEntry
* *is nullable* : Yes


#### Method `getValue`



#### Method `__construct`



##### Parameter `name`


* *type* : Gplanchat\Docgen\ConstantEntry
* *is nullable* : Yes


##### Parameter `parentEntry`


* *type* : Gplanchat\Docgen\ConstantEntry
* *is nullable* : Yes
* *default value* : `NULL`


#### Method `getName`



#### Method `setName`



##### Parameter `name`


* *type* : Gplanchat\Docgen\ConstantEntry
* *is nullable* : Yes


#### Method `getDescription`



#### Method `setDescription`



##### Parameter `description`


* *type* : Gplanchat\Docgen\ConstantEntry
* *is nullable* : Yes


#### Method `getParentEntry`



#### Method `setParentEntry`



##### Parameter `parent`


* *type* : Gplanchat\Docgen\ConstantEntry
* *is nullable* : No




### Interface `EntryInterface`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#interface-entryinterface)



#### Method `__construct`



##### Parameter `name`


* *type* : Gplanchat\Docgen\EntryInterface
* *is nullable* : Yes


##### Parameter `parent`


* *type* : Gplanchat\Docgen\EntryInterface
* *is nullable* : Yes
* *default value* : `NULL`


#### Method `getName`



#### Method `setName`



##### Parameter `name`


* *type* : Gplanchat\Docgen\EntryInterface
* *is nullable* : Yes


#### Method `getDescription`



#### Method `setDescription`



##### Parameter `description`


* *type* : Gplanchat\Docgen\EntryInterface
* *is nullable* : Yes


#### Method `getParentEntry`



#### Method `setParentEntry`



##### Parameter `parent`


* *type* : Gplanchat\Docgen\EntryInterface
* *is nullable* : No




### Trait `EntryTrait`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#trait-entrytrait)



#### Method `__construct`



##### Parameter `name`


* *type* : Gplanchat\Docgen\EntryTrait
* *is nullable* : Yes


##### Parameter `parentEntry`


* *type* : Gplanchat\Docgen\EntryTrait
* *is nullable* : Yes
* *default value* : `NULL`


#### Method `getName`



#### Method `setName`



##### Parameter `name`


* *type* : Gplanchat\Docgen\EntryTrait
* *is nullable* : Yes


#### Method `getDescription`



#### Method `setDescription`



##### Parameter `description`


* *type* : Gplanchat\Docgen\EntryTrait
* *is nullable* : Yes


#### Method `getParentEntry`



#### Method `setParentEntry`



##### Parameter `parent`


* *type* : Gplanchat\Docgen\EntryTrait
* *is nullable* : No




### Class `ExtensionEntry`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#class-extensionentry)

Extension entry manager.

#### Implemented Interfaces

* `Gplanchat\Docgen\EntryInterface`


#### Used Traits

* `Gplanchat\Docgen\EntryTrait`
* `Gplanchat\Docgen\NamespaceAwareTrait`
* `Gplanchat\Docgen\ClassAwareTrait`
* `Gplanchat\Docgen\ConstantAwareTrait`
* `Gplanchat\Docgen\FunctionAwareTrait`


#### Method `parse`

Generate documentation for a PHP native extension

##### Parameter `re`


* *type* : Gplanchat\Docgen\ExtensionEntry
* *is nullable* : No


#### Method `__construct`



##### Parameter `name`


* *type* : Gplanchat\Docgen\ExtensionEntry
* *is nullable* : Yes


##### Parameter `parentEntry`


* *type* : Gplanchat\Docgen\ExtensionEntry
* *is nullable* : Yes
* *default value* : `NULL`


#### Method `getName`



#### Method `setName`



##### Parameter `name`


* *type* : Gplanchat\Docgen\ExtensionEntry
* *is nullable* : Yes


#### Method `getDescription`



#### Method `setDescription`



##### Parameter `description`


* *type* : Gplanchat\Docgen\ExtensionEntry
* *is nullable* : Yes


#### Method `getParentEntry`



#### Method `setParentEntry`



##### Parameter `parent`


* *type* : Gplanchat\Docgen\ExtensionEntry
* *is nullable* : No


#### Method `setNamespaces`



##### Parameter `namespaces`


* *type* : array
* *is nullable* : No


#### Method `addNamespace`



##### Parameter `namespaceEntry`


* *type* : Gplanchat\Docgen\ExtensionEntry
* *is nullable* : No


#### Method `getNamespaces`



#### Method `hasNamespace`



##### Parameter `namespaceName`


* *type* : Gplanchat\Docgen\ExtensionEntry
* *is nullable* : Yes


#### Method `getNamespace`



##### Parameter `namespaceName`


* *type* : Gplanchat\Docgen\ExtensionEntry
* *is nullable* : Yes


#### Method `setClasses`

Define a new class entries list

##### Parameter `classes`


* *type* : array
* *is nullable* : No


#### Method `addClass`

Add a new class entry to the list

##### Parameter `classEntry`


* *type* : Gplanchat\Docgen\ExtensionEntry
* *is nullable* : No


#### Method `getClasses`

Get all class entries in the list

#### Method `setConstants`



##### Parameter `constants`


* *type* : array
* *is nullable* : No


#### Method `addConstant`



##### Parameter `constantEntry`


* *type* : Gplanchat\Docgen\ExtensionEntry
* *is nullable* : No


#### Method `getConstants`



#### Method `setFunctions`



##### Parameter `functions`


* *type* : array
* *is nullable* : No


#### Method `addFunction`



##### Parameter `functionEntry`


* *type* : Gplanchat\Docgen\ExtensionEntry
* *is nullable* : No


#### Method `getFunctions`





### Trait `FileAwareTrait`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#trait-fileawaretrait)



#### Method `setFiles`



##### Parameter `files`


* *type* : array
* *is nullable* : No


#### Method `addFile`



##### Parameter `fileEntry`


* *type* : Gplanchat\Docgen\FileAwareTrait
* *is nullable* : No


#### Method `getFiles`



#### Method `hasFile`



##### Parameter `fileName`


* *type* : Gplanchat\Docgen\FileAwareTrait
* *is nullable* : Yes


#### Method `getFile`



##### Parameter `fileName`


* *type* : Gplanchat\Docgen\FileAwareTrait
* *is nullable* : Yes




### Class `FileEntry`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#class-fileentry)



#### Implemented Interfaces

* `Gplanchat\Docgen\EntryInterface`


#### Used Traits

* `Gplanchat\Docgen\EntryTrait`
* `Gplanchat\Docgen\NamespaceAwareTrait`
* `Gplanchat\Docgen\ClassAwareTrait`
* `Gplanchat\Docgen\ConstantAwareTrait`
* `Gplanchat\Docgen\FunctionAwareTrait`


#### Method `parse`



#### Method `__construct`



##### Parameter `name`


* *type* : Gplanchat\Docgen\FileEntry
* *is nullable* : Yes


##### Parameter `parentEntry`


* *type* : Gplanchat\Docgen\FileEntry
* *is nullable* : Yes
* *default value* : `NULL`


#### Method `getName`



#### Method `setName`



##### Parameter `name`


* *type* : Gplanchat\Docgen\FileEntry
* *is nullable* : Yes


#### Method `getDescription`



#### Method `setDescription`



##### Parameter `description`


* *type* : Gplanchat\Docgen\FileEntry
* *is nullable* : Yes


#### Method `getParentEntry`



#### Method `setParentEntry`



##### Parameter `parent`


* *type* : Gplanchat\Docgen\FileEntry
* *is nullable* : No


#### Method `setNamespaces`



##### Parameter `namespaces`


* *type* : array
* *is nullable* : No


#### Method `addNamespace`



##### Parameter `namespaceEntry`


* *type* : Gplanchat\Docgen\FileEntry
* *is nullable* : No


#### Method `getNamespaces`



#### Method `hasNamespace`



##### Parameter `namespaceName`


* *type* : Gplanchat\Docgen\FileEntry
* *is nullable* : Yes


#### Method `getNamespace`



##### Parameter `namespaceName`


* *type* : Gplanchat\Docgen\FileEntry
* *is nullable* : Yes


#### Method `setClasses`

Define a new class entries list

##### Parameter `classes`


* *type* : array
* *is nullable* : No


#### Method `addClass`

Add a new class entry to the list

##### Parameter `classEntry`


* *type* : Gplanchat\Docgen\FileEntry
* *is nullable* : No


#### Method `getClasses`

Get all class entries in the list

#### Method `setConstants`



##### Parameter `constants`


* *type* : array
* *is nullable* : No


#### Method `addConstant`



##### Parameter `constantEntry`


* *type* : Gplanchat\Docgen\FileEntry
* *is nullable* : No


#### Method `getConstants`



#### Method `setFunctions`



##### Parameter `functions`


* *type* : array
* *is nullable* : No


#### Method `addFunction`



##### Parameter `functionEntry`


* *type* : Gplanchat\Docgen\FileEntry
* *is nullable* : No


#### Method `getFunctions`





### Trait `FunctionAwareTrait`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#trait-functionawaretrait)



#### Method `setFunctions`



##### Parameter `functions`


* *type* : array
* *is nullable* : No


#### Method `addFunction`



##### Parameter `functionEntry`


* *type* : Gplanchat\Docgen\FunctionAwareTrait
* *is nullable* : No


#### Method `getFunctions`





### Class `FunctionEntry`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#class-functionentry)



#### Implemented Interfaces

* `Gplanchat\Docgen\EntryInterface`


### Trait `MethodAwareTrait`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#trait-methodawaretrait)



#### Method `setMethods`



##### Parameter `methods`


* *type* : array
* *is nullable* : No


#### Method `addMethod`



##### Parameter `methodEntry`


* *type* : Gplanchat\Docgen\MethodAwareTrait
* *is nullable* : No


#### Method `getMethods`





### Class `MethodEntry`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#class-methodentry)



#### Implemented Interfaces

* `Gplanchat\Docgen\EntryInterface`


### Trait `NamespaceAwareTrait`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#trait-namespaceawaretrait)



#### Method `setNamespaces`



##### Parameter `namespaces`


* *type* : array
* *is nullable* : No


#### Method `addNamespace`



##### Parameter `namespaceEntry`


* *type* : Gplanchat\Docgen\NamespaceAwareTrait
* *is nullable* : No


#### Method `getNamespaces`



#### Method `hasNamespace`



##### Parameter `namespaceName`


* *type* : Gplanchat\Docgen\NamespaceAwareTrait
* *is nullable* : Yes


#### Method `getNamespace`



##### Parameter `namespaceName`


* *type* : Gplanchat\Docgen\NamespaceAwareTrait
* *is nullable* : Yes




### Class `NamespaceEntry`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#class-namespaceentry)



#### Implemented Interfaces

* `Gplanchat\Docgen\EntryInterface`


#### Used Traits

* `Gplanchat\Docgen\EntryTrait`
* `Gplanchat\Docgen\ClassAwareTrait`
* `Gplanchat\Docgen\ConstantAwareTrait`
* `Gplanchat\Docgen\FunctionAwareTrait`


#### Method `__construct`



##### Parameter `name`


* *type* : Gplanchat\Docgen\NamespaceEntry
* *is nullable* : Yes


##### Parameter `parentEntry`


* *type* : Gplanchat\Docgen\NamespaceEntry
* *is nullable* : Yes
* *default value* : `NULL`


#### Method `getName`



#### Method `setName`



##### Parameter `name`


* *type* : Gplanchat\Docgen\NamespaceEntry
* *is nullable* : Yes


#### Method `getDescription`



#### Method `setDescription`



##### Parameter `description`


* *type* : Gplanchat\Docgen\NamespaceEntry
* *is nullable* : Yes


#### Method `getParentEntry`



#### Method `setParentEntry`



##### Parameter `parent`


* *type* : Gplanchat\Docgen\NamespaceEntry
* *is nullable* : No


#### Method `setClasses`

Define a new class entries list

##### Parameter `classes`


* *type* : array
* *is nullable* : No


#### Method `addClass`

Add a new class entry to the list

##### Parameter `classEntry`


* *type* : Gplanchat\Docgen\NamespaceEntry
* *is nullable* : No


#### Method `getClasses`

Get all class entries in the list

#### Method `setConstants`



##### Parameter `constants`


* *type* : array
* *is nullable* : No


#### Method `addConstant`



##### Parameter `constantEntry`


* *type* : Gplanchat\Docgen\NamespaceEntry
* *is nullable* : No


#### Method `getConstants`



#### Method `setFunctions`



##### Parameter `functions`


* *type* : array
* *is nullable* : No


#### Method `addFunction`



##### Parameter `functionEntry`


* *type* : Gplanchat\Docgen\NamespaceEntry
* *is nullable* : No


#### Method `getFunctions`





### Trait `ParameterAwareTrait`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#trait-parameterawaretrait)



#### Method `setParameters`



##### Parameter `parameters`


* *type* : array
* *is nullable* : No


#### Method `addParameter`



##### Parameter `parameterEntry`


* *type* : Gplanchat\Docgen\ParameterAwareTrait
* *is nullable* : No


#### Method `getParameters`





### Class `ParameterEntry`

_Declared in namespace `Gplanchat\Docgen`_ [» Read the docs](Gplanchat-Docgen.md#class-parameterentry)



#### Implemented Interfaces

* `Gplanchat\Docgen\EntryInterface`


#### Used Traits

* `Gplanchat\Docgen\EntryTrait`


#### Method `setDefaultValue`



##### Parameter `defaultValue`


* *type* : Gplanchat\Docgen\ParameterEntry
* *is nullable* : Yes


#### Method `getDefaultValue`



#### Method `hasDefaultValue`



#### Method `unsetDefaultValue`



#### Method `setDefaultValueConstant`



##### Parameter `defaultValueConstant`


* *type* : Gplanchat\Docgen\ParameterEntry
* *is nullable* : Yes


#### Method `getDefaultValueConstant`



#### Method `setType`



##### Parameter `type`


* *type* : Gplanchat\Docgen\ParameterEntry
* *is nullable* : Yes


#### Method `getType`



#### Method `setIsNullable`



##### Parameter `isNullable`


* *type* : Gplanchat\Docgen\ParameterEntry
* *is nullable* : Yes


#### Method `getIsNullable`



#### Method `parse`



##### Parameter `re`


* *type* : Gplanchat\Docgen\ParameterEntry
* *is nullable* : No


#### Method `__construct`



##### Parameter `name`


* *type* : Gplanchat\Docgen\ParameterEntry
* *is nullable* : Yes


##### Parameter `parentEntry`


* *type* : Gplanchat\Docgen\ParameterEntry
* *is nullable* : Yes
* *default value* : `NULL`


#### Method `getName`



#### Method `setName`



##### Parameter `name`


* *type* : Gplanchat\Docgen\ParameterEntry
* *is nullable* : Yes


#### Method `getDescription`



#### Method `setDescription`



##### Parameter `description`


* *type* : Gplanchat\Docgen\ParameterEntry
* *is nullable* : Yes


#### Method `getParentEntry`



#### Method `setParentEntry`



##### Parameter `parent`


* *type* : Gplanchat\Docgen\ParameterEntry
* *is nullable* : No






[These docs are proudly built by Docgen](https://github.com/gplanchat/php-docgen)
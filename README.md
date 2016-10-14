# Ride: Security CLI

This module adds various security commands to the Ride CLI.

## Commands

### path

This command shows an overview of the secured paths.

**Syntax**: ```path [<query>]```
- ```<query>```: Query to search the paths

**Alias**: ```sp```

### path secure

This command adds a path to the secured paths.

**Syntax**: ```path secure <path>```
- ```<path>```: Path regular expression

**Alias**: ```sps```

### path unsecure

This command removes a path from the secured paths.

**Syntax**: ```path unsecure <path>```
- ```<path>```: Path regular expression

**Alias**: ```spu```

### role

This command shows an overview of the roles.
You can add a search query to filter the roles.

**Syntax**: ```role [<query>]```
- ```<query>```: Query to search the roles

**Alias**: ```sr```

### role add

This command adds a new role to the security model.

**Syntax**: ```role add <name> [<weight>]```
- ```<name>```: Name to identify the role
- ```<weight>```: Weight of the role

**Alias**: ```sra```

### role allow

This command adds a path to the allowed paths of a role.

**Syntax**: ```role allow <role> <path>```
- ```<role>```: Name or id of the role
- ```<path>```: Path regular expression

**Alias**: ```sral```

### role delete

This command deletes a role from the security model.

**Syntax**: ```role delete <role>```
- ```<role>```: Name or id to identify the role

**Alias**: ```srd```

### role deny

This command removes a granted permission from a role.

**Syntax**: ```role deny <role> <permission>```
- ```<role>```: Name or id of the role
- ```<permission>```: Code of the permission

**Alias**: ```srdn```

### role detail

This command shows the details of a role.

**Syntax**: ```role detail <role>```
- ```<role>```: Name or id of the role

**Alias**: ```srde```

### role disallow

This command removes a path from the allowed paths of a role.

**Syntax**: ```role disallow <role> <path>```
- ```<role>```: Name or id of the role
- ```<path>```: Path regular expression

**Alias**: ```srdi```

### role edit

This command sets a property of a role.

**Syntax**: ```role edit <role> <key> [<value>]```
- ```<role>```: Name or id of the role
- ```<key>```: Key of the property (name or weight)
- ```<value>```: Value for the property

**Alias**: ```sre```

### role grant

This command grants a permission to a role.

**Syntax**: ```role grant <role> <permission>```
- ```<role>```: Name or id of the role
- ```<permission>```: Code of the permission

**Alias**: ```srg```

### user

This command shows an overview of the users.
You can set a search query to filter the users.

**Syntax**: ```user [<query>]```
- ```<query>```: Query to search the users

**Alias**: ```su```

### user add

This command adds a new user to the security model.

**Syntax**: ```user add <username> <password> [<email>]```
- ```<username>```: Username to identify the user
- ```<password>```: Password to authenticate the user
- ```<email>```: Email address of the user

**Alias**: ```sua```

### user assign

This command assigns a role to a user.

**Syntax**: ```user assign <user> <role>```
- ```<user>```: Username or id to identify the user
- ```<role>```: Name or id to identify the role

**Alias**: ```suas```

### user delete

This command deletes a user from the security model.

**Syntax**: ```user delete <user>```
- ```<user>```: Username or id to identify the user

**Alias**: ```sud```

### user detail

This command shows the details of a user.

**Syntax**: ```user detail <user>```
- ```<user>```: Username or id to identify the user

**Alias**: ```sude```

### user edit

This command sets a property of a user.

**Syntax**: ```user edit <user> <key> [<value>]```
- ```<user>```: Username or id to identify the user
- ```<key>```: Key of the property (name, password, email, confirm, image, active or super)
- ```<value>```: Value for the property

**Alias**: ```sue```

### user preference

This command sets a preference of a user

**Syntax**: ```user preference <user> <key> [<value>]```
- ```<user>```: Username or id to identify the user
- ```<key>```: Key of the preference
- ```<value>```: Value for the preference, omit to clear the preference

**Alias**: ```sup```

### user unassign

This command removes a role from a user.

**Syntax**: ```user unassign <user> <role>```
- ```<user>```: Username or id to identify the user
- ```<role>```: Name or id to identify the role

**Alias**: ```suu```

## Related Modules 

- [ride/app](https://github.com/all-ride/ride-app)
- [ride/cli](https://github.com/all-ride/ride-cli)
- [ride/lib-cli](https://github.com/all-ride/ride-lib-cli)
- [ride/lib-common](https://github.com/all-ride/ride-lib-common)
- [ride/lib-security](https://github.com/all-ride/ride-lib-security)
- [ride/web-security](https://github.com/all-ride/ride-web-security)

## Installation

You can use [Composer](http://getcomposer.org) to install this application.

```
composer require ride/cli-security
```

# absol
A Better SOLution package manager (totally not BASED on Pokémon)

## Installation

*Good luck, you will need it*

***Currently only for Bash terminal*** So it will not work for Powershell or Windows Command Line

Prerequisites:
- git
- php (at least 5.6)
- bash

1. Download this repository as zip
2. Extract it to your desired location
3. Locate file `absol` inside extracted location (should be inside `extracted/absol-main`)
4. Add the location of the **parent** directory to your PATH variable
    - Example of location if the zip was extracted in Downloads folder: `C:\Users\<user>\Downloads\absol-main\absol-main`
    - [Windows tutorial for adding locations to PATH variable](https://www.computerhope.com/issues/ch000549.htm)
5. Restart your computer
6. Create new **bash** command window and type `absol help` to test out your installation

## Usage

Initialize absol project

```shell
absol init
```

To add new package

```shell
absol pickup <git-repository>
```

***From now on `<package>` can be either git repository or `<package-name>`***

To remove package

```shell
absol drop <package>
```

Import package into PHP script

```php
// index.php

require_once __DIR__ . "/absol/import.php"; // must require import function

import("package-name"); // imports [default package importer]
import("package-name", "module"); // imports module of package
```

List all installed packages

```shell
absol ls
```

List modules of package

```shell
absol ls <package>
```

Update all packages

```shell
absol update
```

Update one package

```shell
absol update <package>
```

Show help

```shell
absol help
```

## Creating new package

Initialize absol project

```shell
mkdir my-project
cd my-project
absol init
git init
```

Exclude `my-project/absol` directory in `.gitignore`

Edit `my-project/absol_modules/index.php` to require all the source files
or create new PHP file to create module. Example structure:

```text
my-project/
    absol_modules/
        index.php
        module.php
```

```php
// my-second-project

import("my-project"); // will require absol_modules/index.php
import("my-project", "module"); // will require absol_modules/module.php
```

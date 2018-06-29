Anax comment
==================================
Travis
[![Build Status](https://travis-ci.org/reblex/comment.svg?branch=master)](https://travis-ci.org/reblex/comment)

Scrutinizer
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/reblex/comment/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/reblex/comment/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/reblex/comment/badges/build.png?b=master)](https://scrutinizer-ci.com/g/reblex/comment/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/reblex/comment/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/reblex/comment/?branch=master)

Anax comment module with user and admin integration.



Pre-Installation
------------------

###  *Anax base as project*

You need a Anax installation, before you can use this module. You can create a sample Anax installation like this, using the scaffolding utility [`anax-cli`](https://github.com/canax/anax-cli).

Scaffold a sample Anax installation anax-site-develop into directory of your choice (make sure it's accessible from your web host), the example here is *'my-project'*.

*Press Y (or just enter) for the post-processing to finish the scaffolding.*

```
$ anax create my-project anax-site-develop
```

Now just hop into the project and let's start installing the comment module!

```
$ cd my-project
```


Comment Module Installation
------------------

### First, install the comment module with composer...

*The module will be downloaded from packagist and will end up in our *vendor* folder.*

```
$ composer require reblex/comment
```

### Copy the source files...

*The source files contain the central functionality for the comment system.*

```
$ rsync -av vendor/reblex/comment/src/* src/
```

### Copy the route, session and database files...

```
$ rsync -av vendor/reblex/comment/config/route/* config/route/
$ rsync -av vendor/reblex/comment/config/{database,session}.php config/
```

### Configure DI route, and database...

Now we need to add the configurations for both DI and Route. Examples can be found in *vendor/reblex/comment/config/di.php* and *vendor/reblex/comment/config/route.php.*

The database also needs configuration for your specifications.

### Now for the SQL setup files...


These files are used to setup the base table structure needed. Query your database with these files.

```
$ rsync -av vendor/reblex/comment/sql/* config/sql
```

*The login credentials for the two test accounts are (user,user) and (admin, admin).*


### And then finally we need the views...

```
$ rsync -av vendor/reblex/comment/view/* view/
```


License
------------------

This software carries a MIT license.



```
 .  
..:  Copyright (c) 2018 Simon Wahlström (simon.otdw@gmail.com)
```

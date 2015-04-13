This project is used to learn Slim framework, Doctrine and React by clone Hacker News (http://news.ycombinator.com)

## Features ##

- [ ] User can post many Items
- [ ] User can post Comments for Item
- [ ] User can upvote Item
- [ ] User can search for Items, Comments
- [ ] User has a profile page show name, member sine, simple statistics
- [ ] User can change password, recover lost password

## Install ##

1. Get source code: `git clone https://github.com/olragon/learn-slim-doctrine-react.git`
2. Install required packages: `cd learn-slim-doctrine-react` & `composer install`
3. Create config file: `cp config/config.sample.php config/config.php`
4. Update config

## Working with schema ##

- Create: `php vendor/bin/doctrine orm:schema-tool:create`
- Update: `php vendor/bin/doctrine orm:schema-tool:update`


## Reference ##
- http://www.slimframework.com/
- http://www.doctrine-project.org/
- http://busypeoples.github.io/post/slim-doctrine/
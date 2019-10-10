# WPBot Commands

A WordPress plugin for maintaining commands used by the WordPress IRC bot; WPBot.

## See it in action
The bot runs in the [#WordPress IRC channel on Freenode](https://webchat.freenode.net/?channels=#wordpress)

## How it works
The commands are part of a [Custom Post Type](https://developer.wordpress.org/plugins/post-types/), 
allowing those with access an easy way to add, remove or modify commands the bot may react to.

The bot polls the site, using the Rest API, for commands at set intervals, refreshing its internal memory of what commands exist.

The request is made to `https://wo-bot.net/wp-json/wpbot/v1/commands`, which provides a JSON list of triggers and responses.

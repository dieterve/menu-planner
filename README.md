# README
Do not use this. Its an experiment with 2 purposes:

* Learn to use recent PHP technics together
* Help me build my weekly menu before I go to the shop

# Goal
Build a mini framework which only goal is to make my life easier by generating a menu when asked.
A menu in the convential way: a mix of several food items that can be put together and eaten.

I would like the following features:

* Generate 7 meals
* Make sure we have some meat, pasta, fish, ...
* Generate the shopping list needed to make those 7 meals
* Remove a meal and generate a new one
* A "these 2 items are not a good mix"
* Be intelligent and remember good combinations
* Be intelligent and take seasons in account
* Be intelligent and remember preferences (for example: spaghetti only in weekends)

Todo:

* Router Component with a Router interface. Contains a HTTPRouter (url + method), CommandRouter, ...
* Caching Compoing with a Cache interface. Contains a FileCache, Memcache, ...
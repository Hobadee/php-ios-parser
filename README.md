# ios-parser
Parse Cisco IOS configuration files in PHP

This is a work in progress.

This classes will let you parse a Cisco IOS style configuration file.  It will return an object representing all the configuration variable.

These classes are extensible with "parsers", which function like plugins to parse various configuration directives to extract and parse more information.  In the future these additional fields will be searchable.

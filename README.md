CEP Project
===========

Chosen topic: Food; specifically, a fast-food chain called Mekdoornels. [LIVE SITE](http://omo.riicc.sg/cep14/)

Current Repo:

_head.html
----------
The tags to be included in `<head>` for each document. This would mainly be stylesheet links and scripts, but can also include titles and meta tags.

_navbar.html
------------
The navbar to be included in each document.

_footer.html
------------
The footer to be included in each document.

_sandbox.html
-------------
A random place where you can test all your `!ipp` stuff :D

index.php
---------
The landing page; pagename = Home

about.php
---------
The about page; pagename = About

contact.php
-----------
The contact page (that requires AJS); pagename = Contact

menu.php
--------
The menu page (that contains the list of food); pagename = Menu

iPreProcess Documentation
=========================

To use iPreProcess, use `!ipp[*]` anywhere in script, where * is an iPreProcess command.
iPreProcess commands are structured as follows:

	[directive] [arg1] [arg2] ...

For example, an inclusion script would be written as such:

	!ipp[insert http://omo.riicc.sg/hellotest/amazing]

A list of directives and their arguments can be found below.

ifv
---
Structure: `ifv [variableName] [op] [string] [valueiftrue] [optional valueiffalse]`

Tests the value in `[variableName]` against `[string]` using `[op]`. Currently accepted parameters for `[op]` are:

	eq

Tests if `[variableName]` is the same as `[string]`.

	neq

Tests if `[variableName]` is not the same as `[string]`.

`[valueiftrue]` is printed if the test is true, otherwise `[valueiffalse]` is printed.

insert
------
Structure: `insert [url]`

Includes `[url]` into the document at the specified point.

setv
----
Structure: `setv [variableName] [optional value]`

Sets `[variableName]` to `[value]`. If value is absent, clears the variable.

putv
----
Structure: putv `[variableName]`

Writes the contents of `[variableName]` to the specified point.

_cep14_insert
-------------
Structure: _cep14_insert `[file]`

This is a special directive for use in this project. `[file]` should be a file relative to the Repo.



Page Updating
=============
The pages on the server are updated with GitHub's version when it is requested. However, as caching may occur, the changes may take a while to be reflected.

Current estimated waiting time for the changes to be reflected: About 5 - 10 minutes.

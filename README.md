CEP Project
===========

Chosen topic: Food; specifically, a fast-food chain called Mekdoornels. [LIVE SITE](http://omo.riicc.sg/cep14/)

Current Repo:

css/_styles.css
-----------
The stylesheet for the entire website. If a specific page requires other styles please *don't* put it in here; use `<style>` tags instead.

js/food_info.json
-----------------
JSON for the food.

js/hash.js
----------
Hash algorithm for use in order pages.

components/_head.html
----------
The tags to be included in `<head>` for each document. This would mainly be stylesheet links and scripts, but can also include titles and meta tags.

components/_navbar.html
------------
The navbar to be included in each document.

components/_footer.html
------------
The footer to be included in each document.

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

order_delivery.php
------------------
The delivery page; pagename = Delivery

order_reservation.php
---------------------
The reservation page; pagename = Reservation

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

Nay, live editing **_FTW_**.

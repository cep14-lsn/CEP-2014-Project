CEP Project
===========

iPreProcess Documentation

To use iPreProcess, use !ipp[*] anywhere in script, where * is an iPreProcess command.
iPreProcess command are structured as follows:

[directive] [arg1] [arg2] ...

For example, an inclusion script would be as such:

!ipp[insert http://omo.riicc.sg/hellotest/amazing]

A list of directives and their arguments can be found below.

insert
======
Structure: insert [url]
Includes [url] into the document at the specified point.

setv
====
Structure: setv [variableName] [optional value]
Sets [variableName] to [value]. If value is absent, clears the variable.

putv
====
Structure: putv [variableName]
Writes the contents of [variableName] to the specified point.

_cep14_insert
=============
Structure: _cep14_insert [file]
This is a special directive for use in this project. [file] should be a file relative to the Repo.

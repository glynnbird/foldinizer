# Foldinizer

```

    ______       __     ___        _                 
   / ____/____  / /____/ (_)____  (_)____  ___  _____
  / /_   / __ \/ // __  / // __ \/ //_  / / _ \/ ___/
 / __/  / /_/ / // /_/ / // / / / /  / /_/  __/ /    
/_/     \____/_/ \__,_/_//_/ /_/_/  /___/\___/_/

```

## What does it do

If you have directory containing a bunch of files that you would like organised into year/month folders, then Foldinizer is for you. 

## How do I run it?

You need a machine with PHP on, like a Mac.

* Copy folidinizer.php to your machine
* Ensure it is executable e.g. chmod 755 foldinizer.php
* Run it 

## What parameters does it need

1) Source directory - the path containing the directories to be recursed through
2) Destination directory - the path the files will be copied to
3) Test mode (optional) - by passing a third parameter, the script will do the scanning but will copy no files

e.g.

```

./foldinizer.php ~/Pictures  ~/mynewfolder

./foldinizer.php ~/Pictures ~/mynewfolder 1

```

## What if I want to move files instead of copy them?

You can edit the code and exchange the "copy" function for the "rename" function.
#!/bin/bash

# Constants
COLOR_START="\033[93m"
COLOR_END="\033[0m"

# Begin
echo -e "$COLOR_START========= BEGIN =========$COLOR_END\n"

# .md -> .html
echo -e "$COLOR_START========= .md -> .html:$COLOR_END"
build-tools/md-to-html/md-to-html

# pitew/contributors/*.txt
echo -e "$COLOR_START========= pitew/contributors/make-lists.php:$COLOR_END"
cd pitew/contributors
php make-lists.php
cd ../..
ls -1sh pitew/contributors/*.txt

# End
echo -e "\n$COLOR_START========= END =========$COLOR_END"

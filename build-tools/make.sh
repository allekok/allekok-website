#!/bin/bash
Allekok_path=~/projects/www.allekok.com
Download_repo=~/projects/allekok-downloads/downloads
cd $Allekok_path

#images
cp $Download_repo/allekok.com/image/sent-by-users/* \
   style/img/poets/new/
rm style/img/poets/new/index.md

#poet-descs
cp $Download_repo/allekok.com/text/infos-written-by-users/* \
   pitew/res/
rm pitew/res/index.md

#news.txt
cp build-tools/res/news.txt-sample \
   pitew/news.txt

#last-update.txt
cp build-tools/res/last-update.txt-sample \
   last-update.txt

#.md -> .html
cd manual
node $Allekok_path/build-tools/tools/md-to-html/md-to-html.js

#pdfs.txt
cd ../pitew
php save-pdfs-list.php

#contributors/*.txt
cd contributors
php make-lists.php

#Print some rubbish
echo 
echo - Make: Ok.

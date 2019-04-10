Allekok_path=~/Projects/allekok.com

#pdfs.txt
cd $Allekok_path/pitew
php save-pdfs-list.php

#news.txt
cd $Allekok_path
cp build-tools/res/news.txt-sample pitew/news.txt

#contributors/*.txt
cd $Allekok_path/pitew/contributors
php make-lists.php

#last-update.txt
cd $Allekok_path
cp build-tools/res/last-update.txt-sample last-update.txt

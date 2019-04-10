Allekok_path=~/Projects/allekok.com
Download_repo=~/Projects/allekok-downloads/downloads

# images
cp $Download_repo/allekok.com/image/Sent-by-users/* $Allekok_path/style/img/poets/new/
rm $Allekok_path/style/img/poets/new/index.md

# poet-descs
cp $Download_repo/allekok.com/text/infos-written-by-users/* $Allekok_path/pitew/res/
rm $Allekok_path/pitew/res/index.md

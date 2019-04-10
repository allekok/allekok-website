Allekok_path=~/Projects/allekok.com
cd $Allekok_path

find -name stats.txt | while read file; do
    rm -v $file
done

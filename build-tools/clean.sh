# Clean un-necessary files
Allekok_path=~/Projects/allekok.com
cd $Allekok_path

# Remove stats.txt(s)
find -name stats.txt | while read file; do
    rm -v $file
done

echo - Clean: Ok.

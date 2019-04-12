# ~~~Download necessary files for build locally~~~ #
Allekok_path=~/Projects/allekok.com

# From allekok download repo:
## 1. Copy images sent by users
## 2. Copy text infos written by users
sh $Allekok_path/build-tools/tools/necessary_images_poetdescs.sh

# Create a sample last-update.txt, news.txt
# Download pdfs.txt from allekok's diwan repo
# Make Contributors text lists
sh $Allekok_path/build-tools/tools/necessary_text_files.sh

# Convert manual.md -> manual.html
sh $Allekok_path/build-tools/tools/md-to-html-manual.sh

# Print some rubbish
figlet make.

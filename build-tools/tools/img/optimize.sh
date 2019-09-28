#!/bin/sh
PATH=~/projects/www.allekok.com/style/img/poets/profile
cd $PATH;
ls | grep ".jpg" |
    while read f; do
	jpegtran -progressive $f > $f.0;
	jpegtran -optimize $f.0 > $f.1;
	rm $f;
	mv $f.1 $f
    done

#!/bin/sh
cd font-files
ls |
    while read f; do
	woff2_compress "$f"
	rm "$f"
    done

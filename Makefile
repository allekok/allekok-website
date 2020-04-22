all: css js md favicon
help:
	@echo -e "\e[93mOptions\e[0m:"
	@echo "   css, js, md, favicon, setup"
setup: db
db:
	cd script/php/admin/ && php install.php
	@echo -e "\e[93mDB Done.\e[0m"
favicon: favicon/site.webmanifest
css: style/css/main-comp.css
js: script/js/main-comp.js
md: dev contributing
contributing: dev/tools/CONTRIBUTING/CONTRIBUTING.html
dev: dev/tools/dev.html
style/css/main-comp.css: style/css/main.css
	cd style/css && php tools/make.php
	@echo -e "\e[93mCSS Done.\e[0m"
script/js/main-comp.js: script/js/main.js
	cd script/js/tools && php make.php
	@echo -e "\e[93mJS Done.\e[0m"
dev/tools/CONTRIBUTING/CONTRIBUTING.html: dev/tools/CONTRIBUTING/CONTRIBUTING.md
	./build-tools/md-to-html/md-to-html
	@echo -e "\e[93mContributing Done.\e[0m"
dev/tools/dev.html: dev/tools/dev.md
	./build-tools/md-to-html/md-to-html
	@echo -e "\e[93mDev Done.\e[0m"
favicon/site.webmanifest: favicon/site-sample.webmanifest
	cd favicon && php make.php
	@echo -e "\e[93mFavicon Done.\e[0m"

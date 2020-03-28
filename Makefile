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
md: manual contributing
manual: manual/manual.php
contributing: dev/tools/CONTRIBUTING/CONTRIBUTING.php
style/css/main-comp.css: style/css/main.css
	cd style/css && php tools/make.php
	@echo -e "\e[93mCSS Done.\e[0m"
script/js/main-comp.js: script/js/main.js
	cd script/js/tools && php make.php
	@echo -e "\e[93mJS Done.\e[0m"
manual/manual.php: manual/manual.md
	./build-tools/md-to-html/md-to-html
	@echo -e "\e[93mManual Done.\e[0m"
dev/tools/CONTRIBUTING/CONTRIBUTING.php: dev/tools/CONTRIBUTING/CONTRIBUTING.md
	./build-tools/md-to-html/md-to-html
	@echo -e "\e[93mContributing Done.\e[0m"
favicon/site.webmanifest: favicon/site-sample.webmanifest
	cd favicon && php make.php
	@echo -e "\e[93mFavicon Done.\e[0m"

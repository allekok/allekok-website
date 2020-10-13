all: css js md favicon
help:
	@echo -e "\e[94mOptions\e[0m:"
	@echo "   css, js, md, favicon, setup"
setup: db
db:
	cd script/php/admin/ && php install.php
	@echo -e "\e[94mDB Done.\e[0m"
favicon: style/img/favicon/site.webmanifest
css: style/css/main-comp.css
js: script/js/main-comp.js
md: dev contributing
contributing: dev/tools/CONTRIBUTING/CONTRIBUTING.html
dev: dev/tools/dev.html
style/css/main-comp.css: style/css/main.css
	cd style/css && php tools/make.php
	@echo -e "\e[94mCSS Done.\e[0m"
script/js/main-comp.js: script/js/main.js
	cd script/js/tools && php make.php
	@echo -e "\e[94mJS Done.\e[0m"
dev/tools/CONTRIBUTING/CONTRIBUTING.html: dev/tools/CONTRIBUTING/CONTRIBUTING.md
	./build-tools/md-to-html/md-to-html
	@echo -e "\e[94mContributing Done.\e[0m"
dev/tools/dev.html: dev/tools/dev.md
	./build-tools/md-to-html/md-to-html
	@echo -e "\e[94mDev Done.\e[0m"
style/img/favicon/site.webmanifest: style/img/favicon/site-sample.webmanifest
	cd style/img/favicon && php make.php
	@echo -e "\e[94mFavicon Done.\e[0m"

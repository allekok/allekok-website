const fs = require('fs');
const showdown = require('showdown');
const files = ['manual',
	       '../dev/tools/CONTRIBUTING/CONTRIBUTING'];
const converter = new showdown.Converter();
let text,html;
for(let i in files) {
    text = fs.readFileSync(files[i]+'.md').toString(),
    html = converter.makeHtml(text);
    fs.writeFileSync(files[i]+'.html', html);
}

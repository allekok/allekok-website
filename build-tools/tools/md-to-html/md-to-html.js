let fs = require('fs'),
    showdown = require('showdown');
let converter = new showdown.Converter(),
    text,html;

let files = ['manual','../dev/tools/CONTRIBUTING/CONTRIBUTING'];
for(var i in files) {
    text = fs.readFileSync(files[i]+'.md').toString(),
    html = converter.makeHtml(text);
    fs.writeFileSync(files[i]+'.html', html);
}

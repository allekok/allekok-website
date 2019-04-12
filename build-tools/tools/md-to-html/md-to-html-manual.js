let fs = require('fs'),
    showdown = require('showdown');

let converter = new showdown.Converter(),
    text = fs.readFileSync('manual.md').toString(),
    html = converter.makeHtml(text);

fs.writeFileSync('manual.html', html);
console.log('ok');

/* 
 * This file will be executed in the '/manual' dir. 
 * So the paths are relative to '/manual'.
 */
const files = ['manual', '../dev/tools/CONTRIBUTING/CONTRIBUTING'];
const fs = require('fs');
const showdown = require('showdown');
const converter = new showdown.Converter();

for (const i in files)
{
    const text = fs.readFileSync(`${files[i]}.md`).toString();
    const html = converter.makeHtml(text);
    fs.writeFileSync(`${files[i]}.html`, html);
}

const electron = require('electron');
const app = electron.app;

const BrowserWindow = electron.BrowserWindow;

var mainWindow;

app.on('ready',function()
{
    mainWindow = new BrowserWindow({width: 1024,height: 768,backgroundColor: '#D3D3D3'});
    mainWindow.loadURL('https://mediasuche.de');
});
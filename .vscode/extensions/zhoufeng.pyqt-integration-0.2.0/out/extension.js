'use strict';
Object.defineProperty(exports, "__esModule", { value: true });
// The module 'vscode' contains the VS Code extensibility API
// Import the module and reference it with the alias vscode in your code below
const vscode = require("vscode");
const controller_1 = require("./controller");
// this method is called when your extension is activated
// your extension is activated the very first time the command is executed
function activate(context) {
    const controller = new controller_1.PYQTController(context);
    // The command has been defined in the package.json file
    // Now provide the implementation of the command with  registerCommand
    // The commandId parameter must match the command field in package.json
    context.subscriptions.push(vscode.commands.registerCommand('pyqt-integration.createNewForm', (fileUri) => controller.createNewForm(fileUri)));
    context.subscriptions.push(vscode.commands.registerCommand('pyqt-integration.editInDesigner', (fileUri) => controller.editInDesigner(fileUri)));
    context.subscriptions.push(vscode.commands.registerCommand('pyqt-integration.Preview', (fileUri) => controller.preview(fileUri)));
    context.subscriptions.push(vscode.commands.registerCommand('pyqt-integration.compileForm', (fileUri) => controller.compileForm(fileUri)));
    context.subscriptions.push(vscode.commands.registerCommand('pyqt-integration.compileQRC', (fileUri) => controller.compileQRC(fileUri)));
    context.subscriptions.push(vscode.commands.registerCommand('pyqt-integration.pylupdate', (fileUri) => controller.pylupdate(fileUri)));
    context.subscriptions.push(vscode.commands.registerCommand('pyqt-integration.linguist', (fileUri) => controller.linguist(fileUri)));
}
exports.activate = activate;
// this method is called when your extension is deactivated
function deactivate() {
}
exports.deactivate = deactivate;
//# sourceMappingURL=extension.js.map
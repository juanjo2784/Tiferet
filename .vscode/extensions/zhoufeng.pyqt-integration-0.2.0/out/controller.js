'use strict';
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : new P(function (resolve) { resolve(result.value); }).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
Object.defineProperty(exports, "__esModule", { value: true });
const vscode = require("vscode");
class PYQTController {
    constructor(context) {
        this.cp = require('child_process');
        this.fs = require('fs');
        this.path = require('path');
        this.context = context;
        this._outputChannel = vscode.window.createOutputChannel("PYQT");
    }
    initFolder(filePath, { isRelativeToScript = false } = {}) {
        const sep = this.path.sep;
        const folderPath = filePath.replace(/(.*[\\\/]).*$/, "$1").replace(/[\\\/]/g, sep);
        const initDir = this.path.isAbsolute(folderPath) ? sep : '';
        const baseDir = isRelativeToScript ? __dirname : '.';
        folderPath.split(sep).reduce((parentDir, childDir) => {
            const curDir = this.path.resolve(baseDir, parentDir, childDir);
            try {
                if (!this.fs.existsSync(curDir)) {
                    this.fs.mkdirSync(curDir);
                    this._outputChannel.appendLine(`[Info] Directory "${curDir}" created.`);
                }
            }
            catch (err) {
                if (err.code !== 'EEXIST') {
                    vscode.window.showErrorMessage(err.toString());
                    throw err;
                }
                //console.log(`Directory ${curDir} already exists!`);
            }
            return curDir;
        }, initDir);
    }
    exec(cmd, { successMessage = "", stdoutPath = "", cwd = "" } = {}) {
        //this._outputChannel.show(true);
        this._outputChannel.appendLine(`[Running] ${cmd}`);
        this.cp.exec(cmd, { cwd: cwd }, (err, stdout, stderr) => {
            if (stdout && stdoutPath) {
                this.initFolder(stdoutPath);
                this.fs.writeFileSync(stdoutPath, stdout, 'utf8');
            }
            if (!err) {
                if (stdout) {
                    this._outputChannel.appendLine(`${stdout.toString()}`);
                }
                if (stderr) {
                    this._outputChannel.appendLine(`${stderr.toString()}`);
                }
            }
            if (err) {
                this._outputChannel.appendLine(`[Error] ${stderr.toString()}`);
                vscode.window.showErrorMessage(err.toString());
                throw err;
            }
            else if (successMessage !== "") {
                this._outputChannel.appendLine(`[Done] ${successMessage}`);
                vscode.window.showInformationMessage(successMessage);
            }
        });
    }
    getOrConfigDesignerPath() {
        return __awaiter(this, void 0, void 0, function* () {
            let dPath = vscode.workspace.getConfiguration().get('pyqt-integration.qtdesigner.path', "");
            if (dPath === "") {
                vscode.window.showInformationMessage("Select your executable file of QT Designer");
                yield vscode.window.showOpenDialog({
                    canSelectMany: false
                }).then((uris) => {
                    if (uris && uris.length !== 0) {
                        vscode.workspace.getConfiguration().update('pyqt-integration.qtdesigner.path', uris[0].fsPath, vscode.ConfigurationTarget.Global);
                        dPath = uris[0].fsPath;
                    }
                });
            }
            return dPath;
        });
    }
    /**
     * createNewForm
     */
    createNewForm(fileUri) {
        return __awaiter(this, void 0, void 0, function* () {
            const dPath = yield this.getOrConfigDesignerPath();
            if (dPath !== "") {
                if (!fileUri) {
                    var workspaceFolders = vscode.workspace.workspaceFolders;
                    if (workspaceFolders) {
                        fileUri = workspaceFolders[0].uri;
                    }
                }
                this.fs.lstat(fileUri.fsPath, (err, stats) => {
                    if (err) {
                        return vscode.window.showErrorMessage(err);
                    }
                    let dirName = fileUri.fsPath;
                    if (stats.isFile()) {
                        dirName = this.path.dirname(fileUri.fsPath);
                    }
                    this.exec(`"${dPath}"`, { cwd: dirName });
                });
            }
        });
    }
    /**
     * editInDesigner
     */
    editInDesigner(fileUri) {
        return __awaiter(this, void 0, void 0, function* () {
            const dPath = yield this.getOrConfigDesignerPath();
            if (dPath !== "") {
                this.fs.lstat(fileUri.fsPath, (err, stats) => {
                    if (err) {
                        return vscode.window.showErrorMessage(err);
                    }
                    let dirName = fileUri.fsPath;
                    if (stats.isFile()) {
                        dirName = this.path.dirname(fileUri.fsPath);
                    }
                    this.exec(`"${dPath}" "${fileUri.fsPath}"`, { cwd: dirName });
                });
            }
        });
    }
    /**
     * preview
     */
    preview(fileUri) {
        return __awaiter(this, void 0, void 0, function* () {
            const pyuic = vscode.workspace.getConfiguration().get('pyqt-integration.pyuic.cmd', "");
            this.fs.lstat(fileUri.fsPath, (err, stats) => {
                if (err) {
                    return vscode.window.showErrorMessage(err);
                }
                let dirName = fileUri.fsPath;
                if (stats.isFile()) {
                    dirName = this.path.dirname(fileUri.fsPath);
                }
                this.exec(`"${pyuic}" -p "${fileUri.fsPath}"`, { cwd: dirName });
            });
        });
    }
    resolvePath(fileUri, pyPath) {
        // path resolved
        let pyPathR = pyPath.replace("${ui_name}", "${name}")
            .replace("${qrc_name}", "${name}")
            .replace("${ts_name}", "${name}");
        if (pyPathR.indexOf("${workspace}") !== -1) {
            // Absolute path
            const workspaceFoldersList = vscode.workspace.workspaceFolders;
            let workspacePath = "";
            if (workspaceFoldersList && workspaceFoldersList.length !== 0) {
                workspacePath = workspaceFoldersList[0].uri.fsPath;
            }
            let fileNameNoSuffix = fileUri.fsPath.replace(/(.*[\\\/])(.*)\..*$/, "$2");
            pyPathR = pyPathR.replace("${workspace}", workspacePath).replace("${name}", fileNameNoSuffix);
        }
        else {
            if (!this.path.isAbsolute(pyPathR)) {
                let pattern = "$1" + pyPathR.replace("${name}", "$2");
                pyPathR = fileUri.fsPath.replace(/(.*[\\\/])(.*)\..*$/, pattern);
            }
            else {
                let fileNameNoSuffix = fileUri.fsPath.replace(/(.*[\\\/])(.*)\..*$/, "$2");
                pyPathR = pyPathR.replace("${name}", fileNameNoSuffix);
            }
        }
        return pyPathR;
    }
    /**
     * compileForm
     */
    compileForm(fileUri) {
        return __awaiter(this, void 0, void 0, function* () {
            const pyuic = vscode.workspace.getConfiguration().get('pyqt-integration.pyuic.cmd', "");
            const pyPath = vscode.workspace.getConfiguration().get('pyqt-integration.pyuic.compile.filepath', "");
            const addOpts = vscode.workspace.getConfiguration().get('pyqt-integration.pyuic.compile.addOptions', "");
            // path resolved
            let pyPathR = this.resolvePath(fileUri, pyPath);
            this.initFolder(pyPathR);
            this.fs.lstat(fileUri.fsPath, (err, stats) => {
                if (err) {
                    return vscode.window.showErrorMessage(err);
                }
                let dirName = fileUri.fsPath;
                if (stats.isFile()) {
                    dirName = this.path.dirname(fileUri.fsPath);
                }
                this.exec(`"${pyuic}" "${fileUri.fsPath}" ${addOpts} -o "${pyPathR}"`, {
                    successMessage: `Compiled to "${pyPathR}" successfully`,
                    cwd: dirName
                });
            });
        });
    }
    /**
     * compileQRC
     */
    compileQRC(fileUri) {
        return __awaiter(this, void 0, void 0, function* () {
            const pyrcc = vscode.workspace.getConfiguration().get('pyqt-integration.pyrcc.cmd', "");
            const pyPath = vscode.workspace.getConfiguration().get('pyqt-integration.pyrcc.compile.filepath', "");
            const addOpts = vscode.workspace.getConfiguration().get('pyqt-integration.pyrcc.compile.addOptions', "");
            // path resolved
            let pyPathR = this.resolvePath(fileUri, pyPath);
            this.initFolder(pyPathR);
            this.fs.lstat(fileUri.fsPath, (err, stats) => {
                if (err) {
                    return vscode.window.showErrorMessage(err);
                }
                let dirName = fileUri.fsPath;
                if (stats.isFile()) {
                    dirName = this.path.dirname(fileUri.fsPath);
                }
                this.exec(`"${pyrcc}" "${fileUri.fsPath}" ${addOpts} -o "${pyPathR}"`, {
                    successMessage: `Compiled to "${pyPathR}" successfully`,
                    cwd: dirName
                });
            });
        });
    }
    /**
     * pylupdate
     */
    pylupdate(fileUri) {
        return __awaiter(this, void 0, void 0, function* () {
            const pylupdate = vscode.workspace.getConfiguration().get('pyqt-integration.pylupdate.cmd', "");
            const tsPath = vscode.workspace.getConfiguration().get('pyqt-integration.pylupdate.compile.filepath', "");
            const addOpts = vscode.workspace.getConfiguration().get('pyqt-integration.pylupdate.compile.addOptions', "");
            // path resolved
            let tsPathR = this.resolvePath(fileUri, tsPath);
            this.initFolder(tsPathR);
            this.fs.lstat(fileUri.fsPath, (err, stats) => {
                if (err) {
                    return vscode.window.showErrorMessage(err);
                }
                let dirName = fileUri.fsPath;
                if (stats.isFile()) {
                    dirName = this.path.dirname(fileUri.fsPath);
                }
                if (fileUri.fsPath.endsWith(".pro") && stats.isFile()) {
                    this.exec(`"${pylupdate}" ${addOpts} "${fileUri.fsPath}"`, {
                        successMessage: `Compiled "${fileUri.fsPath}" successfully`,
                        cwd: dirName
                    });
                }
                else if (fileUri.fsPath.endsWith(".py") && stats.isFile()) {
                    this.exec(`"${pylupdate}" ${addOpts} "${fileUri.fsPath}" -ts "${tsPathR}"`, {
                        successMessage: `Compiled to "${tsPathR}" successfully`,
                        cwd: dirName
                    });
                }
            });
        });
    }
    /**
     * linguist
     */
    linguist(fileUri) {
        return __awaiter(this, void 0, void 0, function* () {
            const linguist = vscode.workspace.getConfiguration().get('pyqt-integration.linguist.cmd', "linguist");
            this.fs.lstat(fileUri.fsPath, (err, stats) => {
                if (err) {
                    return vscode.window.showErrorMessage(err);
                }
                let dirName = fileUri.fsPath;
                if (stats.isFile()) {
                    dirName = this.path.dirname(fileUri.fsPath);
                }
                this.exec(`"${linguist}" "${fileUri.fsPath}"`, { cwd: dirName });
            });
        });
    }
}
exports.PYQTController = PYQTController;
//# sourceMappingURL=controller.js.map
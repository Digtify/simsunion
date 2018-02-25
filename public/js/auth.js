/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ 6:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(7);


/***/ }),

/***/ 7:
/***/ (function(module, exports) {

function getMode() {
    return $('#auth-mode').attr('data-mode');
}

function getMail() {
    return $('input[name^="mail"]').val();
}

function getPass() {
    return $('input[name^="password"]').val();
}

function getPassRepeat() {
    return $('input[name^="password_repeat"]').val();
}

function checkPasswordsSame() {
    return getPass() === getPassRepeat();
}

function checkMail() {
    return getMail().length > 0 && getMail().indexOf('@') !== -1 && getMail().indexOf('.') !== -1;
}

function checkLogin() {
    if (getMail().length > 0 && getPass().length >= 6 && checkMail()) {
        setAuthActive(true);
    } else {
        setAuthActive(false);
    }
}

function checkRegister() {
    if (getMail().length > 0 && getPass().length >= 6 && checkMail() && checkPasswordsSame()) {
        setAuthActive(true);
    } else {
        setAuthActive(false);
    }
}

function setAuthActive(state) {
    if (!state) $('#submit-auth').attr('disabled', 'disabled');else $('#submit-auth').removeAttr('disabled');
}

$('.input').keyup(function () {
    if (getMode() === 'login') {
        checkLogin();
    } else {
        checkRegister();
    }
});

setAuthActive(false);

/***/ })

/******/ });
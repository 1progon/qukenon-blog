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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin-vue-body.js":
/*!****************************************!*\
  !*** ./resources/js/admin-vue-body.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var body = document.querySelector('.wrapper');
var bodyApp = new Vue({
  el: body,
  data: {
    test: 'test vue',
    notify: false,
    message: ''
  },
  methods: {
    showConfirmNotify: function showConfirmNotify(e) {
      var formId = e.target.id; //form-48

      var id = e.target.dataset.id; //48
      // let notifyBlock = document.getElementById('notify-' + catId);

      var notifyBlock = document.querySelector('#' + formId + ' .notify');
      notifyBlock.style.display = 'block';
    },
    hideConfirmNotify: function hideConfirmNotify(catId) {
      var notifyBlock = document.getElementById('notify-' + catId);
      notifyBlock.style.display = 'none';
    },
    removePostOrCategory: function removePostOrCategory(catId) {
      var _this = this;

      var form = document.getElementById('form-' + catId);
      form.submit();
      this.message = 'Отлично, удалено!';
      setTimeout(function () {
        _this.hideConfirmNotify(catId);
      }, 5000);
    },
    // Page images-error
    // Check all images to remove
    checkAll: function checkAll() {
      var images = document.getElementsByClassName('images-to-remove');

      for (i in images) {
        if (images[i].checked) {
          images[i].checked = false;
        } else {
          images[i].checked = true;
        }
      }
    }
  }
});

/***/ }),

/***/ 2:
/*!**********************************************!*\
  !*** multi ./resources/js/admin-vue-body.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\CodingProjects\PhpStormProjects\qukenon-blog\resources\js\admin-vue-body.js */"./resources/js/admin-vue-body.js");


/***/ })

/******/ });
//# sourceMappingURL=admin-vue-body.js.map
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

/***/ "./resources/es6/components/search-form.js":
/*!*************************************************!*\
  !*** ./resources/es6/components/search-form.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var search_form_elem = document.querySelector('.search-form');

if (search_form_elem) {
  var postcode_elem = search_form_elem.querySelector('[name="postcode"]');
  postcode_elem.addEventListener('change', function (e) {
    postcodeChangeHandler(e);
  });
}

function postcodeChangeHandler(e) {
  var postcode_elem = e.currentTarget;
  var distance_elem = search_form_elem.querySelector('.distance-group');

  if (postcode_elem.value.length > 0 && distance_elem.classList.contains('d-none')) {
    showDistanceInput();
  } else {
    hideDistanceInput();
  }
}

function showDistanceInput() {
  search_form_elem.querySelector('.distance-group').classList.remove('d-none');
  search_form_elem.querySelector('.treatment-group').classList.replace('col-lg-4', 'col-lg-3');
  search_form_elem.querySelector('.postcode-group').classList.replace('col-lg-4', 'col-lg-3');
  search_form_elem.querySelector('.distance-group').classList.replace('col-lg-4', 'col-lg-3');
  search_form_elem.querySelector('.submit-group').classList.replace('col-lg-4', 'col-lg-3');
}

function hideDistanceInput() {
  search_form_elem.querySelector('.distance-group').classList.add('d-none');
  search_form_elem.querySelector('.treatment-group').classList.replace('col-lg-3', 'col-lg-4');
  search_form_elem.querySelector('.postcode-group').classList.replace('col-lg-3', 'col-lg-4');
  search_form_elem.querySelector('.distance-group').classList.replace('col-lg-3', 'col-lg-4');
  search_form_elem.querySelector('.submit-group').classList.replace('col-lg-3', 'col-lg-4');
}

/***/ }),

/***/ 2:
/*!*******************************************************!*\
  !*** multi ./resources/es6/components/search-form.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/Laravel/HealthCompare-Backend/resources/es6/components/search-form.js */"./resources/es6/components/search-form.js");


/***/ })

/******/ });
//# sourceMappingURL=search-form.js.map
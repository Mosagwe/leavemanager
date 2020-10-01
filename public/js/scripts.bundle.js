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
/******/ 	__webpack_require__.p = "/public/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/forms/actions.js":
/*!***************************************!*\
  !*** ./resources/js/forms/actions.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  // Ask the user if they really want to delete the record
  $('.table').on('click', '[data-action="delete"]', function (e) {
    e.preventDefault();
    var form = $(this).data('form');
    Swal.fire({
      title: 'Are you sure?',
      text: "Once deleted, you will not be able to recover the record",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(function (willDelete) {
      if (willDelete.value) {
        $(form).submit();
      }
    });
  }); // Ask the user if they really want to withdraw the record

  $('.table').on('click', '[data-action="withdraw"]', function (e) {
    e.preventDefault();
    var form = $(this).data('form');
    Swal.fire({
      title: 'Are you sure?',
      text: "Once withdrawn, you will not be able to recover the record",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then(function (willDelete) {
      if (willDelete.value) {
        $(form).submit();
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/forms/leave_application.js":
/*!*************************************************!*\
  !*** ./resources/js/forms/leave_application.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var leaveApplicationForm = $("#leaveApplicationForm");

  if (leaveApplicationForm.length > 0) {
    $.ajax({
      type: 'post',
      url: location.protocol + '//' + location.hostname + (location.port ? ':' + location.port : '') + "/dates/disabled",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        leave_request_id: $("#leave_request_id").val()
      },
      success: function success(data) {
        // Adjust Date picker
        $('.date').datepicker({
          autoclose: true,
          format: "yyyy-mm-dd",
          datesDisabled: data,
          startDate: '+1d',
          daysOfWeekDisabled: ['0', '6']
        }).on("changeDate", function () {
          renderSummary();
        });
        renderSummary();
      }
    });
    $("#leave_type").change(function () {
      var partial = $("#leave_type option:selected").data('partial');

      if (partial === 0) {
        $("input#days").prop('readonly', true).val($("#leave_type option:selected").data('max-days'));
      } else {
        $("input#days").removeAttr('readonly').val('');
      }
    });
    $("#leave_type, #start_at, #days").change(function () {
      renderSummary();
    });
    var partial = $("#leave_type option:selected").data('partial');

    if (partial === 0) {
      $("input#days").prop('readonly', true).val($("#leave_type option:selected").data('max-days'));
    } else {
      $("input#days").removeAttr('readonly');
    }

    renderSummary();
  }
});

function renderSummary() {
  if ($("#leave_type").val().length === 0) {
    $("#leaveSummary").hide();
    return false;
  }

  var selectedOption = $("#leave_type option:selected");
  var leaveType = selectedOption.text();
  var balance = selectedOption.data('balance');
  var daysInput = $("#days");
  daysInput.rules("add", {
    min: 1,
    max: balance
  });
  var result = '<div class="card">' + '                <div class="card-body">' + '                    <h5 class="card-title">Summary</h5>' + '                    <table id="summaryTable" class="table">' + '                        <tr>' + '                            <th>Leave Type</th>' + '                            <td>' + leaveType + '</td>' + '                        </tr>' + '                        <tr>' + '                            <th>Current Balance</th>' + '                            <td>' + balance + '</td>' + '                        </tr>' + '                     </table>' + '                     <table id="summaryDatesTable" class="table m-0">' + '                     </table>' + '                 </div>' + '         </div>';
  $("#leaveSummary").html(result).show();
  var days = daysInput.val();
  var startDate = $("#start_at").val();

  if (days.length !== 0 && startDate.length !== 0) {
    $.ajax({
      type: 'post',
      url: location.protocol + '//' + location.hostname + (location.port ? ':' + location.port : '') + "/applications/get-dates",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        leaveType: $("#leave_type").val(),
        startDate: startDate,
        days: days
      },
      success: function success(data) {
        $("#summaryDatesTable").html('<tr>' + '<th>Start Date</th>' + '               <td>' + startDate + '</td>' + '         </tr>' + '<tr>' + '<th>Applied Days</th>' + '               <td>' + days + '</td>' + '         </tr>' + '         <tr>' + '               <th>End Date</th>' + '               <td>' + data.endDate + '</td>' + '         </tr>' + '         <tr>' + '               <th>Reporting Date</th>' + '               <td>' + data.returnDate + '</td>' + '         </tr>');
        $("#calendar").datepicker('destroy').datepicker({
          format: "yyyy-mm-dd",
          startDate: startDate,
          endDate: data.endDate
        }).show();
      }
    });
  }
}

/***/ }),

/***/ "./resources/js/modals/decline.js":
/*!****************************************!*\
  !*** ./resources/js/modals/decline.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $('#declineModal').on('show.bs.modal', function (e) {
    var target = $(e.relatedTarget);
    $("#leaveRequestId").val(target.data('id'));
  });
});

/***/ }),

/***/ "./resources/js/modals/details.js":
/*!****************************************!*\
  !*** ./resources/js/modals/details.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {



/***/ }),

/***/ "./resources/js/scripts.js":
/*!*********************************!*\
  !*** ./resources/js/scripts.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./forms/actions */ "./resources/js/forms/actions.js");

__webpack_require__(/*! ./modals/decline */ "./resources/js/modals/decline.js");

__webpack_require__(/*! ./modals/details */ "./resources/js/modals/details.js");

__webpack_require__(/*! ./forms/leave_application */ "./resources/js/forms/leave_application.js");

$(function () {
  // Date picker
  $('.datepicker').datepicker({
    autohide: true,
    format: 'yyyy-mm-dd'
  }); // Handle setting the active class on menu

  var url = window.location;
  var link = $('ul.navbar-nav a').filter(function () {
    return this.href === url;
  });

  if (link.hasClass('collapse-item')) {
    link.addClass('active');
    link.closest('.collapse').addClass('show');
  }

  link.closest('.nav-item').addClass('active'); // Initialize all selects to select2

  $("form select.form-control").select2({
    theme: "bootstrap4"
  }); // Set the validation defaults

  jQuery.validator.setDefaults({
    errorElement: 'span',
    errorClass: 'invalid-feedback',
    focusInvalid: false,
    errorPlacement: function errorPlacement(error, element) {
      if (element.is('select')) {
        $(element).closest('div').append(error);
      } else {
        $(element).after(error);
      }
    },
    highlight: function highlight(element) {
      $(element).addClass('is-invalid').removeClass('is-valid');
    },
    unhighlight: function unhighlight(element) {
      $(element).removeClass('is-invalid').addClass('is-valid');
    }
  }); // Validate form

  $("form.validate-form").validate(); // Validate form on select

  $('form select').on('select2:select', function (e) {
    $(this).valid();
  });
});

/***/ }),

/***/ 1:
/*!***************************************!*\
  !*** multi ./resources/js/scripts.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\hksleavemanager-dev2\resources\js\scripts.js */"./resources/js/scripts.js");


/***/ })

/******/ });
/**
 * Main
 */

'use strict';

let menu, animate;

(function () {
  // Initialize menu
  //-----------------

  let layoutMenuEl = document.querySelectorAll('#layout-menu');
  layoutMenuEl.forEach(function (element) {
    menu = new Menu(element, {
      orientation: 'vertical',
      closeChildren: false
    });
    // Change parameter to true if you want scroll animation
    window.Helpers.scrollToActive((animate = false));
    window.Helpers.mainMenu = menu;
  });

  // Initialize menu togglers and bind click on each
  let menuToggler = document.querySelectorAll('.layout-menu-toggle');
  menuToggler.forEach(item => {
    item.addEventListener('click', event => {
      event.preventDefault();
      window.Helpers.toggleCollapsed();
    });
  });

  // Display menu toggle (layout-menu-toggle) on hover with delay
  let delay = function (elem, callback) {
    let timeout = null;
    elem.onmouseenter = function () {
      // Set timeout to be a timer which will invoke callback after 300ms (not for small screen)
      if (!Helpers.isSmallScreen()) {
        timeout = setTimeout(callback, 300);
      } else {
        timeout = setTimeout(callback, 0);
      }
    };

    elem.onmouseleave = function () {
      // Clear any timers set to timeout
      document.querySelector('.layout-menu-toggle').classList.remove('d-block');
      clearTimeout(timeout);
    };
  };
  if (document.getElementById('layout-menu')) {
    delay(document.getElementById('layout-menu'), function () {
      // not for small screen
      if (!Helpers.isSmallScreen()) {
        document.querySelector('.layout-menu-toggle').classList.add('d-block');
      }
    });
  }

  // Display in main menu when menu scrolls
  let menuInnerContainer = document.getElementsByClassName('menu-inner'),
    menuInnerShadow = document.getElementsByClassName('menu-inner-shadow')[0];
  if (menuInnerContainer.length > 0 && menuInnerShadow) {
    menuInnerContainer[0].addEventListener('ps-scroll-y', function () {
      if (this.querySelector('.ps__thumb-y').offsetTop) {
        menuInnerShadow.style.display = 'block';
      } else {
        menuInnerShadow.style.display = 'none';
      }
    });
  }

  // Init helpers & misc
  // --------------------

  // Init BS Tooltip
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Accordion active class
  const accordionActiveFunction = function (e) {
    if (e.type == 'show.bs.collapse' || e.type == 'show.bs.collapse') {
      e.target.closest('.accordion-item').classList.add('active');
    } else {
      e.target.closest('.accordion-item').classList.remove('active');
    }
  };

  const accordionTriggerList = [].slice.call(document.querySelectorAll('.accordion'));
  const accordionList = accordionTriggerList.map(function (accordionTriggerEl) {
    accordionTriggerEl.addEventListener('show.bs.collapse', accordionActiveFunction);
    accordionTriggerEl.addEventListener('hide.bs.collapse', accordionActiveFunction);
  });

  // Auto update layout based on screen size
  window.Helpers.setAutoUpdate(true);

  // Toggle Password Visibility
  window.Helpers.initPasswordToggle();

  // Speech To Text
  window.Helpers.initSpeechToText();

  // Manage menu expanded/collapsed with templateCustomizer & local storage
  //------------------------------------------------------------------

  // If current layout is horizontal OR current window screen is small (overlay menu) than return from here
  if (window.Helpers.isSmallScreen()) {
    return;
  }

  // If current layout is vertical and current window screen is > small

  // Auto update menu collapsed/expanded based on the themeConfig
  window.Helpers.setCollapsed(true, false);
})();

if (ClassicEditor) {
  ClassicEditor
    .create(document.querySelector('#content'))
    .catch(error => {
      console.error(error);
    });
}



// clipboard 
$(".copyLinkBtn").click(function () {
  let textToCopy = $(this).attr("data-url");
  navigator.clipboard.writeText(textToCopy)
    .then(() => {
      alertify.success('Link copied to the clipboard');
    })
    .catch(err => {
      console.error('Unable to copy text', err);
    });
});



window.ajaxFileUpload = function (url, fileInputElement, hiddenInputField, allowMultiple = false) {

  // Select all hidden input fields
  $('input[type="hidden"]').each(function () {

    var inputName = $(this).attr('name');
    let filepath = localStorage.getItem(inputName);

    if (filepath) {
      if (filepath.endsWith(".apk")) {
        $(this).val(filepath);
        $(this).after(`<span class="my-2 text-success"><strong>Recently uploaded: </strong> ${filepath}</span>`);
      }else{

        $(`#${inputName}img`).attr("src", "/" + filepath);
      }
    }
  });


  // Create a new instance of FilePond for the given file input element
  const pond = FilePond.create(document.querySelector(fileInputElement));

  // Set FilePond instance-specific options
  pond.setOptions({
    allowMultiple: allowMultiple,
    server: {
      process: {
        url: url, // Set the dynamic URL here
        method: 'POST',
        headers: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'Accept': 'application/json'
        },
        onload: (response) => {
          const responseData = JSON.parse(response);
          alertify.success(responseData.message);
          console.log(responseData);


          let uploadedUrl;
          if (hiddenInputField) {
            if (responseData.data.path.startsWith("public\\")) {
              uploadedUrl = responseData.data.path.replace("public\\", "");
            } else {
              uploadedUrl = responseData.data.path.replace("public/", "");
            }
            if (hiddenInputField) {
              // set the upload file path with their name attribute 
              localStorage.setItem(hiddenInputField, uploadedUrl);
              console.log("hiddenInputField", hiddenInputField);
              $(`#${hiddenInputField}`).val(uploadedUrl);
              $(`#${hiddenInputField}img`).attr("src", "/" + uploadedUrl);
            }
          }
          return response;
        },
        onerror: (response) => {
          console.error("Error occurred during file upload:", response);
          return response;
        },
      },
      revert: url, // You can customize the revert URL as well if needed
      restore: null,
      load: null,
    },
  });

  // Handle file process completion event
  pond.on('processfile', (error, file) => {
    if (error) {
      console.error('File processing failed:', error);
      const response = JSON.parse(error.body);
      if (error.type === "error") {
        alertify.error(response.statusCode + ": " + response.message);
      }
      return;
    }
  });
}

// Tooltip at main page for add post btn
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));



// Code Mirror initialize
let postType = cm_settings['postType'];
jQuery(document).ready(function($) {
    wp.codeEditor.initialize($(`#${postType}-code`), cm_settings);
  });



/**
 * addEntry.js
 * Handles the Clear button, form validation, and preview feature.
 */
(function () {
  'use strict';

  var form = document.getElementById('blog-form');
  var titleInput = document.getElementById('entry-title');
  var contentInput = document.getElementById('entry-post');
  var clearButton = document.getElementById('clear-button');

  var previewButton = document.getElementById('preview-button');
  var formPanel = document.getElementById('entry-form-panel');
  var previewPanel = document.getElementById('entry-preview-panel');
  var previewTitleText = document.getElementById('preview-title-text');
  var previewContentText = document.getElementById('preview-content-text');
  var previewConfirm = document.getElementById('preview-confirm');
  var previewEdit = document.getElementById('preview-edit');

  if (!form || !titleInput || !contentInput || !clearButton) {
    return;
  }

  function clearFieldErrors() {
    titleInput.classList.remove('error');
    contentInput.classList.remove('error');
  }

  function validateFields() {
    clearFieldErrors();

    var valid = true;

    if (titleInput.value.trim() === '') {
      titleInput.classList.add('error');
      valid = false;
    }

    if (contentInput.value.trim() === '') {
      contentInput.classList.add('error');
      valid = false;
    }

    return valid;
  }

  function showPreviewPanel() {
    if (!formPanel || !previewPanel) {
      return;
    }

    formPanel.hidden = true;
    previewPanel.hidden = false;
  }

  function showFormPanel() {
    if (!formPanel || !previewPanel) {
      return;
    }

    formPanel.hidden = false;
    previewPanel.hidden = true;
  }

  clearButton.addEventListener('click', function () {
    var confirmed = window.confirm('Are you sure you want to clear the title and post?');

    if (confirmed) {
      titleInput.value = '';
      contentInput.value = '';
      clearFieldErrors();
      showFormPanel();
    }
  });

  form.addEventListener('submit', function (event) {
    if (!validateFields()) {
      event.preventDefault();
    }
  });

  titleInput.addEventListener('input', clearFieldErrors);
  contentInput.addEventListener('input', clearFieldErrors);

  if (previewButton && previewPanel && previewTitleText && previewContentText) {
    previewButton.addEventListener('click', function () {
      if (!validateFields()) {
        return;
      }

      previewTitleText.textContent = titleInput.value.trim();
      previewContentText.textContent = contentInput.value.trim();

      showPreviewPanel();
    });
  }

  if (previewConfirm) {
    previewConfirm.addEventListener('click', function () {
      if (!validateFields()) {
        showFormPanel();
        return;
      }

      form.submit();
    });
  }

  if (previewEdit) {
    previewEdit.addEventListener('click', function () {
      showFormPanel();
    });
  }
})();
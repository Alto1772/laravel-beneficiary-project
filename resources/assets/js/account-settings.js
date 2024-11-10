/**
 * Account Settings - Account
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // const deactivateAcc = document.querySelector('#formAccountDeactivation');

    // Update/reset user image of account page
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input'),
      uploadFileButton = fileInput.parentElement,
      saveFileButton = document.querySelector('.account-image-save'),
      resetFileButton = document.querySelector('.account-image-reset');

    if (accountUserImage) {
      const resetImage = accountUserImage.src;
      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          saveFileButton.classList.remove('d-none');
          uploadFileButton.classList.add('d-none');
          accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
        }
      };
      resetFileButton.onclick = () => {
        fileInput.value = '';
        saveFileButton.classList.add('d-none');
        uploadFileButton.classList.remove('d-none');
        accountUserImage.src = resetImage;
      };
    }
  })();
});

'use strict';

(function (global) {
  /*
   * Delete modal
   */

  let selectedId = null;

  // Function to set the selected ID, to be called when opening the modal
  const setSelectedId = id => (selectedId = id);

  const getEntryId = () => selectedId;

  const deleteEntry = (id, routeTemplate) => {
    if (!id) {
      alert('No project selected for deletion.');
      return;
    }

    // Replace the placeholder with the actual ID
    const deleteRoute = routeTemplate.replace(':id', id);
    document.getElementById('deleteEntryForm').action = deleteRoute;

    // Submit the form
    document.getElementById('deleteEntryForm').submit();
  };

  // Example function to open the modal and set the selected ID
  const openDeleteModal = id => {
    setSelectedId(id);
    // Initialize and show the modal using Bootstrap's JavaScript API
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteEntryModal'));
    deleteModal.show();
  };

  const deleteButtons = document.querySelectorAll('#deleteEntryButton');
  const deleteModalForm = document.querySelector('#deleteEntryForm');
  const deleteAllModalForm = document.querySelector('#formDeleteAndAll');
  deleteButtons.forEach(button => button.addEventListener('click', () => openDeleteModal(button.dataset.id)));
  deleteModalForm.addEventListener('submit', event => {
    event.preventDefault();
    deleteEntry(getEntryId(), global.deleteRouteTemplate);
  });
  deleteAllModalForm.addEventListener('submit', event => {
    event.preventDefault();
    deleteEntry(getEntryId(), global.deleteAllRouteTemplate);
  });
})(window);

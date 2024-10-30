'use strict';

(function (global) {
  const municipalitySelect = document.getElementById('municipalitySelect');
  const barangaySelect = document.getElementById('barangaySelect');
  const barangayRow = document.getElementById('barangayRow');
  const submitButton = document.getElementById('submitButton');
  let barangaySelectAborter = null;

  const resetBarangaysSelection = () => {
    // If no municipality is selected, hide the barangay row and reset options
    barangaySelect.innerHTML = '<option value="" selected>-- Select Barangay --</option>';
    barangaySelect.disabled = true;
    barangayRow.classList.add('d-none');
    if (barangaySelectAborter) barangaySelectAborter.abort();
  };

  const populateBarangaysSelection = (municipalityId, selectedId = null) => {
    barangaySelectAborter = new AbortController();

    fetch(`/api/barangays/list/${municipalityId}`, { signal: barangaySelectAborter.signal })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        // Clear existing options
        resetBarangaysSelection();

        // Populate barangay select with new options
        data.barangays.forEach(barangay => {
          const option = document.createElement('option');
          option.value = barangay.id;
          option.text = barangay.name;
          if (selectedId !== null && selectedId === barangay.id) {
            option.selected = true;
          }
          barangaySelect.appendChild(option);
        });

        // Show the barangay selection row
        barangaySelect.disabled = false;
        barangayRow.classList.remove('d-none');
      })
      .catch(error => {
        if (error.name === 'AbortError') return;

        console.error('Error fetching barangays:', error);
        // Optionally, display an error message to the user
      });
  };
  const populateMunicipalitiesSelection = (selectedId = null) => {
    fetch('/api/municipalities/list')
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        // Clear existing options
        municipalitySelect.innerHTML = '<option value="" selected>-- Select Municipality --</option>';
        municipalitySelect.disabled = false;

        // Populate municipality select with new options
        data.municipalities.forEach(municipality => {
          const option = document.createElement('option');
          option.value = municipality.id;
          option.text = municipality.name;
          if (selectedId !== null && selectedId === municipality.id) {
            option.selected = true;
          }
          municipalitySelect.appendChild(option);
        });

        if (selectedId !== null) {
          municipalitySelect.dispatchEvent(new Event('change'));
        }
      });
  };

  document.addEventListener('DOMContentLoaded', function () {
    populateMunicipalitiesSelection(global.oldMunicipalityId);

    municipalitySelect.addEventListener('change', function () {
      const municipalityId = this.value;

      if (municipalityId) {
        populateBarangaysSelection(municipalityId, global.oldBarangayId);
        submitButton.disabled = false;
      } else {
        resetBarangaysSelection();
        submitButton.disabled = true;
      }
    });
  });
})(window);

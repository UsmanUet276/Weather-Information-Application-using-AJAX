$(document).ready(function () {
  $("#countryList").on("click", "li", function () {
    var countryId = $(this).data("id");

    // Perform AJAX request to get states for the selected country
    $.ajax({
      url: "./ajax/get_states.php",
      type: "POST",
      data: "country_id=" + countryId,
      success: function (response) {
        $("#stateList").html(response);
        $("#stateList").prop("disabled", false);
        $("#cityList").html(
          "<li class='p-2 cursor-not-allowed'>Select City</li>"
        );
        $("#cityList").prop("disabled", true);
      },
    });
  });

  $("#stateList").on("click", "li", function () {
    var stateId = $(this).data("id");

    // Perform AJAX request to get cities for the selected state
    $.ajax({
      url: "./ajax/get_cities.php",
      type: "POST",
      data: "state_id=" + stateId,
      success: function (response) {
        $("#cityList").html(response);
        $("#cityList").prop("disabled", false);
      },
    });
  });
});

$(document).ready(function () {
    // Function to handle item click
    function handleItemClick($list, itemId) {
      $list.find('li').removeClass('active'); // Remove active class from all items
      $list.find(`li[data-id="${itemId}"]`).addClass('active'); // Add active class to the clicked item
    }
  
    // Country item click
    $('#countryList').on('click', 'li', function () {
      var countryId = $(this).data('id');
      handleItemClick($('#countryList'), countryId);
  
      // TODO: Fetch and populate states based on the selected country using AJAX if needed
    });
  
    // State item click
    $('#stateList').on('click', 'li', function () {
      var stateId = $(this).data('id');
      handleItemClick($('#stateList'), stateId);
  
      // TODO: Fetch and populate cities based on the selected state using AJAX if needed
    });
  
    // City item click
    $('#cityList').on('click', 'li', function () {
      var cityId = $(this).data('id');
      handleItemClick($('#cityList'), cityId);
    });
  });


  document.addEventListener('DOMContentLoaded', function () {
    // Function to filter items based on the search input
    function filterItems(input, itemList) {
      const query = input.value.toLowerCase();
      const items = itemList.getElementsByTagName('li');
  
      for (const item of items) {
        const itemName = item.textContent.toLowerCase();
        const isVisible = itemName.includes(query);
        item.style.display = isVisible ? 'block' : 'none';
      }
    }
  
    // Function to handle country search
    function handleCountrySearch() {
      const countryInput = document.getElementById('countrySearch');
      const countryList = document.getElementById('countryList');
      filterItems(countryInput, countryList);
    }
  
    // Function to handle state search
    function handleStateSearch() {
      const stateInput = document.getElementById('stateSearch');
      const stateList = document.getElementById('stateList');
      filterItems(stateInput, stateList);
    }
  
    // Function to handle city search
    function handleCitySearch() {
      const cityInput = document.getElementById('citySearch');
      const cityList = document.getElementById('cityList');
      filterItems(cityInput, cityList);
    }
  
    // Attach event listeners to input fields
    document.getElementById('countrySearch').addEventListener('input', handleCountrySearch);
    document.getElementById('stateSearch').addEventListener('input', handleStateSearch);
    document.getElementById('citySearch').addEventListener('input', handleCitySearch);
  });

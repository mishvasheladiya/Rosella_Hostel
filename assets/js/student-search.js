document.addEventListener("DOMContentLoaded", () => {
  const searchToggle = document.getElementById("searchToggle");
  const searchModal = document.getElementById("searchModal");
  const closeSearch = document.getElementById("closeSearch");
  const searchInput = searchModal.querySelector('input[name="q"]');
  const searchResults = document.getElementById("searchResults");

  // Open modal
  searchToggle.addEventListener("click", () => {
    searchModal.style.display = "block";
    searchInput.focus();
  });

  // Close modal
  closeSearch.addEventListener("click", () => {
    searchModal.style.display = "none";
    searchResults.innerHTML = "";
    searchInput.value = "";
  });

  // Typing search
  searchInput.addEventListener("keyup", () => {
    let query = searchInput.value.trim();
    if (query.length < 2) {
      searchResults.innerHTML = "";
      return;
    }

    fetch(BASE_URL + "search.php?q=" + encodeURIComponent(query))
      .then(res => res.text())
      .then(data => {
        searchResults.innerHTML = data;
      })
      .catch(err => {
        console.error("Search error:", err);
        searchResults.innerHTML = "<div class='list-group-item text-danger'>Error loading results</div>";
      });
  });
});

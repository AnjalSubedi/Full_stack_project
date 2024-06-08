document.addEventListener('DOMContentLoaded', function() {
    const updateDate = document.getElementById('update-date');
    const lastUpdated = new Date(document.lastModified);
    updateDate.textContent = lastUpdated.toLocaleDateString();
  });
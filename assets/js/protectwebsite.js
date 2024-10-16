function ProtectPage() {
  // Protect the page content
  document.addEventListener("keydown", (event) => {
    if ((event.ctrlKey || event.metaKey) && event.keyCode === 67) {
      event.preventDefault();
    }
    if (
      (event.ctrlKey || event.metaKey) &&
      (event.shiftKey || event.metaKey) &&
      event.keyCode === 73
    ) {
      event.preventDefault();
    }
    if ((event.ctrlKey || event.metaKey) && event.keyCode === 85) {
      event.preventDefault();
    }
    if (event.keyCode === 123) {
      event.preventDefault();
    }
  });
}

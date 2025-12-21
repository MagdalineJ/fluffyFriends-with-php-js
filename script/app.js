function renderRatings() {
  const nodes = document.querySelectorAll(".rating[data-rating]");
  if (!nodes.length) return;

  const hasFontAwesome = !!document.querySelector(
    'script[src*="fontawesome"], link[href*="fontawesome"]'
  );

  nodes.forEach((el) => {
    const rating = parseInt(el.dataset.rating, 10) || 0;

    if (hasFontAwesome) {
      let html = "";
      for (let i = 1; i <= 5; i++) {
        html += i <= rating
          ? "<i class='fa-solid fa-star text-warning'></i>"
          : "<i class='fa-regular fa-star text-warning'></i>";
      }
      el.innerHTML = html;
    } else {
      let stars = "";
      for (let i = 1; i <= 5; i++) {
        stars += i <= rating ? "★" : "☆";
      }
      el.textContent = stars;
      el.style.fontSize = "1.1rem";
      el.style.letterSpacing = "2px";
    }
  });
}

function setupAboutToggle() {
  const aboutSection = document.getElementById("about");
  const aboutLink = document.getElementById("nav-about");
  const brandLink = document.getElementById("brand");

  if (!aboutSection) return;

  // Show About when clicking About link
  if (aboutLink) {
    aboutLink.addEventListener("click", function () {
      aboutSection.style.display = "block";
    });
  }

  // Show About when clicking brand
  if (brandLink) {
    brandLink.addEventListener("click", function () {
      aboutSection.style.display = "block";
    });
  }
}

function setupPrivacyModal() {
  const privacyLink = document.getElementById("privacy-link");
  const modalElement = document.getElementById("exampleModal");

  if (!privacyLink || !modalElement || typeof bootstrap === "undefined") return;

  privacyLink.addEventListener("click", function (e) {
    e.preventDefault();
    const modal = new bootstrap.Modal(modalElement);
    modal.show();
  });
}

function setupReviewsLink() {
  const reviewsBtn = document.getElementById("reviews-link"); 
  // give your Reviews element id="reviews-link"
  if (!reviewsBtn) return;

  reviewsBtn.addEventListener("click", function () {
    window.location.href = "reviews.php";
  });
}

function displayPets() {
  const perPage = 3;
  let start = 0;

  const container = document.getElementById("pets-container");
  if (!container) return;

  const cards = Array.from(container.querySelectorAll(".pet-card"));
  const prevBtn = document.querySelector(".prev");
  const nextBtn = document.querySelector(".next");

  function render() {
    cards.forEach((c, i) => {
      c.style.display = (i >= start && i < start + perPage) ? "" : "none";
    });

    if (prevBtn) prevBtn.disabled = (start === 0);
    if (nextBtn) nextBtn.disabled = (start + perPage >= cards.length);
  }

  if (prevBtn) prevBtn.addEventListener("click", () => {
    start = Math.max(0, start - perPage);
    render();
  });

  if (nextBtn) nextBtn.addEventListener("click", () => {
    start = Math.min(Math.max(0, cards.length - perPage), start + perPage);
    render();
  });

  render();
}

// Run safely on every page 
document.addEventListener("DOMContentLoaded", function () {
  renderRatings();
  displayPets();
  setupPrivacyModal();
  setupAboutToggle();
  setupReviewsLink();
});
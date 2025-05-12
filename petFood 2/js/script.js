document.addEventListener('DOMContentLoaded', function () {
      const petTypeFilter = document.getElementById('petType');
      const showDonations = document.getElementById('showDonations');

      petTypeFilter.addEventListener('change', filterListings);
      showDonations.addEventListener('change', filterListings);

      function filterListings() {
        const petType = petTypeFilter.value;
        const onlyDonations = showDonations.checked;
        alert(`Filtering: Type = ${petType}, Only Free = ${onlyDonations}`);
        // Here you would dynamically update the listings
      }

      document.getElementById('donationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Donation submitted!');
      });

      document.getElementById('sellForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Listing posted for sale!');
      });
    });


// food 
  document.addEventListener("DOMContentLoaded", () => {
    const carousel = document.getElementById("carousel");
    const leftBtn = document.querySelector(".left-btn");
    const rightBtn = document.querySelector(".right-btn");

    const getCardWidth = () => {
      const card = carousel.querySelector(".food-card");
      if (!card) return 260; // default card width fallback
      const style = window.getComputedStyle(card);
      return card.offsetWidth + parseInt(style.marginLeft) + parseInt(style.marginRight);
    };

    function scrollCarousel(direction) {
      const cardWidth = getCardWidth();
      const maxScrollLeft = carousel.scrollWidth - carousel.clientWidth;
      const currentScroll = carousel.scrollLeft;

      if (direction > 0) {
        const nextScroll = currentScroll + cardWidth;
        carousel.scrollTo({
          left: nextScroll >= maxScrollLeft ? 0 : nextScroll,
          behavior: "smooth"
        });
      } else {
        const prevScroll = currentScroll - cardWidth;
        carousel.scrollTo({
          left: prevScroll <= 0 ? maxScrollLeft : prevScroll,
          behavior: "smooth"
        });
      }
    }

    if (leftBtn && rightBtn) {
      leftBtn.addEventListener("click", () => scrollCarousel(-1));
      rightBtn.addEventListener("click", () => scrollCarousel(1));
    }

    setInterval(() => scrollCarousel(1), 3500);
  });


//   sell and donate


  function togglePriceField() {
    const actionSelect = document.getElementById("action");
    const priceGroup = document.getElementById("price-group");
    const priceInput = document.getElementById("price");

    if (actionSelect.value === "sell") {
      priceInput.type = "text";
      priceInput.placeholder = "Enter amount in BDT";
      priceInput.value = "";
    } else {
      priceInput.type = "text";
      priceInput.placeholder = "";
      priceInput.value = "Donated";
    }
  }

  // Set initial state on load
  window.onload = togglePriceField;


//   sign in


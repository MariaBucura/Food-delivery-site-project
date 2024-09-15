function toggleLoginForm() {
  var loginFormPopup = document.getElementById("loginFormPopup");
  loginFormPopup.style.display = loginFormPopup.style.display === "block" ? "none" : "block";
}

function toggleImage(event) {
  event.preventDefault();
    var image = document.getElementById('popup-image');
    if (image.style.display === 'none' || image.style.display === '') {
        image.style.display = 'block';
    } else {
        image.style.display = 'none';
    }
}

function closePopupImage() {
  var popup = document.getElementById("popup-image");
  popup.style.animation = "fadeOut 0.3s ease-in-out";
  setTimeout(function() {
    popup.style.display = "none";
    popup.style.animation = "";
  }, 300)
}

function openSidebar() {
  document.getElementById("sidebar").style.width = "350px";
}


function closeSidebar() {
  document.getElementById("sidebar").style.width = "0";
}

function openCartSidebar() {
  document.getElementById("cart-sidebar").style.width = "700px";
}


function closeCartSidebar() {
  document.getElementById("cart-sidebar").style.width = "0";
}

function closeLoginForm() {
  var loginFormPopup = document.getElementById("loginFormPopup");
  loginFormPopup.style.animation = "fadeOut 0.3s ease-in-out";
  setTimeout(function() {
    loginFormPopup.style.display = "none";
    loginFormPopup.style.animation = "";
  }, 300);
}

// Close the login form when clicking outside of it
window.onclick = function(event) {
  var loginFormPopup = document.getElementById("loginFormPopup");
  if (event.target == loginFormPopup) {
    closeLoginForm();
  }
}

function displayCartNumber(){
  document.getElementById("cart-nr").style.opacity = "1";
}


function toggleSigninForm() {
  var signinFormPopup = document.getElementById("signinFormPopup");
  signinFormPopup.style.display = signinFormPopup.style.display === "block" ? "none" : "block";
}

function closeSigninForm() {
  var signinFormPopup = document.getElementById("signinFormPopup");
  signinFormPopup.style.animation = "fadeOut 0.3s ease-in-out";
  setTimeout(function() {
    signinFormPopup.style.display = "none";
    signinFormPopup.style.animation = "";
  }, 300);
}

// Close the login form when clicking outside of it
window.onclick = function(event) {
  var signinFormPopup = document.getElementById("signinFormPopup");
  if (event.target == signinFormPopup) {
    closeSigninForm();
  }
}

function logout() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          console.log("PHP code executed successfully");
      }
  };
  xhttp.open("GET", "logout.php", true);
  xhttp.send();
}

const counties = [
  "Alba", "Arad", "Argeş", "Bacău", "Bihor", "Bistriţa-Năsăud", "	Botoşani", "Braşov", "Brăila", "Buzău", "Caraş-Severin", "Călăraşi", "Cluj", "Constanţa", "Covasna", "Dâmboviţa", "Dolj", "Galaţi", "Giurgiu", "Gorj", "Harghita", "Hunedoara", "Ialomiţa", "Iaşi", "Ilfov", "Maramureş", "Mehedinţi", "Mureş", "Neamţ", "Olt", "Prahova", "Satu Mare", "Sălaj", "Sibiu", "Suceava", "Teleorman", "Timiş", "Tulcea", "Vaslui", "Vâlcea", "Vrancea", "Bucureşti"
];

function filterCounties(input) {
  const dropdownList = document.getElementById('county-list');
  dropdownList.innerHTML = '';
  const filteredCounties = counties.filter(county => county.toLowerCase().includes(input.toLowerCase()));
  filteredCounties.forEach(county => {
      const option = document.createElement('div');
      option.textContent = county;
      option.classList.add('dropdown-item');
      option.addEventListener('click', () => {
          document.querySelector('.dropdown-input').value = county;
          dropdownList.innerHTML = '';
      });
      dropdownList.appendChild(option);
  });
}



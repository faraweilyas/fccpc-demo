var now     = new Date(),
    options = {
        year: 'numeric'
    },
    date    = now.toLocaleString('en-us', options),
    year    = document.querySelector(".year");

year.innerHTML = date;

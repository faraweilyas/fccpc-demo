var now = new Date();
    var options = {
        year: 'numeric'
    };

    var date = now.toLocaleString('en-us', options);
    var year = document.querySelector(".year");

    year.innerHTML = date;
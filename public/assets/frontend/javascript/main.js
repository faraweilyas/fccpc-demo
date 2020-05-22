/**
  * Main JS File
  *
  * @package  hdy
  * @author   Kabolobari Benakole <i@kb.life>
*/

// Re-wrap images and iframes with figure element
new Vue({
    data: {
        contentImages: document.querySelectorAll('[content] p img'),
        iframes: document.querySelectorAll('iframe'),
    },
    created() {
        // Replacing all images with figure and caption...
        if (this.contentImages) {
            this.contentImages.forEach((element, i) => {
                let parentImg = element.closest('p'),
                    figure = document.createElement('figure')
                figure.innerHTML = `
                    <img src="${element.src}" alt="${element.alt}" class="preferred-image-heights">
                    <figcaption>${element.alt}</figcaption>
                `
                parentImg.parentNode.replaceChild(figure, parentImg)
            })
        }

        // Replacing all iframes with figure and figcaption...
        if (this.iframes) {
            this.iframes.forEach(element => {
                let figure = document.createElement('figure')
                figure.classList.add('video-wrapper')
                figure.innerHTML = `
                    <iframe src="${element.src}" frameborder="0" allowfullscreen></iframe>
                `
                element.parentNode.replaceChild(figure, element)
            })
        }
    },
})


var closebtn = document.querySelector(".closebtn")
var openbtn = document.querySelector(".openbtn")


function closeNav() {
    console.log("hello")
    document.getElementById("myNav").style.width = "0%";
}

function openNav() {
    document.getElementById("myNav").style.width = "100%";
}



closebtn.addEventListener("click", closeNav);
openbtn.addEventListener("click", openNav);





var contentImages = document.querySelectorAll('[data-content] p img')
if (contentImages) {
    contentImages.forEach((element, i) => {
        let parentImg = element.closest('p'),
            figure = document.createElement('figure')
        figure.innerHTML = `
            <img src="${element.src}" alt="${element.alt}" class="spaced-image">
            <figcaption><em>${element.alt}</em></figcaption>
        `
        parentImg.parentNode.replaceChild(figure, parentImg)
    })
}

function fetchData() {
    const testimonials = document.getElementById("testimonials")
    const homeTestimonials = document.getElementById("home-testimonials")


    fetch("https://cpc-user-api.bluegreensoft.com/v1/noauth/testimonials")
        .then(response => response.json())
        .then(res => {
            let output = ``
            let data = res.data;
            //console.log(res);
            if (testimonials) {
                data.forEach(testimonial => {
                    output += `<div>
                    <h4>${testimonial.user.firstName} ${testimonial.user.lastName}</h4>
                    <p>${testimonial.message}</p>
                    </div>`

                    testimonials.innerHTML = output;
                })
            }
            if (homeTestimonials) {
                data.forEach(testimonial => {
                    output += `<li class="carousel-cell p-2 d-flx fd-c j-c-c tx-c">
                        <p>${testimonial.message}</p>
                        <h4 class="m-0">${testimonial.user.firstName} ${testimonial.user.lastName}</h4>
                    </li>`

                    homeTestimonials.innerHTML = output;
                    homeTestimonials.setAttribute('data-flickity', '{ "autoPlay": 4000, "contain": true, "prevNextButtons": true, "pageDots": false, "wrapAround": true}')
                })

                var flic = new Flickity(homeTestimonials, {
                    "autoPlay": 4000,
                    "contain": true,
                    "prevNextButtons": true,
                    "pageDots": false,
                    "wrapAround": true
                });

                flic();
            }

        })
        .catch(error => console.log(error))
}

fetchData()
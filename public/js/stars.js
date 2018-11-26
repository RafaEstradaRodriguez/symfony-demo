document.querySelectorAll(".fa-star").forEach( estrella => {
    estrella.addEventListener('click', (event) => {
        event.preventDefault();
        const url = estrella.getAttribute('data-url');
        fetch(url).then(response => {
            response.json().then(content => {
                estrella.classList.toggle('fas');
                estrella.parentNode.append(content.stars);
               console.log(content.stars);
            });
        })
    });
});

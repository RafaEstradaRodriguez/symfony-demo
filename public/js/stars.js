document.querySelectorAll(".fa-star").forEach( estrella => {
    estrella.addEventListener('click', (event) => {
        event.preventDefault();
        var url = estrella.getAttribute('data-url');
        fetch(url).then(response => {
            response.json().then(content => {
                estrella.classList.toggle('fas');
                estrella.parentNode.append(content.stars);
                if (url.indexOf('unstar')>-1){
                    estrella.setAttribute('data-url', url.replace('unstar', 'star'));
                } else {
                    estrella.setAttribute('data-url', url.replace('star', 'unstar'));
                }
               console.log(content.stars);
            });
        })
    });
});

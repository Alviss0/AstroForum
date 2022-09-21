const openCloseDropList = () => {
    let menuLinks = document.getElementsByClassName('drop-list');

    for (let i = 0; i < menuLinks.length; i++) {
        let menuLink = menuLinks[i];
        //let submenu = menuLink.nextElementSibling;
        let submenu = document.getElementsByClassName('submenu-list')[i];

        menuLink.addEventListener('click', function () {
            if(!menuLink.classList.contains('clicked')) {
                menuLink.classList.add('clicked');
                submenu.classList.add('active');
            }
            else {
                menuLink.classList.remove('clicked');
                submenu.classList.remove('active');
            }
        })
    }
}

openCloseDropList();
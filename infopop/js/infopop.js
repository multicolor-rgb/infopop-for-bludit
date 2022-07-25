const Infopop = document.querySelector('.bulb-content');
    const closeInfopop = document.querySelector('.bulb-content .toper-close');
    closeInfopop.addEventListener('click',()=>{
        Infopop.style.display="none";	
    localStorage.closeToperForever = "kliknięto zamknij";
    });        
 
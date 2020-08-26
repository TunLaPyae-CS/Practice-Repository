const watchButtons = document.querySelectorAll('.popupClick a')

watchButtons.forEach(watchButton => {
    console.log(watchButton);
    watchButton.addEventListener('click',(e)=>{
        const videoid = watchButton.dataset.videoid;
        showPopup(videoid);
    })
});

const showPopup = (videoid) => {
    let elem = document.createElement('div');
    elem.innerHTML = '<i id = "removepopup"style = "z-index :7;color: white; position:absolute; top:300px; left:275px; font-size:3em">x</i><iframe width="560" height="315" src="https://www.youtube.com/embed/'+videoid+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    elem.classList.add('iframepopup')
    document.getElementById('popup').appendChild(elem);
    const closeButton = document.querySelector('#removepopup');
    closeButton.addEventListener('click',(e)=>{
        let child = document.getElementsByClassName('iframepopup')[0];
        let parent = document.getElementById('popup');
        parent.removeChild(child); 
    })
}

const printclose = () => {
    
}
const searchButton = document.querySelector('.search-button');
const keyword = document.querySelector('.keyword');
const container = document.querySelector('.container');

//hide search button
searchButton.style.display = 'none';

//event when type keyword
keyword.addEventListener('keyup', function (){

    //ajax
    //1 - xmlhttprequest
    // const xhr = new XMLHttpRequest();

    // xhr.onreadystatechange = function(){

    //     if(xhr.readyState == 4 && xhr.status == 200){
    //        container.innerHTML = xhr.responseText;
    //     }
    // };

    // xhr.open('get', 'ajax/ajax_search.php?keyword=' + keyword.value);
    // xhr.send();

    //2 - fetch()
    fetch('ajax/ajax_search.php?keyword=' + keyword.value)
    .then((response) => response.text())
    .then((response) => (container.innerHTML = response));

});
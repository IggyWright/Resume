/* Used to call to our dB ajax functions */
// function ajaxFunctions(
//     endpoint,
//     functionName,
//     argumentsList,
//     beforeFunc = function(){},
//     doneFunc = function(result){}
// ) {
//     return $.ajax({
//         type: "POST",
//         url: '/ajaxFunctions/' + endpoint,
//         dataType: 'json',
//         data: {functionname: functionName, arguments: argumentsList},
//         beforeSend: beforeFunc
//     }).done(function(response) {
//         //error handle
//         if('error' in response) {
//             console.error(response['error']);
//         }
//
//         if('result' in response) {
//             var result = response['result'];
//             doneFunc(result);
//         } else {
//             console.log("ERROR NO RESULT");
//         }
//     });
// }


/*
    NAVIGATION functions
*/
function showDropdownLinksAndChangeMenu() {
    //get container and show links
    container = document.getElementById("dropdownNavController");
    // $('#dropdownNavLinks').css('display', 'flex');
    //change inner text
    container.children[0].innerHTML = "X";
    container.children[1].innerHTML = "Close";
    //change border and box shadow
    container.style.border = "solid red 2px";
    container.style.boxShadow = "0 0 5px 2px red";
    //move links menu down
    $('#dropdownNavLinks').css('top', 'var(--navigation-height)');
    //change onclick so it can close
    document.getElementById("dropdownNavHeader").onclick = hideDropdownLinksAndChangeMenu;
}

function hideDropdownLinksAndChangeMenu() {
    //get container and close links
    container = document.getElementById("dropdownNavController");
    // $('#dropdownNavLinks').css('display', 'none');
    //change inner text
    container.children[0].innerHTML = "&#9776;";
    container.children[1].innerHTML = "Menu";
    //change border and box shadow
    container.style.border = "solid var(--secondary-color) 2px";
    container.style.boxShadow = "0 0 5px 2px var(--secondary-color)";
    //move links menu up
    $('#dropdownNavLinks').css('top', 'calc(-100vh + var(--navigation-height))');
    //change onclick so it can show links
    document.getElementById("dropdownNavHeader").onclick = showDropdownLinksAndChangeMenu;
}

/*
    Misc functions
*/
// function capitalizeFirstLetter(string) {
//   return string.charAt(0).toUpperCase() + string.slice(1);
// }
//
// const rgb2hex = (rgb) => `#${rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/).slice(1).map(n => parseInt(n, 10).toString(16).padStart(2, '0')).join('')}`
//
// function hexToRgb(hex) {
//     hex = hex.substring(1);
//     console.log(hex);
//
//     var bigint = parseInt(hex, 16);
//     var r = (bigint >> 16) & 255;
//     var g = (bigint >> 8) & 255;
//     var b = bigint & 255;
//
//     return "(" + r + ", " + g + ", " + b + ")";
// }

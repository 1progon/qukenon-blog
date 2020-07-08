import {startClickOnGroup} from "./start-click-on-group.js";

$(document).ready(function () {

    $.ajaxSetup({
        url: "/old-blog/skins-market/get-skins.php",
        method: 'POST',
        dataType: 'json'
    });

    $(".skinsGroup").on("click", startClickOnGroup);

    $('.flash-message').on('click', (e) => {
        $(e.target).remove();
    })
});






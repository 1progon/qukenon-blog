import {getSkinsAjax} from "./get-skins-ajax.js";

export function startClickOnGroup(event) {
    let dataResult = $('#dataResult');
    let hidden = dataResult.hasClass('hide');
    if (location.hash) {
        location.hash = '';
    }
    if (!hidden) {
        dataResult.addClass('hide');
    }

    $('#dataResult-payment-form').remove();
    $('#dataResult-free-skins').remove();

    let mainLoader = document.querySelector('.loader');
    $('.loader').removeClass('hide');
    mainLoader.scrollIntoView({behavior: "smooth"});

    let skinsGroupName = event.currentTarget.id;
    return getSkinsAjax(skinsGroupName)
}

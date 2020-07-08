import {getSkinsAjax} from "./get-skins-ajax.js";
import {loading} from "./loading.js";
import {popupOnSkinImage} from "./popup-on-skin-image.js";
import {buySkinForm} from "./buy-skin-form.js";
import {backButtonClick} from "./back-button-click.js";
import {nextButtonClick} from "./next-button-click.js";
import {freeOnPrice} from "./free-on-price.js";

export function getSkins(data, skinsGroupName, eachNum = 0) {
    // console.log(data);

    let elem = document.getElementById("returnedContent");
    let pageNum = +(data.pageNum);
    let length = +(data.length);

    if (length === 0) {
        return getSkinsAjax(skinsGroupName);
    }
    let price = +(data.items[eachNum].price);
    let usd = +(data.currencies.USD.Value);
    let skinImageBlock = $('#returnedContent #skinImageBlock');
    let skinImage = $('#returnedContent #skinImage');
    let getFreeSkinButton = $('#getFreeSkin');
    let backBtn = $("#back");
    let nextBtn = $("#next");
    let buySkinBtn = $('#buySkin');


    getFreeSkinButton.off('click');
    buySkinBtn.off('click');
    backBtn.off('click');
    nextBtn.off('click');
    $('.loader').addClass('hide');
    $('#freeSkinInfo').remove();
    $('#dataResult-payment-form').remove();
    $('#dataResult-free-skins').remove();

    location.href = location.href
        .replace(location.hash, '') + '#page-' + pageNum + '-item-' + eachNum;

    price = Math.ceil(price * usd * 1.9);

    if (price === 1) {
        price = 2;
    }


    freeOnPrice(price);


    elem.dataset.returnedSkins = skinsGroupName;
    elem.dataset.skinEach = eachNum;

    elem.dataset.skinId = data.items[eachNum].item_id;


    $('#dataResult #pageIndex').text('Страница со скинами: ' + pageNum);
    $('#dataResult #itemIndex').text('Номер по порядку: ' + (eachNum + 1));


    $('#returnedContent #skinDescription').text(data.items[eachNum].market_hash_name);

    if (data.items[eachNum].stickers !== null) {
        $('#skinStickersBlock').removeClass('hide');
        let stickersPlace = $('#returnedContent #skinStickers');
        stickersPlace.text('');

        data.items[eachNum].stickers.forEach(item => {
            stickersPlace.html(stickersPlace.text()
                + '<br />'
                + item.name
                + '<img src="' + item.url + '" alt="' + item.name + '">'
            )
        })
    } else {
        $('#skinStickersBlock').addClass('hide');
    }

    if (data.items[eachNum].item_quality === 'StatTrak™') {
        $('#isStatTrakBlock').removeClass('hide');
        $('#isStatTrak').text('StatTrak™');
    } else {
        $('#isStatTrakBlock').addClass('hide');
    }

    if (data.items[eachNum].item_quality === 'Souvenir') {
        $('#isSouvenirBlock').removeClass('hide');
        $('#isSouvenir').text('Сувенирный');
    } else {
        $('#isSouvenirBlock').addClass('hide');
    }

    $('#returnedContent #skinPrice').text(price + ' руб.');


    $('#closeReturnedContent').on('click', () => {
        $('#closeReturnedContent').off('click');
        $("#dataResult").addClass('hide');
        $('#dataResult-payment-form').remove();
        $('#dataResult-free-skins').remove();
        location.hash = '';
    });

    skinImage.attr({
        src: data.items[eachNum].image,
        alt: data.items[eachNum].market_hash_name,
    });

    skinImage.removeAttr('style');

    skinImageBlock.on('click', () => {
        popupOnSkinImage(data, eachNum);
    });


    if ($(window).width() <= 1365) {
        document.getElementById('pageIndex')
            .scrollIntoView({behavior: 'smooth'});
    }

    buySkinBtn.on('click', () => {
        buySkinForm(data, eachNum, price);
    });

    backButtonClick(data, eachNum, pageNum, skinsGroupName);

    nextButtonClick(data, eachNum, pageNum, skinsGroupName);

    loading(false);
    $("#dataResult").removeClass('hide');
}

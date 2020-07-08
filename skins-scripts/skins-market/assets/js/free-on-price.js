import {activateFreeSkins} from "./activate-free-skins.js";

export function freeOnPrice(price) {
    let getFreeSkinButton = $('#getFreeSkin');

    if (price >= 99999) {
        getFreeSkinButton.attr('disabled', 'disabled');
        getFreeSkinButton
            .after('<span id="freeSkinInfo"><img' +
                ' style="vertical-align:' +
                ' middle;" src="/old-blog/skins-market/assets/images/info-icon.svg" alt="информация как получить скины кс го бесплатно"' +
                ' width="16" height="16"></span>');
    } else {
        getFreeSkinButton.removeAttr('disabled');

        getFreeSkinButton.on('click', () => {
            getFreeSkinButton.off('click');
            $('#dataResult-payment-form').remove();
            activateFreeSkins();
        })
    }

}

import {loading} from "./loading.js";
import {getSkinsAjax} from "./get-skins-ajax.js";
import {getSkins} from "./get-skins.js";

export function nextButtonClick(data, eachNum, pageNum, skinsGroupName) {
    let nextBtn = $("#next");
    nextBtn.on('click', () => {
        loading();
        $("#back").off('click');
        nextBtn.off('click');
        $('#dataResult-payment-form').remove();
        $('#dataResult-free-skins').remove();

        if (eachNum >= 0 && eachNum < length - 1) {
            eachNum += 1;
            return setTimeout(getSkins, 500, data, skinsGroupName, eachNum);
        } else if (eachNum === length - 1) {
            eachNum = 0;
            pageNum += 1;
            data = {};
            return getSkinsAjax(skinsGroupName, pageNum, eachNum);
        }
    })
}

import {loading} from "./loading.js";
import {getSkinsAjax} from "./get-skins-ajax.js";
import {getSkins} from "./get-skins.js";

export function backButtonClick(data, eachNum, pageNum, skinsGroupName) {
    let backBtn = $("#back");
    backBtn.on('click', () => {

        loading();
        backBtn.off('click');
        $("#next").off('click');
        $('#dataResult-payment-form').remove();
        $('#dataResult-free-skins').remove();

        if (eachNum > 0 && eachNum < length) {
            eachNum -= 1;
            return setTimeout(getSkins, 500, data, skinsGroupName, eachNum);
        } else if (eachNum === 0) {
            if (pageNum > 1) {
                eachNum = length - 1;
                pageNum -= 1;
                data = {};
                return getSkinsAjax(skinsGroupName, pageNum, eachNum);
            }
            return setTimeout(getSkins, 500, data, skinsGroupName, eachNum);
        }
    })
}

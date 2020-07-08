import {getSkins} from "./get-skins.js";

export function getSkinsAjax(skinsGroupName, pageNum = 1, eachNum = 0, delay = 1000) {
    setTimeout(() => {
        return $.ajax({
            data: {
                page: pageNum,
                category: skinsGroupName
            }
        }).then(
            data => getSkins(data, skinsGroupName, eachNum),
            err => console.error('ERROR:\n', err)
        )
    }, delay);
}

export function popupOnSkinImage(data, eachNum) {
    let skinImageBlock = $('#returnedContent #skinImageBlock');
    skinImageBlock.off('click');
    let popupImageBlock = $('#popupImageBlock');
    let popupImage = $('#popupImage');
    let newImageLink = data.items[eachNum].image.replace('/256fx256f', '/512fx512f');
    popupImage.attr('src', newImageLink);
    popupImageBlock.removeClass('hide');

    popupImageBlock.on('click', () => {
        popupImage.off('click');
        popupImage.attr('src', '');
        popupImageBlock.addClass('hide');
        skinImageBlock.on('click', () => {
            popupOnSkinImage(data, eachNum);
        });
    });
}

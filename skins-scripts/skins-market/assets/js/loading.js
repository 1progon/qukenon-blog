export function loading(action = true) {
    let content = $('#returnedContentData');
    let loader = $('#insideLoader');
    let image = $('#skinImage');
    if (action === true) {
        image.fadeOut(200, () => {
            image.attr({src: '', alt: ''});
            content.addClass('hidden');
            loader.removeClass('hide');
        });
        return;

    }

    content.removeClass('hidden');
    loader.addClass('hide');
}

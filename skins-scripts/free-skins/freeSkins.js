$(document).ready(function () {

    let button = document.getElementById("getFreeSkinsButton");
    let buttonBlock = document.getElementById("buttonBlock");
    let buttonCoordinate = button.getBoundingClientRect();
    let buttonBlockCoordinate = buttonBlock.getBoundingClientRect();

    $(window).scroll(function () {
        if (window.pageYOffset > buttonBlockCoordinate.y) {
            buttonBlock.style.position = 'fixed';
            buttonBlock.style.zIndex = '999';
            buttonBlock.style.top = '10px';
            buttonBlock.style.left = buttonCoordinate.x + 'px';
        } else {
            buttonBlock.removeAttribute('style');
        }
    });
    let ajaxRequest = (url = '', params = {}, method = 'POST', dataType = 'json') => {
        return new Promise((resolve, reject) => {
            return $.ajax({
                    url: url,
                    data: params,
                    method: method,
                    dataType: dataType,
                })
                .done(data => resolve(data))
                .fail(err => reject(err));
        })
    }





    let beforeButtonActive = 60;

    let token = document.getElementById("skinsForm").dataset.skinToken;
    let skinsButton = $("#getFreeSkinsButton");

    let buttonEnabledInterval = setInterval(() => {
        if (beforeButtonActive <= 0) {
            clearInterval(buttonEnabledInterval);
            $("#getFreeSkins").remove();
            skinsButton.removeAttr('disabled style');
            skinsButton.click(async () => {
                skinsButton.remove();
                window.scrollTo(0, 0);

                $("#skinsForm").html('Поиск доступных скинов в базе данных, ожидайте, поиск может занять какое-то' +
                    ' время... <br /><img alt="" src="/free-skins/tail-spin.svg" /><br />');

                let params = {
                    url: "/free-skins/skins-from-db.php",
                    skinsCount: true,
                    token: token
                }

                try {
                    const skinsCount = await ajaxRequest(params.url, params);
                    return callbackSkinsCount(parseInt(skinsCount.imagesCount, 10));
                } catch (err) {
                    return console.error("Error: ", "responseText: ", err.responseText, "status: ", err.status, "statusText: ", err.statusText, err);
                }
            });
        }

        $("#getFreeSkins").html('<img alt="" src="/free-skins/tail-spin.svg" /> Смотреть скины, которые можно получить' +
            ' бесплатно, <br />подождите пожалуйста, кнопка скоро будет доступна: <span style="font-size: 25px; color: blue">' + beforeButtonActive + '<\/span>');

        beforeButtonActive--;
    }, 1000);


    function callbackSkinsCount(count) {
        var foundSkinsCounter = 0;
        var startDelay = 15;
        var activeOrNot;
        var skinsCount = count;
        var middleTime = Math.floor(skinsCount / startDelay);


        function foundSkinsCount(foundSkinsCounter) {
            $("#skinsForm").html('Поиск доступных скинов в базе данных, ожидайте, поиск может занять какое-то' +
                ' время... <br /><img alt="" src="/free-skins/tail-spin.svg" /><br />Найдено скинов: <span' +
                ' style="font-size: 40px;' +
                ' font-weight: 700; color: blue">' + foundSkinsCounter + '<\/span>');
        }

        var wasFoundSkins = setInterval(() => {
            var isAlerted = false;
            activeOrNot = document.hasFocus();

            if (foundSkinsCounter >= skinsCount) {
                foundSkinsCounter = skinsCount;
                foundSkinsCount(foundSkinsCounter);

                clearInterval(wasFoundSkins);
                return startDelayInterval();
            }

            if (activeOrNot) {
                isAlerted = false;
                foundSkinsCounter += middleTime;
                foundSkinsCount(foundSkinsCounter);
            } else {
                if (!isAlerted) {
                    alert("Чтобы поиск прошёл успешно Вам нужно оставаться на этой странице, поиск временно остановлен. Приносим извинения!");
                    isAlerted = true;
                }
            }
        }, 1000);

        function startDelayInterval() {
            let startDelayInterval = setInterval(() => {
                var isAlerted = false;
                activeOrNot = document.hasFocus();
                if (startDelay <= 0) {
                    clearInterval(startDelayInterval);
                    return result(300, 0, skinsCount);
                }

                if (activeOrNot) {
                    isAlerted = false;
                    $("#skinsForm").html('Ещё совсем немного времени.... обработка..., осталось секунд ' + startDelay);
                    startDelay--;
                } else {
                    if (!isAlerted) {
                        alert("Чтобы поиск прошёл успешно Вам нужно оставаться на этой странице, поиск временно остановлен. Приносим извинения!");
                        isAlerted = true;
                    }
                }
            }, 1000);
        }
    }

    function result(counter, stopAt, skinsCount) {
        var windowActive = false;
        var isAlerted = false;

        var startTimer = setInterval(async () => {
            if (counter <= stopAt) {
                clearInterval(startTimer);

                try {
                    const jsonData = await ajaxRequest("/free-skins/skins-from-db.php", {
                        token: token
                    });
                    if (jsonData == null || jsonData.images == null || jsonData.images == undefined || jsonData.text == null) {
                        $("#skinsForm").text("Возможно какая-то ошибка, приносим извинения. В ближайшее время мы постараемся разобраться в данной проблеме");
                        return;
                    }
                    $("#skinsForm").html(jsonData.text);
                    let images = jsonData.images;
                    images.forEach((item, index) => {
                        $("#skinsFormImages").html($("#skinsFormImages").html() + "<br /><h2 style=\"text-align: center\">Скин: " + index + "<\/h2><br \/>" + "<img src=\"" + item + "\" alt=\"скин кс го оружие нож или автомат " + index + "\">");
                    });
                    $("#skinsFormImages").after('<div style="font-size: 25px;padding: 40px">' + $("#skinsForm").html() + '</div>');
                    return;
                } catch (err) {
                    return console.error("Error: ", err.responseText + " " + err.status + " " + err.statusText);
                }
            }

            $("#skinsForm").html("Найдено скинов <span style='font-size: 40px; font-weight: 700; color: blue'>" + skinsCount + "<\/span>, уррраа.<br />Подождите, идёт загрузка бесплатных скинов...<br />Пока бежит время...., пожалуйста, потратьте его с пользой на просмотр контента на этой странице! Никуда не уходите, и не переключайтесь...<br />Осталось секунд: <span style='font-size: 40px; font-weight: 700; color: red'>" + counter + "<\/span>!");

            windowActive = document.hasFocus();
            if (windowActive) {
                isAlerted = false;
                counter--;
            } else {
                if (!isAlerted) {
                    alert("Чтобы загрузка прошла успешно Вам нужно оставаться на этой странице, загрузка временно остановлена. Приносим извинения!");
                    isAlerted = true;
                }

                $("#skinsForm").html("Найдено скинов <span style='font-size: 40px; font-weight: 700; color: blue'>" + skinsCount + "<\/span>, уррраа.<br />Подождите, идёт загрузка бесплатных скинов...<br />Пока бежит время...., пожалуйста, потратьте его с пользой на просмотр контента на этой странице! Никуда не уходите, и не переключайтесь...<br /><span style='font-size: 40px; font-weight: 700; color: red'>Счётчик временно остановлен. Как только Вы вернётесь к просмотру страницы или нажмёте здесь, счетчик будет восстановлен. Спасибо<\/span>!");
            }
        }, 1000);
    }
});

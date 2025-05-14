BX.namespace('AholinCrmCustomTab.UselessExtensions.GreetingMessage');

BX.AholinCrmCustomTab.UselessExtensions.GreetingMessage = {
    showMessage: function (message) {
        alert(message);
    },
    onStartWorkingDateAction: function (popupNodeId) {
        var popup = BX.PopupWindowManager.create("greeting-popup-message", BX(popupNodeId), {
            content: 'Вы хотите начать рабочий день?',
            width: 600, // ширина окна
            height: 400, // высота окна
            zIndex: 100, // z-index
            offsetTop: 0,
            offsetLeft: 600,
            closeIcon: {
                // объект со стилями для иконки закрытия, при null - иконки не будет
                opacity: 1
            },
            titleBar: 'Начало рабочего дня',
            closeByEsc: true, // закрытие окна по esc
            darkMode: false, // окно будет светлым или темным
            autoHide: true, // закрытие при клике вне окна
            draggable: true, // можно двигать или нет
            resizable: true, // можно ресайзить
            min_height: 100, // минимальная высота окна
            min_width: 100, // минимальная ширина окна
            lightShadow: true, // использовать светлую тень у окна
            angle: true, // появится уголок
            overlay: {
                backgroundColor: 'black',
                opacity: 500
            },
            buttons: [
                new BX.PopupWindowButton({
                    text: 'Начать', // текст кнопки
                    id: 'save-btn', // идентификатор
                    className: 'ui-btn ui-btn-success', // доп. классы
                    events: {
                        click: function() {
                            BX.AholinCrmCustomTab.UselessExtensions.GreetingMessage.startDate();
                        }
                    }
                }),
                new BX.PopupWindowButton({
                    text: 'Отмена',
                    id: 'copy-btn',
                    className: 'ui-btn ui-btn-primary',
                    events: {
                        click: function() {
                            popup.close();
                        }
                    }
                })
            ],
            events: {
                onPopupShow: function() {
                    BX.AholinCrmCustomTab.UselessExtensions.GreetingMessage.showMessage('Вы открыли окно начала рабочего дня!');
                },
                onPopupClose: function() {
                    BX.AholinCrmCustomTab.UselessExtensions.GreetingMessage.showMessage('Вы закрыли окно начала рабочего дня!');
                }
            }
        });

        popup.show();
    },
    startDate: function () {
        //
    }
};
BX.addCustomEvent('onTimeManWindowBuild', function () {
    let popupDiv = document.createElement('div');
    popupDiv.id = 'greeting-message-popup';
    window.body.appendChild(popupDiv);
    BX.AholinCrmCustomTab.UselessExtensions.GreetingMessage.onStartWorkingDateAction(popupDiv.id);
});

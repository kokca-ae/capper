(function () {

    if (typeof window.CustomEvent === "function") return false;

    function CustomEvent(event, params) {
        params = params || { bubbles: false, cancelable: false, detail: undefined };
        var evt = document.createEvent('CustomEvent');
        evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
        return evt;
    }

    CustomEvent.prototype = window.Event.prototype;

    window.CustomEvent = CustomEvent;
})();


var modalOpenEvent = new CustomEvent("modal.open"),
    modalCloseEvent = new CustomEvent("modal.close"),
    modalInitEvent = new CustomEvent("modal.init"),
    modalBeforeOpenEvent = new CustomEvent("modal.before.open"),
    modalBeforeCloseEvent = new CustomEvent("modal.before.close")

// var overlay = $('.modalsScroll #overlay')

var openMod = function () {
    $("[data-modal]").map(function () {
        $(this).on("click", modalEvent)
        var el = document.getElementById($(this).attr('data-modal'))
        if (!$(el).hasClass("init-modal")) {
            el.dispatchEvent(modalInitEvent)
            $(el).addClass("init-modal")
        }
    })
    $(".modalsScroll .close").on("click", closeModal)
    $(".modalsScroll #overlay").on("click", closeModal)
}

var modalEvent = function () {
    var s = ".modalsScroll:not([data-modalid])";
    if ($(this).attr("data-modalid")) {
        s = ".modalsScroll#" + $(this).attr('data-modalid')
    }
    if ($(s + " .blockMod.open").length > 0) {
        openOtherModal($(this))
    } else {
        openModal($(this))
    }
}
var openOtherModal = function (elem) {
    closeModalOnly()
    setTimeout(function () {
        openModalOnly(elem)
    }, 500)
}
var openModal = function (elem) {
    var s = ".modalsScroll:not([data-modalid])";
    // console.log(s)
    if (elem.attr("data-modalid")) {
        s = ".modalsScroll#" + elem.attr('data-modalid')
    }
    // console.log(s)
    $('.modalsScroll #overlay').fadeIn(500)
    var el = document.getElementById(elem.attr('data-modal'))
    el.dispatchEvent(modalBeforeOpenEvent)
    $(s + " .blockMod#" + elem.attr('data-modal'))
        .addClass("open")
        .fadeIn(500, function () {
            el.dispatchEvent(modalOpenEvent)
        })
    var elIndex = $(s + " .blockMod#" + elem.attr('data-modal')).find(elem.attr('data-tab')).index() - 1
    $(s + " .blockMod#" + elem.attr('data-modal')).find(".tabs").tabs("option", "active", elIndex);

    $("html").addClass("bodyModal")
    $(s).addClass("open")
}
var openModalOnly = function (elem) {
    var s = ".modalsScroll:not([data-modalid])";
    if (elem.attr("data-modalid")) {
        s = ".modalsScroll#" + $(this).attr('data-modalid')
    }
    var el = document.getElementById(elem.attr('data-modal'))
    el.dispatchEvent(modalBeforeOpenEvent)
    $(s + " .blockMod#" + elem.attr('data-modal'))
        .addClass("open")
        .fadeIn(500, function () {
            el.dispatchEvent(modalOpenEvent)
        })
    var elIndex = $(s + " .blockMod#" + elem.attr('data-modal')).find(elem.attr('data-tab')).index() - 1
    $(s + " .blockMod#" + elem.attr('data-modal')).find(".tabs").tabs("option", "active", elIndex);
}
var closeModal = function () {
    $('.modalsScroll #overlay').fadeOut(500)
    var el = document.getElementById($(".modalsScroll .blockMod.open").attr('id'))
    el.dispatchEvent(modalBeforeCloseEvent)
    $(".modalsScroll .blockMod.open").fadeOut(500, function () {
        $(this).removeClass("open")
        $("html").removeClass("bodyModal")
        $(".modalsScroll").removeClass("open")
        el.dispatchEvent(modalCloseEvent)
    })
}
var closeModalOnly = function () {
    var el = document.getElementById($(".modalsScroll .blockMod.open").attr('id'))
    el.dispatchEvent(modalBeforeCloseEvent)
    $(".modalsScroll .blockMod.open").fadeOut(500, function () {
        $(this).removeClass("open")
        el.dispatchEvent(modalCloseEvent)
    })
}
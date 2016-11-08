$(document).ready(function () {
    /**
     * Sidebar Dropdown
     *  TODO find default solution
     * */
    $('.mdl-layout__drawer .mdl-navigation .expand-menu-button').click(function (event) {
        var parent = $(this).parent().parent();
        var submenu = parent.children('.mdl-navigation');
        if ($(submenu).css('height') == '0px') {
            $(submenu).css('height', 'auto');
            $(submenu).css('padding-top', '5px');
            $(submenu).css('margin-top', '10px');
            $(submenu).css('visibility', 'visible');
            $(this).parent().find('i.material-icons').html('expand_less');
        } else {
            submenu = $(parent).find('.mdl-navigation');
            submenu.each(function () {
                $(this).css('visibility', 'hidden');
                $(this).css('padding-top', '0px');
                $(this).css('margin-top', '0px');
                $(this).css('height', '0px');
                var ele = $(this).parent();
                ele.find('button:first i.material-icons').html('expand_more');
            });
            $(this).parent().find('i.material-icons').html('expand_more');
        }
    });

    /**
     * Header Dropdown
     * */
    $('header .mdl-navigation .expand-menu-button').click(function (event) {
        var parent = $(this).parent().parent();
        var submenu = parent.children('.mdl-navigation');
        if ($(submenu).css('height') == '0px') {
            $(submenu).css('height', 'auto');
            $(submenu).css('padding-top', '5px');
            $(submenu).css('visibility', 'visible');
            $(this).parent().find('i.material-icons').html('expand_less');
        } else {
            submenu = $(parent).find('.mdl-navigation');
            submenu.each(function () {
                $(this).css('visibility', 'hidden');
                $(this).css('padding-top', '0px');
                $(this).css('height', '0px');
                var ele = $(this).parent();
                ele.find('button:first i.material-icons').html('expand_more');
            });
            $(this).parent().find('i.material-icons').html('expand_more');
        }
    });

    /**
     *
     */
    $('body').click(function (event) {
        if ($(event.target) != $('.mdl-navigation__link a') && !($(event.target).hasClass('mdl-button__ripple-container'))) {
            $('header .mdl-layout__header-row > .mdl-navigation').each(function () {
                $(this).find('.mdl-navigation').each(function () {
                    $(this).css('visibility', 'hidden');
                    $(this).css('padding-top', '0px');
                    $(this).css('height', '0px');
                    var ele = $(this).parent();
                    ele.find('button:first i.material-icons').html('expand_more');
                });
            });
        }
    });
});
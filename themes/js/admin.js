$(document).ready(function () {
    $(".nav-treeview .nav-link, .nav-link").each(function () {
        const location2 = window.location.protocol + '//' + window.location.host + window.location.pathname;
        const link = this.href;
        if(link == location2){
            $(this).addClass('active');
            $(this).parent().parent().parent().addClass('menu-is-opening menu-open');

        }
    });
})
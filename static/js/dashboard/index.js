$(document).ready(function() {
    $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
            if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                $('.fixed-plugin .dropdown').addClass('open');
            }

        }

        $('.fixed-plugin a').click(function(event) {
            // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
            if ($(this).hasClass('switch-trigger')) {
                if (event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                }
            }
        });

        $('.fixed-plugin .active-color span').click(function() {
            $full_page_background = $('.full-page-background');

            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            var new_color = $(this).data('color');

            if ($sidebar.length != 0) {
                $sidebar.attr('data-color', new_color);
            }

            if ($full_page.length != 0) {
                $full_page.attr('filter-color', new_color);
            }

            if ($sidebar_responsive.length != 0) {
                $sidebar_responsive.attr('data-color', new_color);
            }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            var new_color = $(this).data('background-color');

            if ($sidebar.length != 0) {
                $sidebar.attr('data-background-color', new_color);
            }
        });

        $('.fixed-plugin .img-holder').click(function() {
            $full_page_background = $('.full-page-background');

            $(this).parent('li').siblings().removeClass('active');
            $(this).parent('li').addClass('active');


            var new_image = $(this).find("img").attr('src');

            if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                $sidebar_img_container.fadeOut('fast', function() {
                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $sidebar_img_container.fadeIn('fast');
                });
            }

            if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                $full_page_background.fadeOut('fast', function() {
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                    $full_page_background.fadeIn('fast');
                });
            }

            if ($('.switch-sidebar-image input:checked').length == 0) {
                var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
            }

            if ($sidebar_responsive.length != 0) {
                $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
            }
        });

        $('.switch-sidebar-image input').change(function() {
            $full_page_background = $('.full-page-background');

            $input = $(this);

            if ($input.is(':checked')) {
                if ($sidebar_img_container.length != 0) {
                    $sidebar_img_container.fadeIn('fast');
                    $sidebar.attr('data-image', '#');
                }

                if ($full_page_background.length != 0) {
                    $full_page_background.fadeIn('fast');
                    $full_page.attr('data-image', '#');
                }

                background_image = true;
            } else {
                if ($sidebar_img_container.length != 0) {
                    $sidebar.removeAttr('data-image');
                    $sidebar_img_container.fadeOut('fast');
                }

                if ($full_page_background.length != 0) {
                    $full_page.removeAttr('data-image', '#');
                    $full_page_background.fadeOut('fast');
                }

                background_image = false;
            }
        });

        $('.switch-sidebar-mini input').change(function() {
            $body = $('body');

            $input = $(this);

            if (md.misc.sidebar_mini_active == true) {
                $('body').removeClass('sidebar-mini');
                md.misc.sidebar_mini_active = false;

                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

            } else {

                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                setTimeout(function() {
                    $('body').addClass('sidebar-mini');

                    md.misc.sidebar_mini_active = true;
                }, 300);
            }

            // we simulate the window Resize so the charts will get updated in realtime.
            var simulateWindowResize = setInterval(function() {
                window.dispatchEvent(new Event('resize'));
            }, 180);

            // we stop the simulation of Window Resize after the animations are completed
            setTimeout(function() {
                clearInterval(simulateWindowResize);
            }, 1000);

        });

        /****
         * partie ou on récupère toutes les infos du site en AJAX
         */
        var username = 'Eminem15';
        var password = 'Eminem15';
        var toGet = '1';
        jqTimeOut(username, password, toGet);


        $.ajax({
            url : " ../BDD/API/utilisateur.php",
            type : "GET",
            data : "username=" + username + "&password=" + password+ '&toGet='+toGet,
            dataType : 'json',
            success: function(data, status){
                document.appareils = data.appareils;
                document.consommations = [];
            },
            error : function (status) {
                alert('erreur serveur');
            }
        });



    });
});




function jqTimeOut(username, password, toGet){
    setTimeout(function(){
        if(document.appareils !== undefined){
            for (var i = 0; i < document.appareils.length; i++) {
                var idA = document.appareils[i].IDappareil;
                $.ajax({
                    url : " ../BDD/API/consomation.php",
                    type : "GET",
                    data : "username=" + username + "&password=" + password+ '&userToGet='+toGet+'&idA='+idA,
                    dataType : 'json',
                    success: function(data, status){
                        if(data.code === 200){
                            document.consommations.push(data.conso);
                        }
                    },
                    error : function (status) {
                        // alert('erreur serveur');
                        console.log(status);
                    }
                });

            }
            checkConso();
        }else{
            jqTimeOut(username, password, toGet);
        }
    },100);
}


function checkConso() {
    setTimeout(function () {
        if(document.appareils.length === document.consommations.length){
            document.consoParJour = [];
            for (var j = 0; j < 7; j++) {
                var sum = 0;
                for (var i = 0; i < document.appareils.length; i++) {
                    var toAdd = document.consommations[i];
                    sum += toAdd[j] === undefined ? Number(0) : Number(toAdd[j].conso);
                }
                document.consoParJour.push(sum);
            }
            setGraph();
            setCards();
            // console.log(document.consommations);
            // console.log(document.appareils);
        }else{
            checkConso();
        }
    }, 100);
}


/***
 *
 *
 * partie pour le graphe
 */


function setGraph(){
    var ctxB = document.getElementById("barChart").getContext('2d');
    var myBarChart = new Chart(ctxB, {
        type: 'bar',
        data: {
            labels: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi","Dimanche"],
            datasets: [{
                label: 'KWh',
                data: document.consoParJour,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(10,93,255,0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(10,93,255,1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

}

function setCards() {
    for (var i = 0; i < 7; i++) {
        var elem = document.getElementById('jour'+(i+1));
        var list = elem.childNodes[3].childNodes[1];
        for (var j = 0; j < document.appareils.length; j++) {
            var elemToAdd = document.createElement("li");
            elemToAdd.innerText = document.appareils[j].nom + " : "  +
                (document.consommations[j][i] === undefined ? 0 : document.consommations[j][i].conso);
            // console.log(elemToAdd)
            list.appendChild(elemToAdd);
        }
    }
}


/***
 * partie sur les consommations
 */

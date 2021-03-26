window.Vue = require("vue");
import StarRating from 'vue-star-rating'

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

Vue.component('star-rating', StarRating);


if (document.getElementById("app")) {
    const app = new Vue({
        el: "#app"
    });
}

if (document.getElementById("apicategory")) {
    require("./admin/apicategory");
}

if (document.getElementById("apiproductCreate")) {
    require("./admin/apiproduct-create");
}

if (document.getElementById("apiproduct")) {
    require("./admin/apiproduct");
}

if (document.getElementById("apiprovider")) {
    require("./admin/apiprovider");
}

if (document.getElementById("confirmareliminar")) {
    require("./confirmareliminar");
}

if (document.getElementById("api_search_autocomplete")) {
    require("./admin/api_search_autocomplete");
}

if (document.getElementById("apiprueba")) {
    require("./tienda/apiprueba");
}

if (document.getElementById("appTienda")) {
    require("./tienda/appTienda");
}

if (document.getElementById("api_search_autocomplete_store")) {
    require("./tienda/api_search_autocomplete_store");
}

if (document.getElementById("api_search_autocomplete_store_small")) {
    require("./tienda/api_search_autocomplete_store_small");
}

if (document.getElementById("apirating")) {
    require("./tienda/apirating");
}

if (document.getElementById("apishopping")) {
    require("./admin/apishopping");
}

if (document.getElementById("api_direct_m")) {
    require("./tienda/api_direct_m");
}

if (document.getElementById("apiratingfinalclient")) {
    require("./tienda/apiratingfinalclient");
}

if (document.getElementById("apiratingBuyer")) {
    require("./tienda/apiratingBuyer");
}

$(document).ready(function() {
    initSvg();

    /*
    5. Init SVG
	*/

    function initSvg() {
        if ($("img.svg").length) {
            jQuery("img.svg").each(function() {
                var $img = jQuery(this);
                var imgID = $img.attr("id");
                var imgClass = $img.attr("class");
                var imgURL = $img.attr("src");

                jQuery.get(
                    imgURL,
                    function(data) {
                        // Get the SVG tag, ignore the rest
                        var $svg = jQuery(data).find("svg");

                        // Add replaced image's ID to the new SVG
                        if (typeof imgID !== "undefined") {
                            $svg = $svg.attr("id", imgID);
                        }
                        // Add replaced image's classes to the new SVG
                        if (typeof imgClass !== "undefined") {
                            $svg = $svg.attr(
                                "class",
                                imgClass + " replaced-svg"
                            );
                        }

                        // Remove any invalid XML tags as per http://validator.w3.org
                        $svg = $svg.removeAttr("xmlns:a");

                        // Replace image with new SVG
                        $img.replaceWith($svg);
                    },
                    "xml"
                );
            });
        }
    }
});

$(function () {

    if ($('#applocate').val() != '') {
        if ($('#applocate').val() == 'es') {
            $("#tableData").DataTable({
                "aaSorting": [],
                "responsive": true,
                "autoWidth": false,
                //"paginate": false,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });
        } else {
            $("#tableData").DataTable({
                "aaSorting": [],
                "responsive": true,
                "autoWidth": false,
            });
        }
    }
    
});

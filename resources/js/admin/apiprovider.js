const apiprovider = new Vue({
    el: "#apiprovider",
    data: {
        name: "",
        document: "",
        number: "",
        phone: "",
        email: "",
        slug: "",
        div_mensaje_slug: "Slug Existe",
        div_clase_slug: "badge badge-danger",
        div_aparecer: false,
        deshabilitar_boton: 1
    },
    methods: {
    },
    mounted(){
        if (document.getElementById('editar')) {
            this.name = document.getElementById('nametemp').innerHTML;
            this.document = document.getElementById('documenttemp').innerHTML;
            this.number = document.getElementById('numbertemp').innerHTML;
            this.phone = document.getElementById('phonetemp').innerHTML;
            this.email = document.getElementById('emailtemp').innerHTML;
            this.deshabilitar_boton = 0;
        }
    }
});

const apicategory = new Vue({
    el: "#apicategory",
    data: {
        nombre: "",
        slug: "",
        div_mensaje_slug: "Slug Existe",
        div_clase_slug: "badge badge-danger",
        div_aparecer: false,
        deshabilitar_boton: 1
    },
    computed: {
        generarSlug: function() {
            var char = {
                á: "a",
                é: "e",
                í: "i",
                ó: "o",
                ú: "u",
                Á: "A",
                É: "E",
                Í: "I",
                Ó: "O",
                Ú: "U",
                ñ: "n",
                Ñ: "N",
                " ": "-",
                _: "-"
            };
            var expr = /[áéíóúÁÉÍÓÚñÑ_ ]/g;

            this.slug = this.nombre
                .trim()
                .replace(expr, function(e) {
                    return char[e];
                })
                .toLowerCase();

            return this.slug;

            //return this.nombre.trim().replace(/ /g, '-').toLowerCase()
        }
    },
    methods: {
        getCategory() {
            if (this.slug) {
                let url = "/api/category/" + this.slug;
                axios.get(url).then(response => {
                    this.div_mensaje_slug = response.data;
                    if (this.div_mensaje_slug === "Slug disponible") {
                        this.div_clase_slug = "badge badge-success";
                        this.deshabilitar_boton = 0;
                    } else {
                        this.div_clase_slug = "badge badge-danger";
                        this.deshabilitar_boton = 1;
                    }
                    this.div_aparecer = true;

                    if (document.getElementById('editar')) {
                        if (document.getElementById('nombretemp').innerHTML===this.nombre) {
                            this.deshabilitar_boton = 0;
                            this.div_mensaje_slug = '';
                            this.div_clase_slug = '';
                            this.div_aparecer = false;
                        }
                    }
                });
            } else {
                this.div_clase_slug = "badge badge-danger";
                this.div_mensaje_slug = "Debe escribir una categoría";
                this.deshabilitar_boton = 1;
                this.div_aparecer = true;
            }
        }
    },
    mounted(){
        if (document.getElementById('editar')) {
            this.nombre = document.getElementById('nombretemp').innerHTML;
            this.deshabilitar_boton = 0;
        }
    }
});

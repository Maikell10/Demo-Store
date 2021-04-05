const apiproduct = new Vue({
    el: "#apiproduct",
    data: {
        nombre: "",
        slug: "",
        div_mensaje_slug: "Slug Existe",
        div_clase_slug: "badge badge-danger",
        div_aparecer: false,
        deshabilitar_boton: 1,

        //variables de precio
        precioanterior: 0,
        precioactual: 0,
        descuento: 0,
        porcentaje_descuento: 0,
        descuento_mensaje: "0",

        //Variables del select categories
        selected_category: $("#category_id").val(),
        selected_subcategory: $("#subcategoryid").val(),
        subcategories: "",

        selected_maincategory: "",
        maincategories: "",
        
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
        },
        generarDescuento: function() {
            if (this.porcentaje_descuento > 100) {
                if ($('#lang').val() == 'es') {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No puedes poner un valor mayor a 100"
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "You cannot put a value greater than 100"
                    });
                }

                this.porcentaje_descuento = 100;

                this.descuento =
                    (this.precioanterior * this.porcentaje_descuento) / 100;

                this.precioactual = this.precioanterior - this.descuento;

                if ($('#lang').val() == 'es') {
                    this.descuento_mensaje =
                    "Este producto tiene el 100% de descuento, es gratis";
                } else {
                    this.descuento_mensaje =
                    "This product is 100% off, It's free";
                }

                return this.descuento_mensaje;
            } else if (this.porcentaje_descuento < 0) {
                if ($('#lang').val() == 'es'){
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No puedes poner un valor menor a 0"
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "You cannot put a value less than 0"
                    });
                }

                this.porcentaje_descuento = 0;

                this.descuento =
                    (this.precioanterior * this.porcentaje_descuento) / 100;

                this.precioactual = this.precioanterior - this.descuento;

                this.descuento_mensaje = "";
                return this.descuento_mensaje;
            } else {
                if (this.porcentaje_descuento > 0) {
                    this.descuento =
                        (this.precioanterior * this.porcentaje_descuento) / 100;

                    this.precioactual = this.precioanterior - this.descuento;

                    if (this.porcentaje_descuento == 100) {
                        if ($('#lang').val() == 'es') {
                            this.descuento_mensaje =
                            "Este producto tiene el 100% de descuento, es gratis";
                        } else {
                            this.descuento_mensaje =
                            "This product is 100% off, It's free";
                        }
                    } else {
                        if ($('#lang').val() == 'es') {
                            this.descuento_mensaje =
                            "Hay un descuento de $US " + this.descuento;
                        } else {
                            this.descuento_mensaje =
                            "There is a discount of $US " + this.descuento;
                        }
                    }

                    return this.descuento_mensaje;
                } else {
                    this.descuento = "";

                    this.precioactual = this.precioanterior;

                    this.descuento_mensaje = "";

                    return this.descuento_mensaje;
                }
            }
        }
    },
    methods: {
        loadSubCategories() {
            this.subcategories = '';
            this.maincategories = '';
            this.selected_category = $("#category_id").val();
            axios
                .get("http://tiendademo1.test/api/sub-category", {
                    params: { category_id: this.selected_category }
                })
                .then(response => {
                    this.subcategories = response.data;
                });
        },
        loadMainCategories() {
            this.maincategories = '';
            this.selected_subcategory = $("#sub_category_id").val();
            axios
                .get("http://tiendademo1.test/api/main-category", {
                    params: { sub_category_id: this.selected_subcategory }
                })
                .then(response => {
                    this.maincategories = response.data;
                });
        },
        loadMainCategory() {
            this.maincategories = '';
            this.selected_subcategory = $("#subcategoryid").val();
            axios
                .get("http://tiendademo1.test/api/main-category", {
                    params: { sub_category_id: this.selected_subcategory }
                })
                .then(response => {
                    this.maincategories = response.data;
                });
        },
        eliminarImagen(imagen) {
            if ($('#lang').val() == 'es') {
                Swal.fire({
                    title: "Estas seguro de eliminar la imágen?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar!",
                    cancelButtonText: "No"
                }).then(result => {
                    if (result.value) {
                        let url = "/api/eliminarImagen/" + imagen.id;
                        axios.delete(url).then(response => {
                            console.log(response.data);
                        });
    
                        //eliminar el elemento
                        var elemento = document.getElementById(
                            "idimagen-" + imagen.id
                        );
                        elemento.parentNode.removeChild(elemento);
    
                        Swal.fire(
                            "Eliminada!",
                            "Tu imágen ha sido eliminada!",
                            "success"
                        );
                    }
                });
            }else{
                Swal.fire({
                    title: "Are You sure to delete this image?",
                    text: "You will not be able to reverse this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No"
                }).then(result => {
                    if (result.value) {
                        let url = "/api/eliminarImagen/" + imagen.id;
                        axios.delete(url).then(response => {
                            console.log(response.data);
                        });
    
                        //eliminar el elemento
                        var elemento = document.getElementById(
                            "idimagen-" + imagen.id
                        );
                        elemento.parentNode.removeChild(elemento);
    
                        Swal.fire(
                            "Deleted!",
                            "Your image has been deleted!",
                            "success"
                        );
                    }
                });
            }
        },
        getProduct() {
            if (this.slug) {
                let url = "/api/product/" + this.slug;
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

                    if (data.datos.nombre) {
                        if (data.datos.nombre === this.nombre) {
                            this.deshabilitar_boton = 0;
                            this.div_mensaje_slug = "";
                            this.div_clase_slug = "";
                            this.div_aparecer = false;
                        }
                    }
                });
            } else {
                this.div_clase_slug = "badge badge-danger";
                this.div_mensaje_slug = "Debe escribir un producto";
                this.deshabilitar_boton = 1;
                this.div_aparecer = true;
            }
        },
    },
    mounted() {
        if (data.editar == "Si") {
            this.nombre = data.datos.nombre;
            this.precioanterior = data.datos.precioanterior;
            this.porcentaje_descuento = data.datos.porcentaje_descuento;
            this.deshabilitar_boton = 0;
        };


        $("#category_id").select2().on('change', async function() {
            await apiproduct.loadSubCategories()
        });

        $("#sub_category_id").select2().on('change', async function() {
            await apiproduct.loadMainCategories()
        });

        if (this.selected_category != '') {
            $("#sub_category_id option[value='"+$("#subcategoryid").val()+"']").attr("selected","selected");
            this.loadSubCategories()
            this.loadMainCategory()
        }

        
    }
});

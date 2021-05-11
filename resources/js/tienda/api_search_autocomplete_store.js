const api_search_autocomplete_store = new Vue({
    el: "#api_search_autocomplete_store",
    data: {
        palabra_a_buscar: "",
        resultados: [],
        applocate: $('#applocate').val()
    },
    methods: {
        autoComplete() {
            this.resultados = [];

            if (this.palabra_a_buscar.length > 1) {
                axios
                    .get("/api/autocomplete_index/", {
                        params: { palabraabuscar: this.palabra_a_buscar, applocate: this.applocate }
                    })
                    .then(response => {
                        this.resultados = response.data;
                        //console.log(response.data);
                    });
            }
        },
        /*select(resultado) {
            this.palabra_a_buscar = resultado.main_search;

            this.$nextTick(() => {
                this.SubmitForm();
            });
        },*/
        async select(resultado) {
            this.palabra_a_buscar = resultado.nombre;

            await this.$nextTick();
            this.SubmitForm();
            //$nextTick() sirve para esperar que luego q se actualice el DOM se ejecute una funcion
        },
        SubmitForm() {
            this.$refs.SubmitButonSearch.click();
        },
        changeSubmitSearch(name){
            $("#header_search_form").attr("action",'http://tiendademo1.test/commerce/'+name);
        }
    },
    mounted() {
        this.palabra_a_buscar = $('#value_at').val()
        //console.log("datos cargados correctamente");
    }
});

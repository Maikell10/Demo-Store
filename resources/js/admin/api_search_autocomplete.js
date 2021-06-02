const api_search_autocomplete = new Vue({
    el: "#api_search_autocomplete",
    data: {
        palabra_a_buscar: "",
        resultados: [],

        user_id_autocomplete: $('#user_id_autocomplete').val()
    },
    methods: {
        autoComplete() {
            this.resultados = [];

            if (this.palabra_a_buscar.length > 1) {
                axios
                    .get("/api/autocomplete/", {
                        params: { palabraabuscar: this.palabra_a_buscar, user_id_autocomplete: this.user_id_autocomplete }
                    })
                    .then(response => {
                        this.resultados = response.data;
                        console.log(response.data);
                    });
            }
        },
        /*select(resultado) {
            this.palabra_a_buscar = resultado.nombre;

            this.$nextTick(() => {
                this.SubmitForm();
            });
        },*/
        async select(resultado) {
            this.palabra_a_buscar = resultado.nombre;

            await this.$nextTick();
            window.location.href = 'https://tuminimercado.com/admin/product?nombre=' + this.palabra_a_buscar;
            //this.SubmitForm();
            //$nextTick() sirve para esperar que luego q se actualice el DOM se ejecute una funcion
        },
        SubmitForm() {
            this.$refs.SubmitButonSearch.click();
        }
    },
    mounted() {
        //console.log("datos cargados correctamente");
    }
});
